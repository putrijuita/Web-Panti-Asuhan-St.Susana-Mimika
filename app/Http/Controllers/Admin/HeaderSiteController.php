<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HeaderSiteController extends Controller
{
    public function edit()
    {
        if (! Schema::hasTable('site_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten situs belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        if (! Schema::hasColumn('site_contents', 'header_navigation')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Kolom navigasi header belum ada. Jalankan migrasi terbaru.');
        }

        $site = SiteContent::singleton();
        $includeAnakAsuhMenu = Schema::hasColumn('site_contents', 'nav_anak_asuh');
        $siteLogoCmsReady = Schema::hasColumn('site_contents', 'site_logo');

        $draft = old('hn');
        if (! is_array($draft)) {
            $raw = $site->header_navigation;
            $draft = is_array($raw) ? $raw : null;
        }
        $headerNavigationForm = SiteContent::coerceHeaderNavigationForAdmin($draft, $site, $includeAnakAsuhMenu);
        $headerRouteOptions = SiteContent::footerPublicRouteOptions();

        return view('admin.header-site.edit', compact('site', 'headerNavigationForm', 'headerRouteOptions', 'siteLogoCmsReady'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('site_contents') || ! Schema::hasColumn('site_contents', 'header_navigation')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Penyimpanan navigasi header tidak tersedia. Jalankan migrasi terbaru.');
        }

        $routes = SiteContent::footerPublicRouteNames();
        $routeRule = Rule::in($routes);

        $rules = [
            'nav_brand_suffix' => ['required', 'string', 'max:120'],
            'hn' => ['required', 'array'],
            'hn.items' => ['required', 'array', 'min:1', 'max:'.SiteContent::HEADER_ITEMS_MAX],
            'hn.items.*.label' => ['required', 'string', 'max:80'],
            'hn.items.*.href_type' => ['required', 'in:route,url'],
            'hn.items.*.route' => ['nullable', 'string', 'max:120', $routeRule],
            'hn.items.*.href' => ['nullable', 'string', 'max:2000'],
            'hn.items.*.style' => ['required', 'in:link,cta'],
        ];

        if (Schema::hasColumn('site_contents', 'site_logo')) {
            $rules['site_logo'] = ['nullable', 'image', 'max:3072'];
            $rules['remove_site_logo'] = ['nullable', 'boolean'];
        }

        $validated = $request->validate($rules);

        $filtered = SiteContent::filterHeaderNavEmptyRows($validated['hn']);
        SiteContent::assertHeaderNavigationValid($filtered);

        $site = SiteContent::singleton();
        $includeAnakAsuhMenu = Schema::hasColumn('site_contents', 'nav_anak_asuh');

        $payload = SiteContent::syncNavTextColumnsFromHeaderItems($filtered['items'], $includeAnakAsuhMenu);
        $payload['nav_brand_suffix'] = $validated['nav_brand_suffix'];
        $payload['header_navigation'] = SiteContent::sanitizeHeaderNavigationForStorage($filtered);

        if (Schema::hasColumn('site_contents', 'site_logo')) {
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
            $payload['site_logo'] = $siteLogoPath;
        }

        $site->update($payload);

        return redirect()
            ->route('admin.header-site.edit')
            ->with('success', 'Header situs (logo, nama merek, dan menu atas) berhasil disimpan.');
    }
}
