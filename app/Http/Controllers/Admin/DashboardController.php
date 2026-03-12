<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\DonasiJasa;
use App\Models\Kunjungan;
use App\Models\PengelolaanDonasi;
use App\Models\VideoDokumentasi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_donasi' => Donasi::count(),
            'donasi_lunas' => Donasi::whereIn('status', ['settlement', 'completed'])->count(),
            'total_nominal' => Donasi::whereIn('status', ['settlement', 'completed'])->sum('nominal'),
            'total_kunjungan' => Kunjungan::count(),
            'kunjungan_pending' => Kunjungan::where('status', 'pending')->count(),
            'kunjungan_approved' => Kunjungan::where('status', 'approved')->count(),
            'kunjungan_completed' => Kunjungan::where('status', 'completed')->count(),
            'kunjungan_rejected' => Kunjungan::where('status', 'rejected')->count(),
            'total_donasi_jasa' => DonasiJasa::count(),
            'total_dokumentasi_video' => VideoDokumentasi::count(),
        ];

        $donasi_terbaru = Donasi::latest()->take(5)->get();
        $kunjungan_terbaru = Kunjungan::latest()->take(5)->get();
        $pengelolaan_donasi = PengelolaanDonasi::latest('tanggal_waktu')->take(5)->get();

        $driver = DB::connection()->getDriverName();
        if ($driver === 'mysql') {
            $donasi_per_bulan = Donasi::whereIn('status', ['settlement', 'completed'])
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"), DB::raw('SUM(nominal) as total'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->map(fn ($r) => ['bulan' => $r->bulan, 'total' => (float) $r->total]);
        } else {
            $donasi_per_bulan = Donasi::whereIn('status', ['settlement', 'completed'])
                ->select(DB::raw("strftime('%Y-%m', created_at) as bulan"), DB::raw('SUM(nominal) as total'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->map(fn ($r) => ['bulan' => $r->bulan, 'total' => (float) $r->total]);
        }

        if ($donasi_per_bulan->isEmpty()) {
            $donasi_per_bulan = collect([['bulan' => now()->format('Y-m'), 'total' => 0]]);
        }

        // Pemasukan vs Pengeluaran vs Sisa Saldo (6 bulan terakhir)
        $total_pemasukan = (float) Donasi::whereIn('status', ['settlement', 'completed'])->sum('nominal');
        $total_pengeluaran = (float) PengelolaanDonasi::sum('jumlah');
        $sisa_saldo = $total_pemasukan - $total_pengeluaran;

        $bulan_6 = collect();
        for ($i = 5; $i >= 0; $i--) {
            $bulan_6->push(now()->subMonths($i)->format('Y-m'));
        }

        if ($driver === 'mysql') {
            $pengeluaran_per_bulan = PengelolaanDonasi::query()
                ->select(DB::raw("DATE_FORMAT(tanggal_waktu, '%Y-%m') as bulan"), DB::raw('SUM(jumlah) as total'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->keyBy('bulan');
        } else {
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

        return view('admin.dashboard', compact(
            'stats',
            'donasi_terbaru',
            'kunjungan_terbaru',
            'donasi_per_bulan',
            'pengelolaan_donasi',
            'total_pemasukan',
            'total_pengeluaran',
            'sisa_saldo',
            'grafik_donasi'
        ));
    }
}
