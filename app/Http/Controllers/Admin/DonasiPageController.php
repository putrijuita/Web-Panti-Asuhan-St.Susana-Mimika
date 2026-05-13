<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonasiPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class DonasiPageController extends Controller
{
    private static function iconRule(): array
    {
        return ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'];
    }

    public function edit()
    {
        if (! Schema::hasTable('donasi_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Donasi belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $donasi = DonasiPageContent::singleton();
        $donasi->fillMissingFromDefaults();
        $donasi->refresh();

        return view('admin.donasi-page.edit', compact('donasi'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('donasi_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Donasi belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $ico = self::iconRule();

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:200'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'remove_hero_image' => ['nullable', 'boolean'],
            'hero_badge_keuangan_icon' => $ico,
            'hero_badge_keuangan_text' => ['required', 'string', 'max:80'],
            'hero_badge_separator' => ['required', 'string', 'max:20'],
            'hero_badge_jasa_icon' => $ico,
            'hero_badge_jasa_text' => ['required', 'string', 'max:80'],
            'hero_title_line1' => ['required', 'string', 'max:190'],
            'hero_word_red' => ['required', 'string', 'max:80'],
            'hero_word_green' => ['required', 'string', 'max:80'],
            'hero_subtitle' => ['required', 'string', 'max:1200'],
            'card_keu_top_icon' => $ico,
            'card_keu_pill' => ['required', 'string', 'max:80'],
            'card_keu_title' => ['required', 'string', 'max:120'],
            'card_keu_intro' => ['required', 'string', 'max:500'],
            'card_keu_feat1' => ['required', 'string', 'max:300'],
            'card_keu_feat2' => ['required', 'string', 'max:300'],
            'card_keu_feat3' => ['required', 'string', 'max:300'],
            'card_keu_feat4' => ['required', 'string', 'max:300'],
            'card_keu_cta' => ['required', 'string', 'max:120'],
            'card_jasa_top_icon' => $ico,
            'card_jasa_pill' => ['required', 'string', 'max:80'],
            'card_jasa_title' => ['required', 'string', 'max:120'],
            'card_jasa_intro' => ['required', 'string', 'max:500'],
            'card_jasa_feat1' => ['required', 'string', 'max:300'],
            'card_jasa_feat2' => ['required', 'string', 'max:300'],
            'card_jasa_feat3' => ['required', 'string', 'max:300'],
            'card_jasa_feat4' => ['required', 'string', 'max:300'],
            'card_jasa_cta' => ['required', 'string', 'max:120'],
            'section_grafik_icon' => $ico,
            'section_grafik_title' => ['required', 'string', 'max:250'],
            'stat_lbl_pemasukan' => ['required', 'string', 'max:120'],
            'stat_lbl_pengeluaran' => ['required', 'string', 'max:120'],
            'stat_lbl_sisa' => ['required', 'string', 'max:120'],
            'section_table_icon' => $ico,
            'section_table_title' => ['required', 'string', 'max:120'],
            'tbl_th_nama' => ['required', 'string', 'max:80'],
            'tbl_th_email' => ['required', 'string', 'max:80'],
            'tbl_th_nominal' => ['required', 'string', 'max:80'],
            'tbl_th_waktu' => ['required', 'string', 'max:80'],
            'tbl_empty_msg' => ['required', 'string', 'max:300'],
            'chart_lbl_pemasukan' => ['required', 'string', 'max:80'],
            'chart_lbl_pengeluaran' => ['required', 'string', 'max:80'],
            'chart_lbl_sisa' => ['required', 'string', 'max:80'],
            'dl1_text' => ['required', 'string', 'max:500'],
            'dl1_btn' => ['required', 'string', 'max:120'],
            'dl2_text' => ['required', 'string', 'max:500'],
            'dl2_btn' => ['required', 'string', 'max:120'],
        ]);

        $row = DonasiPageContent::singleton();

        $imagePath = $row->hero_image;
        if ($request->hasFile('hero_image')) {
            if ($row->hero_image && ! str_starts_with((string) $row->hero_image, 'http') && Storage::disk('public')->exists($row->hero_image)) {
                Storage::disk('public')->delete($row->hero_image);
            }
            $imagePath = $request->file('hero_image')->store('site/donasi', 'public');
        } elseif ($request->boolean('remove_hero_image')) {
            if ($row->hero_image && ! str_starts_with((string) $row->hero_image, 'http') && Storage::disk('public')->exists($row->hero_image)) {
                Storage::disk('public')->delete($row->hero_image);
            }
            $imagePath = null;
        }

        unset($validated['hero_image'], $validated['remove_hero_image']);
        $validated['hero_image'] = $imagePath;

        $row->update($validated);

        return redirect()
            ->route('admin.donasi-page.edit')
            ->with('success', 'Konten halaman Donasi (/donasi) berhasil disimpan.');
    }
}
