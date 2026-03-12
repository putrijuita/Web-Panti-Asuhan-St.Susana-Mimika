<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\KegiatanCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Pastikan kategori default ada: Program Unggulan dan Program Lainnya.
     */
    protected function ensureDefaultCategoriesExist(): void
    {
        $defaultNames = ['Program Unggulan', 'Program Lainnya'];

        foreach ($defaultNames as $name) {
            KegiatanCategory::firstOrCreate(['nama' => $name]);
        }
    }

    public function index()
    {
        $kegiatan = Kegiatan::with('kategori')->latest()->paginate(10);

        $unggulanCategory = KegiatanCategory::where('nama', 'Program Unggulan')->first();
        $lainnyaCategory = KegiatanCategory::where('nama', 'Program Lainnya')->first();

        $programUnggulan = $unggulanCategory
            ? $unggulanCategory->kegiatans()->latest()->get()
            : collect();
        $programLainnya = $lainnyaCategory
            ? $lainnyaCategory->kegiatans()->latest()->get()
            : collect();

        return view('admin.kegiatan.index', compact('kegiatan', 'programUnggulan', 'programLainnya'));
    }

    public function create()
    {
        $this->ensureDefaultCategoriesExist();
        $categories = KegiatanCategory::orderBy('nama')->get();

        return view('admin.kegiatan.create', [
            'categories' => $categories,
            'editing' => null,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'waktu_kegiatan' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'deskripsi' => 'nullable|string',
            'kegiatan_category_id' => 'required|exists:kegiatan_categories,id',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kegiatan', 'public');
            $data['gambar'] = $path;
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Program berhasil disimpan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        $this->ensureDefaultCategoriesExist();
        $categories = KegiatanCategory::orderBy('nama')->get();

        return view('admin.kegiatan.create', [
            'categories' => $categories,
            'editing' => $kegiatan,
        ]);
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('kategori');

        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'waktu_kegiatan' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'deskripsi' => 'nullable|string',
            'kegiatan_category_id' => 'required|exists:kegiatan_categories,id',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $path = $request->file('gambar')->store('kegiatan', 'public');
            $data['gambar'] = $path;
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Program berhasil dihapus.');
    }

    public function categories(KegiatanCategory $category = null)
    {
        $categories = KegiatanCategory::orderBy('nama')->paginate(15);

        return view('admin.kegiatan.categories', [
            'categories' => $categories,
            'editing' => $category?->exists ? $category : null,
        ]);
    }

    public function categoryStore(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KegiatanCategory::create($data);

        return redirect()->route('admin.kegiatan.categories.index')
            ->with('success', 'Kategori kegiatan berhasil disimpan.');
    }

    public function categoryEdit(KegiatanCategory $category)
    {
        $categories = KegiatanCategory::orderBy('nama')->paginate(15);

        return view('admin.kegiatan.categories', [
            'categories' => $categories,
            'editing' => $category,
        ]);
    }

    public function categoryUpdate(Request $request, KegiatanCategory $category)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $category->update($data);

        return redirect()->route('admin.kegiatan.categories.index')
            ->with('success', 'Kategori kegiatan berhasil diperbarui.');
    }

    public function categoryDestroy(KegiatanCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.kegiatan.categories.index')
            ->with('success', 'Kategori kegiatan berhasil dihapus.');
    }
}

