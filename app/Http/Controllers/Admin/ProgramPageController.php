<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProgramPageController extends Controller
{
    public function edit()
    {
        if (! Schema::hasTable('program_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman /program belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $program = ProgramPageContent::singleton();
        $program->fillMissingFromDefaults();
        $program->refresh();

        return view('admin.program-page.edit', compact('program'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('program_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman /program belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:190'],
            'hero_subtitle' => ['required', 'string', 'max:1200'],
            'rutin_section_label' => ['required', 'string', 'max:120'],
            'rutin_section_title' => ['required', 'string', 'max:190'],
            'rutin_section_sub' => ['required', 'string', 'max:800'],
            'empty_section_label' => ['required', 'string', 'max:120'],
            'empty_section_title' => ['required', 'string', 'max:190'],
            'empty_section_sub' => ['required', 'string', 'max:800'],
            'cta_title' => ['required', 'string', 'max:190'],
            'cta_subtitle' => ['required', 'string', 'max:600'],
            'cta_btn_donasi' => ['required', 'string', 'max:80'],
            'cta_btn_kunjungan' => ['required', 'string', 'max:80'],
        ]);

        $program = ProgramPageContent::singleton();
        foreach ($validated as $key => $value) {
            $program->{$key} = $value;
        }
        $program->save();

        return redirect()
            ->route('admin.program-page.edit')
            ->with('success', 'Konten halaman Jadwal kegiatan anak (/program) berhasil disimpan.');
    }
}
