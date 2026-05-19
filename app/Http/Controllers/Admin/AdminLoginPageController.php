<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLoginPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AdminLoginPageController extends Controller
{
    public function edit()
    {
        if (! Schema::hasTable('admin_login_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman login belum tersedia. Jalankan migrasi terbaru.');
        }

        $loginPage = AdminLoginPageContent::singleton();
        $loginPage->fillMissingFromDefaults();
        $loginPage->refresh();

        $loginPreviewUrl = request()->getHost() === config('admin.domain')
            ? url('/login')
            : url('admin/login');

        return view('admin.login-page.edit', compact('loginPage', 'loginPreviewUrl'));
    }

    public function update(Request $request)
    {
        if (! Schema::hasTable('admin_login_page_contents')) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Tabel konten halaman login belum tersedia. Jalankan migrasi terbaru.');
        }

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:120'],
            'hero_badge_text' => ['required', 'string', 'max:80'],
            'hero_badge_icon' => ['required', 'string', 'max:120', 'regex:/^[A-Za-z0-9\s\.\-]+$/'],
            'hero_title_prefix' => ['required', 'string', 'max:120'],
            'hero_title_emphasis' => ['required', 'string', 'max:120'],
            'hero_description' => ['required', 'string', 'max:600'],
            'use_site_body_background' => ['nullable', 'boolean'],
            'hero_image' => ['nullable', 'image', 'max:5120'],
            'remove_hero_image' => ['nullable', 'boolean'],
            'form_title' => ['required', 'string', 'max:120'],
            'form_subtitle' => ['required', 'string', 'max:300'],
            'email_label' => ['required', 'string', 'max:80'],
            'email_placeholder' => ['required', 'string', 'max:120'],
            'password_label' => ['required', 'string', 'max:80'],
            'password_placeholder' => ['required', 'string', 'max:80'],
            'remember_label' => ['required', 'string', 'max:120'],
            'forgot_password_label' => ['required', 'string', 'max:120'],
            'forgot_password_url' => ['required', 'string', 'max:255'],
            'submit_text' => ['required', 'string', 'max:80'],
            'footer_link_text' => ['required', 'string', 'max:120'],
            'cms_note_admin' => ['required', 'string', 'max:800'],
            'cms_note_super_admin' => ['required', 'string', 'max:800'],
        ]);

        $row = AdminLoginPageContent::singleton();

        $imagePath = $row->hero_image;
        if ($request->hasFile('hero_image')) {
            if ($row->hero_image && ! str_starts_with((string) $row->hero_image, 'http') && Storage::disk('public')->exists($row->hero_image)) {
                Storage::disk('public')->delete($row->hero_image);
            }
            $imagePath = $request->file('hero_image')->store('site/admin-login', 'public');
        } elseif ($request->boolean('remove_hero_image')) {
            if ($row->hero_image && ! str_starts_with((string) $row->hero_image, 'http') && Storage::disk('public')->exists($row->hero_image)) {
                Storage::disk('public')->delete($row->hero_image);
            }
            $imagePath = null;
        }

        unset($validated['hero_image'], $validated['remove_hero_image']);
        $validated['hero_image'] = $imagePath;
        $validated['use_site_body_background'] = $request->boolean('use_site_body_background');

        $row->update($validated);

        return redirect()
            ->route('admin.login-page.edit')
            ->with('success', 'Konten halaman login admin berhasil disimpan.');
    }
}
