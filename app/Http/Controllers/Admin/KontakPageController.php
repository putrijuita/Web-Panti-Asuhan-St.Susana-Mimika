<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class KontakPageController extends Controller
{
    /** Font Awesome: kelas seperti "fas fa-phone" atau "fab fa-facebook-f" atau "fas fa-location-dot" */
    private static function iconRule(): array
    {
        return ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\.\-]+$/'];
    }

    public function edit()
    {
        if (! Schema::hasTable('kontak_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Kontak belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $kontak = KontakPageContent::singleton();
        $kontak->fillMissingFromDefaults();
        $kontak->refresh();

        return view('admin.kontak-page.edit', compact('kontak'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('kontak_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman Kontak belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $ico = self::iconRule();

        $validated = $request->validate([
            'page_meta_title' => ['required', 'string', 'max:200'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'remove_hero_image' => ['nullable', 'boolean'],
            'hero_icon' => $ico,
            'hero_title' => ['required', 'string', 'max:190'],
            'hero_subtitle' => ['required', 'string', 'max:1200'],
            'info_block_icon' => $ico,
            'info_block_title' => ['required', 'string', 'max:120'],
            'phone_item_icon' => $ico,
            'phone_title' => ['required', 'string', 'max:120'],
            'phone_href' => ['required', 'string', 'max:120'],
            'phone_display' => ['required', 'string', 'max:80'],
            'phone_note' => ['required', 'string', 'max:190'],
            'fb_item_icon' => $ico,
            'fb_title' => ['required', 'string', 'max:120'],
            'fb_url' => ['required', 'string', 'max:500'],
            'fb_link_text' => ['required', 'string', 'max:190'],
            'fb_note' => ['nullable', 'string', 'max:190'],
            'ig_item_icon' => $ico,
            'ig_title' => ['required', 'string', 'max:120'],
            'ig_url' => ['required', 'string', 'max:500'],
            'ig_link_text' => ['required', 'string', 'max:500'],
            'addr_item_icon' => $ico,
            'addr_title' => ['required', 'string', 'max:120'],
            'addr_line1' => ['required', 'string', 'max:255'],
            'addr_line2' => ['required', 'string', 'max:255'],
            'addr_line3' => ['required', 'string', 'max:255'],
            'addr_maps_url' => ['nullable', 'string', 'max:2000', 'regex:/^https:\/\/.+/i'],
            'quick_block_icon' => $ico,
            'quick_block_title' => ['required', 'string', 'max:120'],
            'quick_fb_text' => ['required', 'string', 'max:120'],
            'quick_fb_url' => ['required', 'string', 'max:500'],
            'quick_ig_text' => ['required', 'string', 'max:500'],
            'quick_ig_url' => ['required', 'string', 'max:500'],
            'quick_phone_text' => ['required', 'string', 'max:120'],
            'quick_phone_url' => ['required', 'string', 'max:120'],
            'jam_block_icon' => $ico,
            'jam_block_title' => ['required', 'string', 'max:120'],
            'jam_row1_hari' => ['required', 'string', 'max:120'],
            'jam_row1_waktu' => ['required', 'string', 'max:80'],
            'jam_row2_hari' => ['required', 'string', 'max:120'],
            'jam_row2_waktu' => ['required', 'string', 'max:80'],
            'jam_row3_hari' => ['required', 'string', 'max:120'],
            'jam_row3_waktu' => ['required', 'string', 'max:120'],
            'faq_block_icon' => $ico,
            'faq_block_title' => ['required', 'string', 'max:120'],
            'faq1_q' => ['required', 'string', 'max:255'],
            'faq1_a' => ['required', 'string', 'max:1200'],
            'faq2_q' => ['required', 'string', 'max:255'],
            'faq2_a' => ['required', 'string', 'max:1200'],
            'faq3_q' => ['required', 'string', 'max:255'],
            'faq3_a' => ['required', 'string', 'max:1200'],
            'faq4_q' => ['required', 'string', 'max:255'],
            'faq4_a' => ['required', 'string', 'max:1200'],
            'form_title' => ['required', 'string', 'max:120'],
            'form_subtitle' => ['required', 'string', 'max:800'],
            'lbl_nama' => ['required', 'string', 'max:120'],
            'ph_nama' => ['required', 'string', 'max:190'],
            'lbl_email' => ['required', 'string', 'max:120'],
            'ph_email' => ['required', 'string', 'max:190'],
            'lbl_subjek' => ['required', 'string', 'max:120'],
            'select_placeholder' => ['required', 'string', 'max:120'],
            'opt1_value' => ['required', 'string', 'max:80'],
            'opt1_label' => ['required', 'string', 'max:120'],
            'opt2_value' => ['required', 'string', 'max:80'],
            'opt2_label' => ['required', 'string', 'max:120'],
            'opt3_value' => ['required', 'string', 'max:80'],
            'opt3_label' => ['required', 'string', 'max:120'],
            'opt4_value' => ['required', 'string', 'max:80'],
            'opt4_label' => ['required', 'string', 'max:120'],
            'opt5_value' => ['required', 'string', 'max:80'],
            'opt5_label' => ['required', 'string', 'max:120'],
            'opt6_value' => ['required', 'string', 'max:80'],
            'opt6_label' => ['required', 'string', 'max:120'],
            'lbl_pesan' => ['required', 'string', 'max:120'],
            'ph_pesan' => ['required', 'string', 'max:300'],
            'btn_submit_icon' => $ico,
            'btn_submit_text' => ['required', 'string', 'max:120'],
            'form_footer_icon' => $ico,
            'form_footer_text' => ['required', 'string', 'max:190'],
            'divider_text' => ['required', 'string', 'max:120'],
            'divider_btn_icon' => $ico,
            'divider_btn_text' => ['required', 'string', 'max:80'],
            'divider_btn_href' => ['required', 'string', 'max:120'],
            'success_message' => ['required', 'string', 'max:500'],
        ]);

        $row = KontakPageContent::singleton();

        $imagePath = $row->hero_image;
        if ($request->hasFile('hero_image')) {
            if ($row->hero_image && ! str_starts_with((string) $row->hero_image, 'http') && Storage::disk('public')->exists($row->hero_image)) {
                Storage::disk('public')->delete($row->hero_image);
            }
            $imagePath = $request->file('hero_image')->store('site/kontak', 'public');
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
            ->route('admin.kontak-page.edit')
            ->with('success', 'Konten halaman Kontak (/kontak) berhasil disimpan.');
    }
}
