<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonasiJasa;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
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

    public function keuanganStore(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'nominal' => 'required|numeric|min:1000',
            'catatan' => 'nullable|string|max:1000',
        ]);

        Donasi::create($validated);

        return redirect()->route('donasi.terima-kasih', ['jenis' => 'keuangan'])
            ->with('success', 'Terima kasih! Donasi keuangan Anda telah kami terima.');
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
