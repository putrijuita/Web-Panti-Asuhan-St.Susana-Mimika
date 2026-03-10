<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\DonasiJasa;
use App\Models\Kunjungan;
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
        ];

        $donasi_terbaru = Donasi::latest()->take(5)->get();
        $kunjungan_terbaru = Kunjungan::latest()->take(5)->get();

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

        return view('admin.dashboard', compact('stats', 'donasi_terbaru', 'kunjungan_terbaru', 'donasi_per_bulan'));
    }
}
