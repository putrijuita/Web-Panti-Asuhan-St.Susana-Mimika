<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $items = StrukturOrganisasi::orderBy('urutan')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.struktur.index', compact('items'));
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $path = $request->file('gambar')->store('struktur-organisasi', 'public');

        StrukturOrganisasi::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'gambar_path' => $path,
        ]);

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    public function show(StrukturOrganisasi $struktur)
    {
        return view('admin.struktur.show', compact('struktur'));
    }

    public function edit(StrukturOrganisasi $struktur)
    {
        return view('admin.struktur.edit', compact('struktur'));
    }

    public function update(Request $request, StrukturOrganisasi $struktur)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = [
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
        ];

        if ($request->hasFile('gambar')) {
            if ($struktur->gambar_path) {
                Storage::disk('public')->delete($struktur->gambar_path);
            }
            $data['gambar_path'] = $request->file('gambar')->store('struktur-organisasi', 'public');
        }

        $struktur->update($data);

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function destroy(StrukturOrganisasi $struktur)
    {
        if ($struktur->gambar_path) {
            Storage::disk('public')->delete($struktur->gambar_path);
        }

        $struktur->delete();

        return redirect()
            ->route('admin.struktur.index')
            ->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}

