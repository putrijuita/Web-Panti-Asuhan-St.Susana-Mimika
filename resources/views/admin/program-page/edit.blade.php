@extends('admin.layouts.app')

@section('title', 'Konten halaman Kegiatan')
@section('page-title', 'Konten halaman Kegiatan (/program)')
@section('page-subtitle', 'Teks hero, judul bagian, tombol donasi pada kartu unggulan, langkah terlibat, CTA — data kartu kegiatan tetap di Manajemen Kegiatan')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Daftar kegiatan (gambar, nama, deskripsi) diatur di <a href="{{ route('admin.kegiatan.index') }}">Manajemen Kegiatan</a>.
            Halaman ini hanya untuk <strong>teks bingkai halaman</strong> publik <a href="{{ route('program') }}" target="_blank" rel="noopener">/program</a>.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.program-page.update') }}">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Judul tab &amp; hero</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="page_meta_title">Judul tab browser</label>
                <input id="page_meta_title" name="page_meta_title" class="form-control" required value="{{ old('page_meta_title', $program->page_meta_title) }}">
                @error('page_meta_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_title">Judul hero</label>
                <input id="hero_title" name="hero_title" class="form-control" required value="{{ old('hero_title', $program->hero_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_subtitle">Paragraf hero</label>
                <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $program->hero_subtitle) }}</textarea>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Bagian Program Unggulan</span></div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="unggul_section_label">Label pill</label>
                    <input id="unggul_section_label" name="unggul_section_label" class="form-control" required value="{{ old('unggul_section_label', $program->unggul_section_label) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="unggul_fallback_icon">Ikon fallback (tanpa gambar)</label>
                    <input id="unggul_fallback_icon" name="unggul_fallback_icon" class="form-control" required value="{{ old('unggul_fallback_icon', $program->unggul_fallback_icon) }}">
                    @error('unggul_fallback_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="unggul_section_title">Judul blok</label>
                <input id="unggul_section_title" name="unggul_section_title" class="form-control" required value="{{ old('unggul_section_title', $program->unggul_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="unggul_section_sub">Subjudul</label>
                <textarea id="unggul_section_sub" name="unggul_section_sub" class="form-control" rows="2" required>{{ old('unggul_section_sub', $program->unggul_section_sub) }}</textarea>
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="unggul_eyebrow">Teks eyebrow di kartu</label>
                    <input id="unggul_eyebrow" name="unggul_eyebrow" class="form-control" required value="{{ old('unggul_eyebrow', $program->unggul_eyebrow) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="unggul_chip">Label chip</label>
                    <input id="unggul_chip" name="unggul_chip" class="form-control" required value="{{ old('unggul_chip', $program->unggul_chip) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="unggul_default_desc">Deskripsi bawaan bila kegiatan tanpa deskripsi</label>
                <textarea id="unggul_default_desc" name="unggul_default_desc" class="form-control" rows="2" required>{{ old('unggul_default_desc', $program->unggul_default_desc) }}</textarea>
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="unggul_donate_btn">Teks tombol donasi</label>
                    <input id="unggul_donate_btn" name="unggul_donate_btn" class="form-control" required value="{{ old('unggul_donate_btn', $program->unggul_donate_btn) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="unggul_donate_hint">Teks kecil di samping</label>
                    <input id="unggul_donate_hint" name="unggul_donate_hint" class="form-control" required value="{{ old('unggul_donate_hint', $program->unggul_donate_hint) }}">
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Bagian Kegiatan Rutin</span></div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="rutin_section_label">Label pill</label>
                    <input id="rutin_section_label" name="rutin_section_label" class="form-control" required value="{{ old('rutin_section_label', $program->rutin_section_label) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="rutin_fallback_icon">Ikon fallback kartu</label>
                    <input id="rutin_fallback_icon" name="rutin_fallback_icon" class="form-control" required value="{{ old('rutin_fallback_icon', $program->rutin_fallback_icon) }}">
                    @error('rutin_fallback_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="rutin_section_title">Judul blok</label>
                <input id="rutin_section_title" name="rutin_section_title" class="form-control" required value="{{ old('rutin_section_title', $program->rutin_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="rutin_section_sub">Subjudul</label>
                <textarea id="rutin_section_sub" name="rutin_section_sub" class="form-control" rows="2" required>{{ old('rutin_section_sub', $program->rutin_section_sub) }}</textarea>
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="rutin_pill">Teks pill pada gambar</label>
                    <input id="rutin_pill" name="rutin_pill" class="form-control" required value="{{ old('rutin_pill', $program->rutin_pill) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="rutin_eyebrow">Teks eyebrow kartu</label>
                    <input id="rutin_eyebrow" name="rutin_eyebrow" class="form-control" required value="{{ old('rutin_eyebrow', $program->rutin_eyebrow) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="rutin_default_desc">Deskripsi bawaan bila kosong</label>
                <textarea id="rutin_default_desc" name="rutin_default_desc" class="form-control" rows="2" required>{{ old('rutin_default_desc', $program->rutin_default_desc) }}</textarea>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Jika belum ada kegiatan</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="empty_section_label">Label pill</label>
                <input id="empty_section_label" name="empty_section_label" class="form-control" required value="{{ old('empty_section_label', $program->empty_section_label) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="empty_section_title">Judul</label>
                <input id="empty_section_title" name="empty_section_title" class="form-control" required value="{{ old('empty_section_title', $program->empty_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="empty_section_sub">Paragraf</label>
                <textarea id="empty_section_sub" name="empty_section_sub" class="form-control" rows="2" required>{{ old('empty_section_sub', $program->empty_section_sub) }}</textarea>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Cara terlibat (4 langkah)</span></div>
        <div class="card-body">
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="involve_section_label">Label pill</label>
                    <input id="involve_section_label" name="involve_section_label" class="form-control" required value="{{ old('involve_section_label', $program->involve_section_label) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="involve_section_title">Judul blok</label>
                    <input id="involve_section_title" name="involve_section_title" class="form-control" required value="{{ old('involve_section_title', $program->involve_section_title) }}">
                </div>
            </div>
            @php $steps = old('involve_steps', $program->involve_steps ?? \App\Models\ProgramPageContent::defaultInvolveSteps()); @endphp
            @for($i = 0; $i < 4; $i++)
                @php $s = $steps[$i] ?? ['title' => '', 'text' => '']; @endphp
                <div class="admin-form-row-box admin-grid-prog-head admin-mb-10">
                    <span style="font-weight:800;color:var(--primary-dark);text-align:center;">{{ $i + 1 }}</span>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label" style="font-size:11px;">Judul</label>
                        <input name="involve_steps[{{ $i }}][title]" class="form-control" required value="{{ old("involve_steps.$i.title", $s['title'] ?? '') }}">
                        @error("involve_steps.$i.title")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label" style="font-size:11px;">Teks</label>
                        <input name="involve_steps[{{ $i }}][text]" class="form-control" required value="{{ old("involve_steps.$i.text", $s['text'] ?? '') }}">
                        @error("involve_steps.$i.text")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">CTA bawah halaman</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="cta_title">Judul</label>
                <input id="cta_title" name="cta_title" class="form-control" required value="{{ old('cta_title', $program->cta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="cta_subtitle">Subjudul</label>
                <input id="cta_subtitle" name="cta_subtitle" class="form-control" required value="{{ old('cta_subtitle', $program->cta_subtitle) }}">
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_donasi">Tombol donasi</label>
                    <input id="cta_btn_donasi" name="cta_btn_donasi" class="form-control" required value="{{ old('cta_btn_donasi', $program->cta_btn_donasi) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_kunjungan">Tombol kunjungan</label>
                    <input id="cta_btn_kunjungan" name="cta_btn_kunjungan" class="form-control" required value="{{ old('cta_btn_kunjungan', $program->cta_btn_kunjungan) }}">
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('program') }}" target="_blank" rel="noopener" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> Lihat /program</a>
    </div>
</form>
@endsection
