<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class KunjunganPageController extends Controller
{
    private static function iconRule(): array
    {
        return ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\-]+$/'];
    }

    public function edit()
    {
        if (! Schema::hasTable('kunjungan_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Kunjungan belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $kunjungan = KunjunganPageContent::singleton();
        $kunjungan->fillMissingFromDefaults();
        $kunjungan->refresh();

        return view('admin.kunjungan-page.edit', compact('kunjungan'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('kunjungan_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Kunjungan belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $ico = self::iconRule();

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:200'],
            'thanks_meta_title' => ['required', 'string', 'max:200'],
            'hero_icon' => $ico,
            'hero_title' => ['required', 'string', 'max:190'],
            'hero_subtitle' => ['required', 'string', 'max:1200'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'remove_hero_image' => ['nullable', 'boolean'],
            'explain_icon' => $ico,
            'explain_title' => ['required', 'string', 'max:190'],
            'explain_li_1' => ['required', 'string', 'max:800'],
            'explain_li_2' => ['required', 'string', 'max:800'],
            'explain_li_3' => ['required', 'string', 'max:800'],
            'flow_icon' => $ico,
            'flow_title' => ['required', 'string', 'max:190'],
            'step1_title' => ['required', 'string', 'max:120'],
            'step1_text' => ['required', 'string', 'max:500'],
            'step2_title' => ['required', 'string', 'max:120'],
            'step2_text' => ['required', 'string', 'max:500'],
            'step3_title' => ['required', 'string', 'max:120'],
            'step3_text' => ['required', 'string', 'max:500'],
            'step4_title' => ['required', 'string', 'max:120'],
            'step4_text' => ['required', 'string', 'max:500'],
            'activities_icon' => $ico,
            'activities_title' => ['required', 'string', 'max:190'],
            'activities_intro' => ['required', 'string', 'max:500'],
            'act1_icon' => $ico,
            'act1_text' => ['required', 'string', 'max:120'],
            'act2_icon' => $ico,
            'act2_text' => ['required', 'string', 'max:120'],
            'act3_icon' => $ico,
            'act3_text' => ['required', 'string', 'max:120'],
            'act4_icon' => $ico,
            'act4_text' => ['required', 'string', 'max:120'],
            'act5_icon' => $ico,
            'act5_text' => ['required', 'string', 'max:120'],
            'act6_icon' => $ico,
            'act6_text' => ['required', 'string', 'max:120'],
            'rules_icon' => $ico,
            'rules_title' => ['required', 'string', 'max:190'],
            'rule1' => ['required', 'string', 'max:400'],
            'rule2' => ['required', 'string', 'max:400'],
            'rule3' => ['required', 'string', 'max:400'],
            'rule4' => ['required', 'string', 'max:400'],
            'rule5' => ['required', 'string', 'max:400'],
            'form_title' => ['required', 'string', 'max:190'],
            'form_intro' => ['required', 'string', 'max:800'],
            'lbl_nama' => ['required', 'string', 'max:120'],
            'ph_nama' => ['required', 'string', 'max:190'],
            'lbl_email' => ['required', 'string', 'max:120'],
            'ph_email' => ['required', 'string', 'max:190'],
            'lbl_telepon' => ['required', 'string', 'max:120'],
            'tag_optional' => ['required', 'string', 'max:80'],
            'ph_telepon' => ['required', 'string', 'max:190'],
            'lbl_tanggal' => ['required', 'string', 'max:120'],
            'note_tanggal' => ['required', 'string', 'max:500'],
            'lbl_instansi' => ['required', 'string', 'max:120'],
            'tag_optional_instansi' => ['required', 'string', 'max:80'],
            'ph_instansi' => ['required', 'string', 'max:190'],
            'lbl_keperluan' => ['required', 'string', 'max:120'],
            'ph_keperluan' => ['required', 'string', 'max:300'],
            'note_keperluan' => ['required', 'string', 'max:500'],
            'lbl_catatan' => ['required', 'string', 'max:120'],
            'tag_optional_catatan' => ['required', 'string', 'max:80'],
            'ph_catatan' => ['required', 'string', 'max:300'],
            'note_catatan' => ['required', 'string', 'max:500'],
            'btn_submit_icon' => $ico,
            'btn_submit_text' => ['required', 'string', 'max:120'],
            'form_footer_icon' => $ico,
            'form_footer_text' => ['required', 'string', 'max:190'],
            'thanks_emoji' => ['required', 'string', 'max:20'],
            'thanks_title' => ['required', 'string', 'max:190'],
            'thanks_body' => ['required', 'string', 'max:800'],
            'thanks_btn_text' => ['required', 'string', 'max:120'],
        ]);

        $row = KunjunganPageContent::singleton();

        $imagePath = $row->hero_image;
        if ($request->hasFile('hero_image')) {
            if ($row->hero_image && ! str_starts_with((string) $row->hero_image, 'http') && Storage::disk('public')->exists($row->hero_image)) {
                Storage::disk('public')->delete($row->hero_image);
            }
            $imagePath = $request->file('hero_image')->store('site/kunjungan', 'public');
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
            ->route('admin.kunjungan-page.edit')
            ->with('success', 'Konten halaman Kunjungan (/kunjungan) berhasil disimpan.');
    }
}
