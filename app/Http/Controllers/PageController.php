<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use App\Models\Kegiatan;
use App\Models\KegiatanCategory;
use App\Models\VideoDokumentasi;
use App\Models\Galeri;
use App\Models\GaleriCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    public function tentang()
    {
        $pengurus = StrukturOrganisasi::orderBy('urutan')
            ->orderBy('created_at')
            ->get();

        return view('pages.tentang', compact('pengurus'));
    }

    public function program()
    {
        $all = Kegiatan::with('kategori')->latest()->get();

        $unggulanCategory = KegiatanCategory::where('nama', 'Program Unggulan')->first();

        // Satu kartu per program (nama unik) agar tidak tampil duplikat
        $unggulKegiatan = $unggulanCategory
            ? $all->where('kegiatan_category_id', $unggulanCategory->id)->unique('nama')->values()
            : collect();

        $rutinKegiatan = $unggulanCategory
            ? $all->where('kegiatan_category_id', '!=', $unggulanCategory->id)
                ->merge($all->whereNull('kegiatan_category_id'))
                ->values()
            : $all;

        return view('pages.program', [
            'rutinKegiatan' => $rutinKegiatan,
            'unggulKegiatan' => $unggulKegiatan,
        ]);
    }

    public function programUnggulan()
    {
        $category = KegiatanCategory::where('nama', 'Program Unggulan')->first();
        $programs = $category ? $category->kegiatans()->latest()->get() : collect();

        return view('pages.program-unggulan', compact('programs'));
    }

    public function programLainnya()
    {
        $category = KegiatanCategory::where('nama', 'Program Lainnya')->first();
        $programs = $category ? $category->kegiatans()->latest()->get() : collect();

        return view('pages.program-lainnya', compact('programs'));
    }

    public function galeri()
    {
        $items = Galeri::latest()->get();
        $videos = VideoDokumentasi::latest()->get();
        $categories = collect();
        if (Schema::hasTable('galeri_categories')) {
            $categories = GaleriCategory::orderBy('nama')->get();
        }

        return view('pages.galeri', compact('items', 'videos', 'categories'));
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function kontakStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string|max:2000',
        ]);

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
