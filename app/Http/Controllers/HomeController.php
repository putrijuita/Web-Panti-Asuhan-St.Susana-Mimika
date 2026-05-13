<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonasiJasa;
use App\Models\Kunjungan;
use App\Models\TentangContent;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'donasi_sukses' => Donasi::whereIn('status', ['settlement', 'completed'])->count(),
            'donasi_jasa' => DonasiJasa::count(),
            'kunjungan_disetujui' => Kunjungan::whereIn('status', ['approved', 'completed'])->count(),
        ];

        $tentangContent = TentangContent::resolvedForPublic();

        return view('home', compact('stats', 'tentangContent'));
    }
}
