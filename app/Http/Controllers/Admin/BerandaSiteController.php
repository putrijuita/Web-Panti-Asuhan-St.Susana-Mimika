<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Models\TentangContent;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BerandaSiteController extends Controller
{
    public function edit()
    {
        if (! Schema::hasTable('site_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten situs belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        if (! Schema::hasTable('tentang_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten Tentang belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $site = SiteContent::singleton();
        $tentang = TentangContent::singleton();
        $donasiKeuangan = SiteContent::resolvedDonasiKeuanganPage();
        $donasiKeuanganCmsReady = Schema::hasColumn('site_contents', 'donasi_keuangan_page');
        $donasiJasa = SiteContent::resolvedDonasiJasaPage();
        $donasiJasaCmsReady = Schema::hasColumn('site_contents', 'donasi_jasa_page');
        $siteLogoCmsReady = Schema::hasColumn('site_contents', 'site_logo');
        $bodyBackgroundCmsReady = Schema::hasColumn('site_contents', 'site_body_background');

        $includeAnakAsuhMenu = Schema::hasColumn('site_contents', 'footer_menu_anak_asuh');
        $footerNavigationCmsReady = Schema::hasColumn('site_contents', 'footer_navigation');
        $footerNavigationDraft = old('fn');
        if (! is_array($footerNavigationDraft)) {
            $footerNavigationDraft = is_array($site->footer_navigation) ? $site->footer_navigation : null;
        }
        $footerNavigationForm = SiteContent::coerceFooterNavigationForAdmin($footerNavigationDraft, $site, $includeAnakAsuhMenu);
        $footerRouteOptions = SiteContent::footerPublicRouteOptions();
        $headerSiteCmsReady = Schema::hasColumn('site_contents', 'header_navigation');

        return view('admin.beranda.edit', compact('site', 'tentang', 'donasiKeuangan', 'donasiKeuanganCmsReady', 'donasiJasa', 'donasiJasaCmsReady', 'siteLogoCmsReady', 'bodyBackgroundCmsReady', 'footerNavigationCmsReady', 'footerNavigationForm', 'footerRouteOptions', 'headerSiteCmsReady'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('site_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten situs belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        if (! Schema::hasTable('tentang_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten Tentang belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $headerSiteCmsReady = Schema::hasColumn('site_contents', 'header_navigation');

        $baseRules = [
            'hero_kicker' => ['nullable', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:190'],
            'hero_description' => ['required', 'string', 'max:2500'],
            'summary_subtitle' => ['required', 'string', 'max:220'],
            'summary_paragraph_1' => ['required', 'string', 'max:3500'],
            'summary_paragraph_2' => ['required', 'string', 'max:3500'],
            'summary_cta_note' => ['required', 'string', 'max:1200'],
            'home_btn_donasi' => ['required', 'string', 'max:80'],
            'home_btn_kunjungan' => ['required', 'string', 'max:80'],
            'home_tentang_section_title' => ['required', 'string', 'max:120'],
            'home_about_image_alt' => ['required', 'string', 'max:190'],
            'home_visual_title' => ['required', 'string', 'max:120'],
            'home_visual_subtitle' => ['required', 'string', 'max:120'],
            'home_tentang_cta_label' => ['required', 'string', 'max:160'],
            'home_kontak_title' => ['required', 'string', 'max:120'],
            'home_kontak_intro' => ['required', 'string', 'max:2000'],
            'home_kontak_phone_heading' => ['required', 'string', 'max:120'],
            'home_kontak_phone_display' => ['required', 'string', 'max:80'],
            'home_kontak_phone_href' => ['required', 'string', 'max:120'],
            'home_kontak_wa_text' => ['required', 'string', 'max:80'],
            'home_kontak_wa_url' => ['required', 'string', 'max:500'],
            'home_kontak_fb_heading' => ['required', 'string', 'max:80'],
            'home_kontak_fb_text' => ['required', 'string', 'max:190'],
            'home_kontak_fb_url' => ['required', 'string', 'max:500'],
            'home_kontak_ig_heading' => ['required', 'string', 'max:80'],
            'home_kontak_ig_text' => ['required', 'string', 'max:300'],
            'home_kontak_ig_url' => ['required', 'string', 'max:500'],
            'home_kontak_addr_heading' => ['required', 'string', 'max:80'],
            'home_kontak_addr_text' => ['required', 'string', 'max:300'],
            'footer_brand_name' => ['required', 'string', 'max:120'],
            'footer_brand_desc' => ['required', 'string', 'max:2000'],
            'footer_heading_menu' => ['required', 'string', 'max:80'],
            'footer_heading_kegiatan' => ['required', 'string', 'max:80'],
            'footer_heading_kontak' => ['required', 'string', 'max:80'],
            'footer_menu_beranda' => ['required', 'string', 'max:80'],
            'footer_menu_tentang' => ['required', 'string', 'max:80'],
            'footer_menu_kegiatan' => ['required', 'string', 'max:80'],
            'footer_menu_galeri' => ['required', 'string', 'max:80'],
            'footer_menu_donasi' => ['required', 'string', 'max:80'],
            'footer_menu_kunjungan' => ['required', 'string', 'max:80'],
            'footer_menu_kontak' => ['required', 'string', 'max:80'],
            'footer_kegiatan_rutin' => ['required', 'string', 'max:120'],
            'footer_kegiatan_unggulan' => ['required', 'string', 'max:120'],
            'footer_kegiatan_lainnya' => ['required', 'string', 'max:120'],
            'footer_phone_display' => ['required', 'string', 'max:80'],
            'footer_phone_href' => ['required', 'string', 'max:120'],
            'footer_fb_text' => ['required', 'string', 'max:190'],
            'footer_fb_url' => ['required', 'string', 'max:500'],
            'footer_ig_text' => ['required', 'string', 'max:300'],
            'footer_ig_url' => ['required', 'string', 'max:500'],
            'footer_address' => ['required', 'string', 'max:300'],
            'footer_sosmed_fb_url' => ['required', 'string', 'max:500'],
            'footer_sosmed_phone_href' => ['required', 'string', 'max:120'],
            'footer_sosmed_ig_url' => ['required', 'string', 'max:500'],
            'footer_copyright_left' => ['required', 'string', 'max:300'],
            'footer_copyright_right' => ['required', 'string', 'max:200'],
            'home_about_image' => ['nullable', 'image', 'max:4096'],
            'remove_home_about_image' => ['nullable', 'boolean'],
        ];

        if (! $headerSiteCmsReady) {
            $baseRules = array_merge($baseRules, [
                'nav_brand_suffix' => ['required', 'string', 'max:120'],
                'nav_beranda' => ['required', 'string', 'max:80'],
                'nav_tentang' => ['required', 'string', 'max:80'],
                'nav_kegiatan' => ['required', 'string', 'max:80'],
                'nav_galeri' => ['required', 'string', 'max:80'],
                'nav_donasi' => ['required', 'string', 'max:80'],
                'nav_kunjungan' => ['required', 'string', 'max:80'],
                'nav_kontak' => ['required', 'string', 'max:80'],
            ]);
        }

        if (Schema::hasColumn('site_contents', 'site_logo') && ! $headerSiteCmsReady) {
            $baseRules['site_logo'] = ['nullable', 'image', 'max:3072'];
            $baseRules['remove_site_logo'] = ['nullable', 'boolean'];
        }

        if (Schema::hasColumn('site_contents', 'site_body_background')) {
            $baseRules['site_body_background'] = ['nullable', 'image', 'max:5120'];
            $baseRules['remove_site_body_background'] = ['nullable', 'boolean'];
        }

        if (Schema::hasColumn('site_contents', 'donasi_keuangan_page')) {
            $baseRules = array_merge($baseRules, SiteContent::donasiKeuanganValidationRules(), [
                'donasi_keuangan_qris_logo' => ['nullable', 'image', 'max:2048'],
                'remove_donasi_keuangan_qris_logo' => ['nullable', 'boolean'],
            ]);
        }

        if (Schema::hasColumn('site_contents', 'donasi_jasa_page')) {
            $baseRules = array_merge($baseRules, SiteContent::donasiJasaValidationRules());
        }

        if (Schema::hasColumn('site_contents', 'nav_anak_asuh')) {
            if (! $headerSiteCmsReady) {
                $baseRules['nav_anak_asuh'] = ['required', 'string', 'max:80'];
            }
            $baseRules['footer_menu_anak_asuh'] = ['required', 'string', 'max:80'];
        }

        if (Schema::hasColumn('site_contents', 'footer_navigation')) {
            $routes = SiteContent::footerPublicRouteNames();
            $routeRule = Rule::in($routes);
            $baseRules = array_merge($baseRules, [
                'fn' => ['required', 'array'],
                'fn.menu_items' => ['required', 'array', 'min:1', 'max:'.SiteContent::FOOTER_MENU_ITEMS_MAX],
                'fn.menu_items.*.label' => ['required', 'string', 'max:120'],
                'fn.menu_items.*.href_type' => ['required', 'in:route,url'],
                'fn.menu_items.*.route' => ['nullable', 'string', 'max:120', $routeRule],
                'fn.menu_items.*.href' => ['nullable', 'string', 'max:2000'],
                'fn.menu_items.*.icon' => ['required', 'string', 'max:120'],
                'fn.kegiatan_items' => ['nullable', 'array', 'max:'.SiteContent::FOOTER_KEGIATAN_ITEMS_MAX],
                'fn.kegiatan_items.*.label' => ['required', 'string', 'max:160'],
                'fn.kegiatan_items.*.href_type' => ['required', 'in:route,url'],
                'fn.kegiatan_items.*.route' => ['nullable', 'string', 'max:120', $routeRule],
                'fn.kegiatan_items.*.href' => ['nullable', 'string', 'max:2000'],
                'fn.kegiatan_items.*.icon' => ['required', 'string', 'max:120'],
                'fn.social_items' => ['nullable', 'array', 'max:'.SiteContent::FOOTER_SOCIAL_ITEMS_MAX],
                'fn.social_items.*.url' => ['required', 'string', 'max:500'],
                'fn.social_items.*.icon' => ['required', 'string', 'max:120'],
                'fn.social_items.*.title' => ['required', 'string', 'max:80'],
                'fn.contact_items' => ['nullable', 'array', 'max:'.SiteContent::FOOTER_CONTACT_ITEMS_MAX],
                'fn.contact_items.*.type' => ['required', 'string', Rule::in(SiteContent::footerContactItemTypes())],
                'fn.contact_items.*.icon' => ['required', 'string', 'max:120'],
                'fn.contact_items.*.href_type' => ['nullable', 'in:site,route,url'],
                'fn.contact_items.*.route' => ['nullable', 'string', 'max:120', $routeRule],
                'fn.contact_items.*.href' => ['nullable', 'string', 'max:2000'],
                'fn.contact_items.*.label' => ['nullable', 'string', 'max:200'],
                'fn.contact_items.*.url' => ['nullable', 'string', 'max:500'],
                'fn.contact_items.*.body' => ['nullable', 'string', 'max:500'],
            ]);
        }

        $validated = $request->validate($baseRules);

        TentangContent::singleton()->update([
            'hero_kicker' => filled($validated['hero_kicker']) ? $validated['hero_kicker'] : null,
            'hero_title' => $validated['hero_title'],
            'hero_description' => $validated['hero_description'],
            'summary_subtitle' => $validated['summary_subtitle'],
            'summary_paragraph_1' => $validated['summary_paragraph_1'],
            'summary_paragraph_2' => $validated['summary_paragraph_2'],
            'summary_cta_note' => $validated['summary_cta_note'],
        ]);

        $tentangKeys = [
            'hero_kicker',
            'hero_title',
            'hero_description',
            'summary_subtitle',
            'summary_paragraph_1',
            'summary_paragraph_2',
            'summary_cta_note',
        ];
        $validated = Arr::except($validated, $tentangKeys);

        $site = SiteContent::singleton();

        if (Schema::hasColumn('site_contents', 'donasi_keuangan_page') && isset($validated['dk'])) {
            $dk = $validated['dk'];
            unset($validated['dk']);

            $page = array_replace_recursive(
                SiteContent::donasiKeuanganPageDefaults(),
                (array) ($site->donasi_keuangan_page ?? []),
                $dk
            );

            foreach (range(0, 5) as $i) {
                $page['form']['amounts'][$i] = (int) ($page['form']['amounts'][$i] ?? 0);
            }

            $page['form']['amounts'] = array_values($page['form']['amounts']);
            $page['form']['amount_labels'] = array_values(array_map('strval', $page['form']['amount_labels'] ?? []));

            if (blank($page['form']['qris_logo_storage'] ?? null)) {
                $page['form']['qris_logo_storage'] = null;
            }

            $storagePath = data_get($page, 'form.qris_logo_storage');
            if ($request->boolean('remove_donasi_keuangan_qris_logo')) {
                if ($storagePath && ! str_starts_with((string) $storagePath, 'http') && Storage::disk('public')->exists($storagePath)) {
                    Storage::disk('public')->delete($storagePath);
                }
                $page['form']['qris_logo_storage'] = null;
            } elseif ($request->hasFile('donasi_keuangan_qris_logo')) {
                if ($storagePath && ! str_starts_with((string) $storagePath, 'http') && Storage::disk('public')->exists($storagePath)) {
                    Storage::disk('public')->delete($storagePath);
                }
                $page['form']['qris_logo_storage'] = $request->file('donasi_keuangan_qris_logo')->store('site/donasi-keuangan', 'public');
            }

            $validated['donasi_keuangan_page'] = $page;
        }

        if (Schema::hasColumn('site_contents', 'donasi_jasa_page') && isset($validated['dj'])) {
            $dj = $validated['dj'];
            unset($validated['dj']);

            $jasaPage = array_replace_recursive(
                SiteContent::donasiJasaPageDefaults(),
                (array) ($site->donasi_jasa_page ?? []),
                $dj
            );

            $jasaPage['bidang']['chips'] = array_values($jasaPage['bidang']['chips'] ?? []);
            $jasaPage['alur']['steps'] = array_values($jasaPage['alur']['steps'] ?? []);
            $jasaPage['benefits']['items'] = array_values(array_map('strval', $jasaPage['benefits']['items'] ?? []));
            $jasaPage['form']['chips'] = array_values($jasaPage['form']['chips'] ?? []);
            $jasaPage['form']['durasi_options'] = array_values($jasaPage['form']['durasi_options'] ?? []);

            $validated['donasi_jasa_page'] = $jasaPage;
        }

        unset($validated['donasi_keuangan_qris_logo'], $validated['remove_donasi_keuangan_qris_logo']);

        $imagePath = $site->home_about_image;

        if ($request->hasFile('home_about_image')) {
            if ($site->home_about_image && ! str_starts_with((string) $site->home_about_image, 'http') && Storage::disk('public')->exists($site->home_about_image)) {
                Storage::disk('public')->delete($site->home_about_image);
            }
            $imagePath = $request->file('home_about_image')->store('site/beranda', 'public');
        } elseif ($request->boolean('remove_home_about_image')) {
            if ($site->home_about_image && ! str_starts_with((string) $site->home_about_image, 'http') && Storage::disk('public')->exists($site->home_about_image)) {
                Storage::disk('public')->delete($site->home_about_image);
            }
            $imagePath = null;
        }

        unset($validated['home_about_image'], $validated['remove_home_about_image']);
        $validated['home_about_image'] = $imagePath;

        if (Schema::hasColumn('site_contents', 'site_logo') && ! $headerSiteCmsReady) {
            $siteLogoPath = $site->site_logo;
            if ($request->hasFile('site_logo')) {
                if ($site->site_logo && ! str_starts_with((string) $site->site_logo, 'http') && Storage::disk('public')->exists($site->site_logo)) {
                    Storage::disk('public')->delete($site->site_logo);
                }
                $siteLogoPath = $request->file('site_logo')->store('site/logo', 'public');
            } elseif ($request->boolean('remove_site_logo')) {
                if ($site->site_logo && ! str_starts_with((string) $site->site_logo, 'http') && Storage::disk('public')->exists($site->site_logo)) {
                    Storage::disk('public')->delete($site->site_logo);
                }
                $siteLogoPath = null;
            }
            unset($validated['site_logo'], $validated['remove_site_logo']);
            $validated['site_logo'] = $siteLogoPath;
        }

        if (Schema::hasColumn('site_contents', 'site_body_background')) {
            $bodyBgPath = $site->site_body_background;
            if ($request->hasFile('site_body_background')) {
                if ($site->site_body_background && ! str_starts_with((string) $site->site_body_background, 'http') && Storage::disk('public')->exists($site->site_body_background)) {
                    Storage::disk('public')->delete($site->site_body_background);
                }
                $bodyBgPath = $request->file('site_body_background')->store('site/background', 'public');
            } elseif ($request->boolean('remove_site_body_background')) {
                if ($site->site_body_background && ! str_starts_with((string) $site->site_body_background, 'http') && Storage::disk('public')->exists($site->site_body_background)) {
                    Storage::disk('public')->delete($site->site_body_background);
                }
                $bodyBgPath = null;
            }
            unset($validated['site_body_background'], $validated['remove_site_body_background']);
            $validated['site_body_background'] = $bodyBgPath;
        }

        if (Schema::hasColumn('site_contents', 'footer_navigation') && isset($validated['fn'])) {
            $filtered = SiteContent::filterFooterNavEmptyRepeaterRows($validated['fn']);
            SiteContent::assertFooterNavigationValid($filtered);
            unset($validated['fn']);
            $validated['footer_navigation'] = SiteContent::sanitizeFooterNavigationForStorage($filtered);
        }

        if ($headerSiteCmsReady) {
            $skipHeaderManaged = [
                'nav_brand_suffix', 'nav_beranda', 'nav_tentang', 'nav_kegiatan',
                'nav_galeri', 'nav_donasi', 'nav_kunjungan', 'nav_kontak',
                'site_logo', 'remove_site_logo',
            ];
            if (Schema::hasColumn('site_contents', 'nav_anak_asuh')) {
                $skipHeaderManaged[] = 'nav_anak_asuh';
            }
            $validated = Arr::except($validated, $skipHeaderManaged);
        }

        $site->update($validated);

        return redirect()
            ->route('admin.beranda.edit')
            ->with('success', 'Konten beranda, logo situs/favicon, latar belakang situs & login admin, navigasi, footer, serta halaman donasi keuangan & donasi jasa berhasil disimpan.');
    }
}
