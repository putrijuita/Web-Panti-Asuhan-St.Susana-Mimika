<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        return view('kunjungan.index');
    }

    public function create()
    {
        return view('kunjungan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'instansi' => 'nullable|string|max:255',
            'keperluan' => 'required|string|max:500',
            'catatan' => 'nullable|string|max:1000',
        ]);

        Kunjungan::create($validated);

        return redirect()->route('kunjungan.terima-kasih')
            ->with('success', 'Permohonan kunjungan Anda telah diterima!');
    }

    public function terimaKasih()
    {
        return view('kunjungan.terima-kasih');
    }
}
