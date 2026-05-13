<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TentangController extends Controller
{
    public function edit()
    {
        if (! Schema::hasTable('tentang_contents')) {
            return back()->with('error', 'Tabel konten Tentang belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $tentang = TentangContent::singleton();
        $tentang->fillMissingAttributesFromDefaults();
        $tentang->refresh();
        $nilaiItems = old('nilai_items', $tentang->nilai_items ?: TentangContent::defaultNilaiItems());
        $sejarahItems = old('sejarah_items', $tentang->sejarah_items ?: TentangContent::defaultSejarahItems());

        return view('admin.tentang.edit', compact('tentang', 'nilaiItems', 'sejarahItems'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('tentang_contents')) {
            return back()->with('error', 'Tabel konten Tentang belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:120'],
            'tentang_hero_title' => ['required', 'string', 'max:190'],
            'tentang_hero_description' => ['required', 'string', 'max:1000'],
            'vm_section_label' => ['required', 'string', 'max:120'],
            'vm_visi_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'vm_misi_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'vm_visi_heading' => ['required', 'string', 'max:80'],
            'vm_misi_heading' => ['required', 'string', 'max:80'],
            'visi_text' => ['required', 'string', 'max:4000'],
            'misi_text' => ['required', 'string', 'max:8000'],
            'nilai_section_label' => ['required', 'string', 'max:120'],
            'nilai_section_title' => ['required', 'string', 'max:190'],
            'nilai_section_sub' => ['nullable', 'string', 'max:500'],
            'nilai_items' => ['required', 'array', 'size:6'],
            'nilai_items.*.icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'nilai_items.*.title' => ['required', 'string', 'max:100'],
            'nilai_items.*.text' => ['required', 'string', 'max:600'],
            'sejarah_section_label' => ['required', 'string', 'max:120'],
            'sejarah_section_title' => ['required', 'string', 'max:190'],
            'sejarah_section_sub' => ['required', 'string', 'max:500'],
            'sejarah_items' => ['required', 'array', 'size:4'],
            'sejarah_items.*.badge' => ['required', 'string', 'max:120'],
            'sejarah_items.*.title' => ['required', 'string', 'max:220'],
            'sejarah_items.*.body' => ['required', 'string', 'max:1200'],
            'pengurus_section_label' => ['required', 'string', 'max:120'],
            'pengurus_section_title' => ['required', 'string', 'max:190'],
            'pengurus_section_sub' => ['required', 'string', 'max:500'],
            'cta_title' => ['required', 'string', 'max:190'],
            'cta_subtitle' => ['required', 'string', 'max:500'],
            'cta_btn_donasi' => ['required', 'string', 'max:80'],
            'cta_btn_kunjungan' => ['required', 'string', 'max:80'],
            'cta_btn_kontak' => ['required', 'string', 'max:80'],
        ]);

        $misiItems = collect(preg_split('/\r\n|\r|\n/', $validated['misi_text']))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();

        if (count($misiItems) === 0) {
            return back()->withErrors([
                'misi_text' => 'Minimal isi satu poin misi (satu baris per poin).',
            ])->withInput();
        }

        $nilaiItems = collect($validated['nilai_items'])
            ->map(fn ($row) => [
                'icon' => trim($row['icon']),
                'title' => trim($row['title']),
                'text' => trim($row['text']),
            ])
            ->all();

        $sejarahItems = collect($validated['sejarah_items'])
            ->map(fn ($row) => [
                'badge' => trim($row['badge']),
                'title' => trim($row['title']),
                'body' => trim($row['body']),
            ])
            ->all();

        $tentang = TentangContent::singleton();
        $tentang->update([
            'page_meta_title' => $validated['page_meta_title'],
            'tentang_hero_title' => $validated['tentang_hero_title'],
            'tentang_hero_description' => $validated['tentang_hero_description'],
            'vm_section_label' => $validated['vm_section_label'],
            'vm_visi_icon' => trim($validated['vm_visi_icon']),
            'vm_misi_icon' => trim($validated['vm_misi_icon']),
            'vm_visi_heading' => $validated['vm_visi_heading'],
            'vm_misi_heading' => $validated['vm_misi_heading'],
            'visi_text' => $validated['visi_text'],
            'misi_items' => $misiItems,
            'nilai_section_label' => $validated['nilai_section_label'],
            'nilai_section_title' => $validated['nilai_section_title'],
            'nilai_section_sub' => $validated['nilai_section_sub'] ?: null,
            'nilai_items' => $nilaiItems,
            'sejarah_section_label' => $validated['sejarah_section_label'],
            'sejarah_section_title' => $validated['sejarah_section_title'],
            'sejarah_section_sub' => $validated['sejarah_section_sub'],
            'sejarah_items' => $sejarahItems,
            'pengurus_section_label' => $validated['pengurus_section_label'],
            'pengurus_section_title' => $validated['pengurus_section_title'],
            'pengurus_section_sub' => $validated['pengurus_section_sub'],
            'cta_title' => $validated['cta_title'],
            'cta_subtitle' => $validated['cta_subtitle'],
            'cta_btn_donasi' => $validated['cta_btn_donasi'],
            'cta_btn_kunjungan' => $validated['cta_btn_kunjungan'],
            'cta_btn_kontak' => $validated['cta_btn_kontak'],
        ]);

        return redirect()
            ->route('admin.tentang.edit')
            ->with('success', 'Konten halaman Tentang berhasil diperbarui.');
    }
}
