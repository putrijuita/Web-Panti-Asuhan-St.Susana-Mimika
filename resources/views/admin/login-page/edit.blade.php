@extends('admin.layouts.app')

@section('title', 'Konten halaman login')
@section('page-title', 'Halaman login admin')
@section('page-subtitle', 'Teks dan gambar login — dipakai akun Admin & Super Admin (URL sama)')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            <strong>Admin</strong> dan <strong>Super Admin</strong> masuk lewat URL yang sama.
            Pratinjau: <a href="{{ $loginPreviewUrl }}" target="_blank" rel="noopener">{{ $loginPreviewUrl }}</a>
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.login-page.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:16px;border-color:#bae6fd;background:var(--gray-50);">
        <div class="card-header"><span class="card-title">Catatan peran (hanya di panel CMS)</span></div>
        <div class="card-body">
            <p style="font-size:12px;color:var(--gray-500);margin:0 0 12px;">Teks di bawah tidak ditampilkan di halaman login publik — untuk dokumentasi tim.</p>
            <div class="form-group">
                <label class="form-label" for="cms_note_admin">Penjelasan peran Admin</label>
                <textarea id="cms_note_admin" name="cms_note_admin" class="form-control" rows="2" required>{{ old('cms_note_admin', $loginPage->cms_note_admin) }}</textarea>
                @error('cms_note_admin')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="cms_note_super_admin">Penjelasan peran Super Admin</label>
                <textarea id="cms_note_super_admin" name="cms_note_super_admin" class="form-control" rows="2" required>{{ old('cms_note_super_admin', $loginPage->cms_note_super_admin) }}</textarea>
                @error('cms_note_super_admin')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Judul tab browser</span></div>
        <div class="card-body">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="page_title">Judul tab</label>
                <input id="page_title" name="page_title" class="form-control" required maxlength="120" value="{{ old('page_title', $loginPage->page_title) }}">
                @error('page_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Panel kiri (hero)</span></div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-bottom:12px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="hero_badge_text">Label badge</label>
                    <input id="hero_badge_text" name="hero_badge_text" class="form-control" required value="{{ old('hero_badge_text', $loginPage->hero_badge_text) }}">
                    @error('hero_badge_text')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="hero_badge_icon">Ikon badge (Font Awesome)</label>
                    <input id="hero_badge_icon" name="hero_badge_icon" class="form-control" required value="{{ old('hero_badge_icon', $loginPage->hero_badge_icon) }}" placeholder="fas fa-shield-halved">
                    @error('hero_badge_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="hero_title_prefix">Judul — bagian pertama</label>
                    <input id="hero_title_prefix" name="hero_title_prefix" class="form-control" required value="{{ old('hero_title_prefix', $loginPage->hero_title_prefix) }}">
                    @error('hero_title_prefix')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="hero_title_emphasis">Judul — bagian miring</label>
                    <input id="hero_title_emphasis" name="hero_title_emphasis" class="form-control" required value="{{ old('hero_title_emphasis', $loginPage->hero_title_emphasis) }}">
                    @error('hero_title_emphasis')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_description">Paragraf deskripsi</label>
                <textarea id="hero_description" name="hero_description" class="form-control" rows="3" required>{{ old('hero_description', $loginPage->hero_description) }}</textarea>
                @error('hero_description')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;margin-bottom:12px;">
                    <input type="hidden" name="use_site_body_background" value="0">
                    <input type="checkbox" name="use_site_body_background" value="1" {{ old('use_site_body_background', $loginPage->use_site_body_background) ? 'checked' : '' }}>
                    Pakai gambar latar situs dari <a href="{{ route('admin.beranda.edit') }}">Beranda &amp; footer</a>
                </label>
            </div>
            @if($loginPage->use_site_body_background)
                @include('admin.partials.cms-current-file', [
                    'url' => \App\Models\SiteContent::bodyBackgroundUrl() ?: null,
                    'label' => 'Latar hero login (dari situs)',
                    'caption' => 'Mengikuti pengaturan latar di Beranda & footer.',
                    'maxWidth' => '100%',
                ])
            @elseif($loginPage->hero_image)
                @include('admin.partials.cms-current-file', [
                    'url' => \App\Models\AdminLoginPageContent::heroBackgroundUrl($loginPage),
                    'path' => $loginPage->hero_image,
                    'label' => 'Latar hero login (khusus)',
                    'maxWidth' => '100%',
                ])
            @endif
            <div class="form-group">
                <label class="form-label" for="hero_image">Gambar latar khusus login (jika tidak memakai latar situs)</label>
                <input id="hero_image" type="file" name="hero_image" class="form-control" accept="image/jpeg,image/png,image/webp,image/gif">
                @error('hero_image')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            @if($loginPage->hero_image)
            <div class="form-group" style="margin-bottom:0;">
                <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;">
                    <input type="hidden" name="remove_hero_image" value="0">
                    <input type="checkbox" name="remove_hero_image" value="1" {{ old('remove_hero_image') ? 'checked' : '' }}>
                    Hapus gambar latar khusus login
                </label>
            </div>
            @endif
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Formulir masuk (panel kanan)</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="form_title">Judul form</label>
                <input id="form_title" name="form_title" class="form-control" required value="{{ old('form_title', $loginPage->form_title) }}">
                @error('form_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="form_subtitle">Subjudul form</label>
                <input id="form_subtitle" name="form_subtitle" class="form-control" required value="{{ old('form_subtitle', $loginPage->form_subtitle) }}">
                @error('form_subtitle')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="email_label">Label email</label>
                    <input id="email_label" name="email_label" class="form-control" required value="{{ old('email_label', $loginPage->email_label) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="email_placeholder">Placeholder email</label>
                    <input id="email_placeholder" name="email_placeholder" class="form-control" required value="{{ old('email_placeholder', $loginPage->email_placeholder) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="password_label">Label kata sandi</label>
                    <input id="password_label" name="password_label" class="form-control" required value="{{ old('password_label', $loginPage->password_label) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="password_placeholder">Placeholder kata sandi</label>
                    <input id="password_placeholder" name="password_placeholder" class="form-control" required value="{{ old('password_placeholder', $loginPage->password_placeholder) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="remember_label">Label &quot;Ingat saya&quot;</label>
                    <input id="remember_label" name="remember_label" class="form-control" required value="{{ old('remember_label', $loginPage->remember_label) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="forgot_password_label">Label lupa kata sandi</label>
                    <input id="forgot_password_label" name="forgot_password_label" class="form-control" required maxlength="120" value="{{ old('forgot_password_label', $loginPage->forgot_password_label) }}">
                    @error('forgot_password_label')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="forgot_password_url">URL lupa kata sandi</label>
                    <input id="forgot_password_url" name="forgot_password_url" class="form-control" required maxlength="255" value="{{ old('forgot_password_url', $loginPage->forgot_password_url) }}" placeholder="forgot-password atau https://…">
                    <small style="color:var(--gray-500);font-size:12px;">Path relatif (<code>forgot-password</code>) atau URL lengkap. Subdomain admin: <code>/forgot-password</code>; domain utama: <code>/admin/forgot-password</code>.</small>
                    @error('forgot_password_url')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="submit_text">Teks tombol masuk</label>
                    <input id="submit_text" name="submit_text" class="form-control" required value="{{ old('submit_text', $loginPage->submit_text) }}">
                </div>
            </div>
            <div class="form-group" style="margin-top:12px;margin-bottom:0;">
                <label class="form-label" for="footer_link_text">Teks tautan bawah</label>
                <input id="footer_link_text" name="footer_link_text" class="form-control" required value="{{ old('footer_link_text', $loginPage->footer_link_text) }}">
                @error('footer_link_text')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan konten login</button>
            <a href="{{ $loginPreviewUrl }}" target="_blank" rel="noopener" class="btn btn-secondary" style="margin-left:8px;"><i class="fas fa-external-link-alt"></i> Buka halaman login</a>
        </div>
    </div>
</form>
@endsection
