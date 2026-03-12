<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengelolaanDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengelolaanDonasiController extends Controller
{
    public function index()
    {
        $items = PengelolaanDonasi::latest('tanggal_waktu')->paginate(15);

        return view('admin.pengelolaan-donasi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pengelolaan-donasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'gambar' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'tanggal_waktu' => ['required', 'date'],
        ]);

        $data = [
            'nama' => $validated['nama'],
            'jumlah' => $validated['jumlah'],
            'tanggal_waktu' => $validated['tanggal_waktu'],
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengelolaan-donasi', 'public');
        }

        PengelolaanDonasi::create($data);

        return redirect()
            ->route('admin.pengelolaan-donasi.index')
            ->with('success', 'Pengelolaan donasi berhasil ditambahkan.');
    }

    public function edit(PengelolaanDonasi $pengelolaanDonasi)
    {
        return view('admin.pengelolaan-donasi.edit', ['item' => $pengelolaanDonasi]);
    }

    public function update(Request $request, PengelolaanDonasi $pengelolaanDonasi)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'tanggal_waktu' => ['required', 'date'],
        ]);

        $data = [
            'nama' => $validated['nama'],
            'jumlah' => $validated['jumlah'],
            'tanggal_waktu' => $validated['tanggal_waktu'],
        ];

        if ($request->hasFile('gambar')) {
            if ($pengelolaanDonasi->gambar && Storage::disk('public')->exists($pengelolaanDonasi->gambar)) {
                Storage::disk('public')->delete($pengelolaanDonasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pengelolaan-donasi', 'public');
        }

        $pengelolaanDonasi->update($data);

        return redirect()
            ->route('admin.pengelolaan-donasi.index')
            ->with('success', 'Pengelolaan donasi berhasil diperbarui.');
    }

    public function destroy(PengelolaanDonasi $pengelolaanDonasi)
    {
        if ($pengelolaanDonasi->gambar && Storage::disk('public')->exists($pengelolaanDonasi->gambar)) {
            Storage::disk('public')->delete($pengelolaanDonasi->gambar);
        }

        $pengelolaanDonasi->delete();

        return redirect()
            ->route('admin.pengelolaan-donasi.index')
            ->with('success', 'Pengelolaan donasi berhasil dihapus.');
    }
}
