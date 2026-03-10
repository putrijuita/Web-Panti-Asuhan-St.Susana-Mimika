<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\GaleriCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $items = Galeri::latest()->paginate(12);

        return view('admin.galeri.index', compact('items'));
    }

    public function create()
    {
        $categories = GaleriCategory::orderBy('nama')->get();

        return view('admin.galeri.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'galeri_category_id' => ['required', 'exists:galeri_categories,id'],
            'nama' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'keterangan' => ['nullable', 'string'],
        ]);

        if (! $request->hasFile('gambar')) {
            return back()
                ->withErrors(['gambar' => 'File gambar tidak diterima server. Coba ulangi upload dengan ukuran file yang lebih kecil.'])
                ->withInput();
        }

        $path = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'galeri_category_id' => $validated['galeri_category_id'],
            'nama' => $validated['nama'],
            'gambar' => $path,
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        $categories = GaleriCategory::orderBy('nama')->get();

        return view('admin.galeri.edit', [
            'item' => $galeri,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'galeri_category_id' => ['required', 'exists:galeri_categories,id'],
            'nama' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $data = [
            'galeri_category_id' => $validated['galeri_category_id'],
            'nama' => $validated['nama'],
            'keterangan' => $validated['keterangan'] ?? null,
        ];

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function categoryCreate()
    {
        return view('admin.galeri.kategori-create');
    }

    public function categoryStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
        ]);

        GaleriCategory::create([
            'nama' => $validated['nama'],
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Kategori galeri berhasil ditambahkan.');
    }
}

