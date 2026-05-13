<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GaleriPageController extends Controller
{
    public function edit()
    {
        if (! Schema::hasTable('galeri_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Galeri belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $galeri = GaleriPageContent::singleton();
        $galeri->fillMissingFromDefaults();
        $galeri->refresh();

        return view('admin.galeri-page.edit', compact('galeri'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('galeri_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Galeri belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:120'],
            'hero_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'hero_title' => ['required', 'string', 'max:190'],
            'hero_subtitle' => ['required', 'string', 'max:1200'],
            'filter_btn_semua' => ['required', 'string', 'max:80'],
            'album_section_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'album_section_label' => ['required', 'string', 'max:120'],
            'album_section_title' => ['required', 'string', 'max:190'],
            'gallery_overlay_tag' => ['required', 'string', 'max:120'],
            'gallery_default_caption' => ['required', 'string', 'max:500'],
            'empty_title' => ['required', 'string', 'max:190'],
            'empty_text' => ['required', 'string', 'max:800'],
            'video_section_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'video_section_label' => ['required', 'string', 'max:120'],
            'video_section_title' => ['required', 'string', 'max:190'],
            'video_section_sub' => ['required', 'string', 'max:800'],
            'video_empty_message' => ['required', 'string', 'max:800'],
            'video_browser_unsupported' => ['required', 'string', 'max:300'],
            'cta_title' => ['required', 'string', 'max:190'],
            'cta_subtitle' => ['required', 'string', 'max:600'],
            'cta_btn_kunjungan' => ['required', 'string', 'max:80'],
            'cta_btn_donasi' => ['required', 'string', 'max:80'],
            'lightbox_close_label' => ['required', 'string', 'max:80'],
        ]);

        GaleriPageContent::singleton()->update($validated);

        return redirect()
            ->route('admin.galeri-page.edit')
            ->with('success', 'Konten halaman Galeri (/galeri) berhasil disimpan.');
    }
}
