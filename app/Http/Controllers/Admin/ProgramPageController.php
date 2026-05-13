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
                ->with('error', 'Tabel konten halaman Kegiatan belum tersedia. Jalankan migrasi terlebih dahulu.');
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
                ->with('error', 'Tabel konten halaman Kegiatan belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:190'],
            'hero_subtitle' => ['required', 'string', 'max:1200'],
            'unggul_section_label' => ['required', 'string', 'max:120'],
            'unggul_section_title' => ['required', 'string', 'max:190'],
            'unggul_section_sub' => ['required', 'string', 'max:800'],
            'unggul_eyebrow' => ['required', 'string', 'max:120'],
            'unggul_chip' => ['required', 'string', 'max:120'],
            'unggul_default_desc' => ['required', 'string', 'max:2000'],
            'unggul_fallback_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'unggul_donate_btn' => ['required', 'string', 'max:160'],
            'unggul_donate_hint' => ['required', 'string', 'max:300'],
            'rutin_section_label' => ['required', 'string', 'max:120'],
            'rutin_section_title' => ['required', 'string', 'max:190'],
            'rutin_section_sub' => ['required', 'string', 'max:800'],
            'rutin_pill' => ['required', 'string', 'max:120'],
            'rutin_eyebrow' => ['required', 'string', 'max:120'],
            'rutin_default_desc' => ['required', 'string', 'max:2000'],
            'rutin_fallback_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'empty_section_label' => ['required', 'string', 'max:120'],
            'empty_section_title' => ['required', 'string', 'max:190'],
            'empty_section_sub' => ['required', 'string', 'max:800'],
            'involve_section_label' => ['required', 'string', 'max:120'],
            'involve_section_title' => ['required', 'string', 'max:190'],
            'involve_steps' => ['required', 'array', 'size:4'],
            'involve_steps.*.title' => ['required', 'string', 'max:120'],
            'involve_steps.*.text' => ['required', 'string', 'max:400'],
            'cta_title' => ['required', 'string', 'max:190'],
            'cta_subtitle' => ['required', 'string', 'max:600'],
            'cta_btn_donasi' => ['required', 'string', 'max:80'],
            'cta_btn_kunjungan' => ['required', 'string', 'max:80'],
        ]);

        $steps = collect($validated['involve_steps'])
            ->map(fn ($s) => ['title' => trim($s['title']), 'text' => trim($s['text'])])
            ->all();

        $validated['involve_steps'] = $steps;

        ProgramPageContent::singleton()->update($validated);

        return redirect()
            ->route('admin.program-page.edit')
            ->with('success', 'Konten halaman Kegiatan (/program) berhasil disimpan.');
    }
}
