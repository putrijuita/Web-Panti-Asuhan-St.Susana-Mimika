<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnakAsuhPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AnakAsuhPageController extends Controller
{
    public function edit()
    {
        if (! Schema::hasTable('anak_asuh_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Anak Asuh belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $page = AnakAsuhPageContent::singleton();
        $page->fillMissingFromDefaults();
        $page->refresh();

        return view('admin.anak-asuh-page.edit', compact('page'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('anak_asuh_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Anak Asuh belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:120'],
            'layout_page_title' => ['required', 'string', 'max:120'],
            'layout_page_subtitle' => ['required', 'string', 'max:240'],
            'hero_title' => ['required', 'string', 'max:190'],
            'hero_subtitle' => ['required', 'string', 'max:1200'],
            'empty_text' => ['required', 'string', 'max:800'],
        ]);

        AnakAsuhPageContent::singleton()->update($validated);

        return redirect()
            ->route('admin.anak-asuh-page.edit')
            ->with('success', 'Konten halaman Anak Asuh (/anak-asuh) berhasil disimpan.');
    }
}
