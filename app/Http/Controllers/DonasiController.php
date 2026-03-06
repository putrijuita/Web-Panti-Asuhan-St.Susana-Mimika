<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonasiJasa;
use Illuminate\Http\Request;
use App\Mail\DonasiKonfirmasi;
use App\Mail\DonasiNotifikasiAdmin;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config as MidtransConfig;
use Midtrans\CoreApi;
use Midtrans\Notification;
use Midtrans\Transaction;

class DonasiController extends Controller
{
    public function __construct()
    {
        MidtransConfig::$serverKey    = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized  = true;
        MidtransConfig::$is3ds        = true;
    }

    public function index()
    {
        return view('donasi.index');
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
                'gross_amount' => (int) $validated['nominal'],
            ],
            'customer_details' => [
                'first_name' => $validated['nama'],
                'email'      => $validated['email'],
                'phone'      => $validated['telepon'] ?? '',
            ],
            'item_details' => [
                [
                    'id'       => 'DONASI-001',
                    'price'    => (int) $validated['nominal'],
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
            if (isset($response->actions)) {
                foreach ($response->actions as $action) {
                    if ($action->name === 'generate-qr-code') {
                        $qrUrl = $action->url;
                        break;
                    }
                }
            }

            $donasi->update(['midtrans_snap_token' => $response->transaction_id ?? $orderId]);

            return response()->json([
                'qr_url'      => $qrUrl,
                'order_id'    => $orderId,
                'nominal'     => (int) $validated['nominal'],
                'expiry_time' => $response->expiry_time ?? null,
            ]);
        } catch (\Exception $e) {
            $donasi->delete();
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
                return redirect()->route('donasi.terima-kasih', ['jenis' => 'keuangan'])
                    ->with('success', 'Terima kasih! Donasi keuangan Anda sedang diproses.');
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
        return view('donasi.terima-kasih', compact('jenis'));
    }
}
