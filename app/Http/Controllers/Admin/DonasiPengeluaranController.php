<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonasiPengeluaran;
use Illuminate\Http\Request;

class DonasiPengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = DonasiPengeluaran::orderByDesc('tanggal_pengeluaran')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.donasi-pengelolaan.index', compact('pengeluaran'));
    }

    public function create()
    {
        $pengeluaran = DonasiPengeluaran::orderByDesc('tanggal_pengeluaran')
            ->orderByDesc('created_at')
            ->paginate(15);

        $editing = null;

        return view('admin.donasi-pengelolaan.create', compact('pengeluaran', 'editing'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
            'waktu_pengeluaran' => 'required|date',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('donasi_pengeluaran', 'public');
        }

        DonasiPengeluaran::create([
            'nama_pengeluaran' => $data['nama'],
            'jumlah_pengeluaran' => $data['jumlah'],
            'gambar_path' => $path,
            'tanggal_pengeluaran' => $data['waktu_pengeluaran'],
        ]);

        return redirect()
            ->route('admin.pengelolaan-donasi.index')
            ->with('success', 'Pengelolaan donasi berhasil ditambahkan.');
    }

    public function edit(DonasiPengeluaran $pengelolaan_donasi)
    {
        $pengeluaran = DonasiPengeluaran::orderByDesc('tanggal_pengeluaran')
            ->orderByDesc('created_at')
            ->paginate(15);

        $editing = $pengelolaan_donasi;

        return view('admin.donasi-pengelolaan.create', compact('pengeluaran', 'editing'));
    }

    public function update(Request $request, DonasiPengeluaran $pengelolaan_donasi)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
            'waktu_pengeluaran' => 'required|date',
        ]);

        $payload = [
            'nama_pengeluaran' => $data['nama'],
            'jumlah_pengeluaran' => $data['jumlah'],
            'tanggal_pengeluaran' => $data['waktu_pengeluaran'],
        ];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('donasi_pengeluaran', 'public');
            $payload['gambar_path'] = $path;
        }

        $pengelolaan_donasi->update($payload);

        return redirect()
            ->route('admin.pengelolaan-donasi.index')
            ->with('success', 'Pengelolaan donasi berhasil diperbarui.');
    }

    public function destroy(DonasiPengeluaran $pengelolaan_donasi)
    {
        $pengelolaan_donasi->delete();

        return redirect()
            ->route('admin.pengelolaan-donasi.index')
            ->with('success', 'Pengelolaan donasi berhasil dihapus.');
    }
}

