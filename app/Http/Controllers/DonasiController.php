<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonasiJasa;
use App\Models\PengelolaanDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\DonasiKonfirmasi;
use App\Mail\DonasiNotifikasiAdmin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Midtrans\Config as MidtransConfig;
use Midtrans\CoreApi;
use Midtrans\Notification;
use Midtrans\Transaction;

class DonasiController extends Controller
{
    public function __construct()
    {
        $serverKey = config('midtrans.server_key');
        $serverKey = is_string($serverKey) ? trim($serverKey) : '';

        MidtransConfig::$serverKey    = $serverKey;
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized  = true;
        MidtransConfig::$is3ds        = true;
    }

    public function index()
    {
        $donasiList = Donasi::where('status', 'completed')
            ->orderByDesc('updated_at')
            ->limit(100)
            ->get();

        // Data grafik pemasukan, pengeluaran & sisa saldo (6 bulan terakhir)
        $total_pemasukan = (float) Donasi::whereIn('status', ['settlement', 'completed'])->sum('nominal');
        $total_pengeluaran = (float) PengelolaanDonasi::sum('jumlah');
        $sisa_saldo = $total_pemasukan - $total_pengeluaran;

        $bulan_6 = collect();
        for ($i = 5; $i >= 0; $i--) {
            $bulan_6->push(now()->subMonths($i)->format('Y-m'));
        }

        $driver = DB::connection()->getDriverName();
        if ($driver === 'mysql') {
            $donasi_per_bulan = Donasi::whereIn('status', ['settlement', 'completed'])
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"), DB::raw('SUM(nominal) as total'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->map(fn ($r) => ['bulan' => $r->bulan, 'total' => (float) $r->total]);
            $pengeluaran_per_bulan = PengelolaanDonasi::query()
                ->select(DB::raw("DATE_FORMAT(tanggal_waktu, '%Y-%m') as bulan"), DB::raw('SUM(jumlah) as total'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->keyBy('bulan');
        } else {
            $donasi_per_bulan = Donasi::whereIn('status', ['settlement', 'completed'])
                ->select(DB::raw("strftime('%Y-%m', created_at) as bulan"), DB::raw('SUM(nominal) as total'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->map(fn ($r) => ['bulan' => $r->bulan, 'total' => (float) $r->total]);
            $pengeluaran_per_bulan = PengelolaanDonasi::query()
                ->select(DB::raw("strftime('%Y-%m', tanggal_waktu) as bulan"), DB::raw('SUM(jumlah) as total'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->keyBy('bulan');
        }

        $donasi_per_bulan_keyed = $donasi_per_bulan->keyBy('bulan');
        $grafik_donasi = [];
        foreach ($bulan_6 as $b) {
            $pemasukan = $donasi_per_bulan_keyed->has($b) ? (float) $donasi_per_bulan_keyed->get($b)['total'] : 0;
            $pengeluaran = $pengeluaran_per_bulan->has($b) ? (float) $pengeluaran_per_bulan->get($b)->total : 0;
            $cum_pemasukan = $donasi_per_bulan->filter(fn ($r) => $r['bulan'] <= $b)->sum('total');
            $cum_pengeluaran = $pengeluaran_per_bulan->filter(fn ($r) => $r->bulan <= $b)->sum('total');
            $grafik_donasi[] = [
                'bulan' => $b,
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
                'sisa_saldo' => $cum_pemasukan - $cum_pengeluaran,
            ];
        }

        return view('donasi.index', compact('donasiList', 'total_pemasukan', 'total_pengeluaran', 'sisa_saldo', 'grafik_donasi'));
    }

    public function create()
    {
        return redirect()->route('donasi.index');
    }

    // ── Donasi Keuangan ──────────────────────────────
    public function keuangan()
    {
        return view('donasi.keuangan');
    }

    /**
     * Buat transaksi QRIS via Core API dan kembalikan URL gambar QR code
     */
    public function midtransToken(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'nominal' => 'required|numeric|min:1000',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $orderId = 'DONASI-' . strtoupper(uniqid());

        $donasi = Donasi::create([
            'order_id'   => $orderId,
            'nama'       => $validated['nama'],
            'email'      => $validated['email'],
            'telepon'    => $validated['telepon'] ?? null,
            'nominal'    => $validated['nominal'],
            'catatan'    => $validated['catatan'] ?? null,
            'status'     => 'pending',
            'payment_type' => 'qris',
        ]);

        $params = [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) round($validated['nominal']),
            ],
            'customer_details' => [
                'first_name' => $validated['nama'],
                'email'      => $validated['email'],
                'phone'      => $validated['telepon'] ?? '',
            ],
            'item_details' => [
                [
                    'id'       => 'DONASI-001',
                    'price'    => (int) round($validated['nominal']),
                    'quantity' => 1,
                    'name'     => 'Donasi Panti Asuhan Santa Susana',
                ],
            ],
            'qris' => [
                'acquirer' => 'gopay',
            ],
        ];

        try {
            $response = CoreApi::charge($params);

            $qrUrl = null;
            if (isset($response->actions) && is_array($response->actions)) {
                $qrUrlV2 = null;
                foreach ($response->actions as $action) {
                    if (!isset($action->name, $action->url)) {
                        continue;
                    }
                    if ($action->name === 'generate-qr-code-v2') {
                        $qrUrlV2 = $action->url;
                        break;
                    }
                    if ($action->name === 'generate-qr-code' && $qrUrl === null) {
                        $qrUrl = $action->url;
                    }
                }
                $qrUrl = $qrUrlV2 ?? $qrUrl;
            }

            $donasi->update(['midtrans_snap_token' => $response->transaction_id ?? $orderId]);

            $transactionId = $response->transaction_id ?? null;
            $qrImageUrl = $transactionId
                ? route('donasi.qr-image', ['transactionId' => $transactionId])
                : $qrUrl;

            return response()->json([
                'qr_url'      => $qrImageUrl,
                'order_id'    => $orderId,
                'nominal'     => (int) $validated['nominal'],
                'expiry_time' => $response->expiry_time ?? null,
            ]);
        } catch (\Exception $e) {
            $donasi->delete();
            \Log::warning('Midtrans charge error', ['message' => $e->getMessage(), 'order_id' => $orderId]);

            $message = $e->getMessage();
            if (str_contains($message, '401') || str_contains($message, 'status_code')) {
                $message = 'Kunci API Midtrans tidak valid atau environment (Sandbox/Production) tidak sesuai. Periksa MIDTRANS_SERVER_KEY dan MIDTRANS_IS_PRODUCTION di .env';
            }

            return response()->json(['error' => $message], 500);
        }
    }

    /**
     * Proxy gambar QR code dari Midtrans (endpoint Midtrans memerlukan Server Key)
     */
    public function qrImage(string $transactionId)
    {
        $serverKey = config('midtrans.server_key');
        $serverKey = is_string($serverKey) ? trim($serverKey) : '';
        if ($serverKey === '') {
            abort(503, 'Midtrans tidak dikonfigurasi');
        }

        $baseUrl = config('midtrans.is_production')
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';
        $url = $baseUrl . '/v2/qris/' . $transactionId . '/qr-code';

        $response = Http::withBasicAuth($serverKey, '')
            ->timeout(15)
            ->get($url);

        if (!$response->successful()) {
            abort(502, 'Tidak dapat memuat QR code');
        }

        return response($response->body(), 200, [
            'Content-Type'        => $response->header('Content-Type') ?: 'image/png',
            'Cache-Control'       => 'private, max-age=300',
        ]);
    }

    /**
     * Cek status pembayaran (polling dari frontend)
     */
    public function midtransStatus(Request $request, string $orderId)
    {
        try {
            $status = Transaction::status($orderId);

            $transactionStatus = $status->transaction_status ?? 'pending';
            $paid = in_array($transactionStatus, ['settlement', 'capture']);

            if ($paid) {
                $donasi = Donasi::where('order_id', $orderId)->first();
                if ($donasi && $donasi->status !== 'completed') {
                    $donasi->update(['status' => 'completed']);
                    $this->kirimEmailDonasi($donasi->fresh());
                }
            }

            return response()->json([
                'transaction_status' => $transactionStatus,
                'paid'               => $paid,
            ]);
        } catch (\Exception $e) {
            return response()->json(['paid' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Kirim email konfirmasi ke donatur dan notifikasi ke admin
     */
    private function kirimEmailDonasi(Donasi $donasi): void
    {
        try {
            Mail::to($donasi->email)->send(new DonasiKonfirmasi($donasi));
        } catch (\Exception) {}

        try {
            $adminEmail = config('mail.admin_email', env('MAIL_ADMIN_EMAIL'));
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new DonasiNotifikasiAdmin($donasi));
            }
        } catch (\Exception) {}
    }

    /**
     * Webhook notifikasi pembayaran dari Midtrans
     */
    public function midtransNotification(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId           = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $paymentType       = $notification->payment_type;
            $fraudStatus       = $notification->fraud_status ?? null;

            $donasi = Donasi::where('order_id', $orderId)->first();

            if (! $donasi) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($transactionStatus === 'capture') {
                $status = ($fraudStatus === 'accept') ? 'completed' : 'pending';
            } elseif ($transactionStatus === 'settlement') {
                $status = 'completed';
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $status = 'cancelled';
            } else {
                $status = 'pending';
            }

            $wasNotCompleted = $donasi->status !== 'completed';

            $donasi->update([
                'status'       => $status,
                'payment_type' => $paymentType,
            ]);

            if ($status === 'completed' && $wasNotCompleted) {
                $this->kirimEmailDonasi($donasi->fresh());
            }

            return response()->json(['message' => 'OK']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function keuanganStore(Request $request)
    {
        $orderId = $request->input('order_id');

        if ($orderId) {
            $donasi = Donasi::where('order_id', $orderId)->first();
            if ($donasi) {
                return redirect()->route('donasi.terima-kasih', [
                    'jenis'     => 'keuangan',
                    'order_id'  => $donasi->order_id,
                ])->with('success', 'Terima kasih! Donasi keuangan Anda sedang diproses.')
                    ->with('donasi_terima_kasih', [
                        'nama'    => $donasi->nama,
                        'email'   => $donasi->email,
                        'nominal' => $donasi->nominal,
                    ]);
            }
        }

        return redirect()->route('donasi.keuangan');
    }

    // ── Donasi Jasa ──────────────────────────────────
    public function jasa()
    {
        return view('donasi.jasa');
    }

    public function jasaStore(Request $request)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email',
            'telepon'        => 'nullable|string|max:20',
            'jenis_jasa'     => 'required|string|max:100',
            'keahlian'       => 'required|string|max:1000',
            'tanggal_mulai'  => 'required|date|after_or_equal:today',
            'durasi'         => 'required|string|max:100',
            'instansi'       => 'nullable|string|max:255',
            'deskripsi'      => 'required|string|max:2000',
            'catatan'        => 'nullable|string|max:1000',
        ]);

        DonasiJasa::create($validated);

        return redirect()->route('donasi.terima-kasih', ['jenis' => 'jasa'])
            ->with('success', 'Terima kasih! Penawaran donasi jasa Anda telah kami terima.');
    }

    // ── Terima Kasih ─────────────────────────────────
    public function terimaKasih(Request $request)
    {
        $jenis = $request->query('jenis', 'keuangan');
        $donasiTerimaKasih = $request->session()->get('donasi_terima_kasih');

        // Fallback: muat dari DB bila ada order_id di URL (session bisa hilang saat redirect)
        if (empty($donasiTerimaKasih) && $jenis === 'keuangan' && $request->has('order_id')) {
            $donasi = Donasi::where('order_id', $request->query('order_id'))->first();
            if ($donasi) {
                $donasiTerimaKasih = [
                    'nama'    => $donasi->nama,
                    'email'   => $donasi->email,
                    'nominal' => $donasi->nominal,
                ];
            }
        }

        return view('donasi.terima-kasih', compact('jenis', 'donasiTerimaKasih'));
    }

    /**
     * Download laporan donasi keuangan (PDF) — transparansi publik
     */
    public function laporanDonasi()
    {
        $donasi = Donasi::where('status', 'completed')
            ->orderByDesc('updated_at')
            ->get();

        $generatedAt = now();
        $filename = 'laporan-donasi-' . $generatedAt->format('Y-m-d') . '.pdf';

        $pdf = Pdf::loadView('donasi.laporan-donasi', compact('donasi', 'generatedAt'));

        return $pdf->download($filename);
    }

    /**
     * Download laporan pengelolaan donasi (PDF) — transparansi penggunaan dana
     */
    public function laporanPengelolaanDonasi()
    {
        $items = PengelolaanDonasi::orderByDesc('tanggal_waktu')->get();
        $generatedAt = now();
        $filename = 'laporan-pengelolaan-donasi-' . $generatedAt->format('Y-m-d') . '.pdf';

        $pdf = Pdf::loadView('donasi.laporan-pengelolaan-donasi', compact('items', 'generatedAt'));

        return $pdf->download($filename);
    }
}
