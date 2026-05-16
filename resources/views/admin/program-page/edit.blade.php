@extends('admin.layouts.app')

@section('title', 'Konten halaman Jadwal (/program)')
@section('page-title', 'Konten halaman Jadwal kegiatan anak (/program)')
@section('page-subtitle', 'Teks hero, judul blok jadwal, pesan kosong, dan CTA — isi jadwal di Data &amp; aset → Jadwal kegiatan anak')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Entri jadwal (hari, jam, judul, lokasi, aktif/nonaktif) diatur di
            <a href="{{ route('admin.jadwal-anak.index') }}">Data jadwal kegiatan anak</a>.
            Halaman ini hanya untuk <strong>teks tampilan</strong> publik
            <a href="{{ route('program') }}" target="_blank" rel="noopener">/program</a>.
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
                @error('hero_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_subtitle">Paragraf hero</label>
                <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $program->hero_subtitle) }}</textarea>
                @error('hero_subtitle')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Blok jadwal (di atas grid)</span></div>
        <div class="card-body">
            <p style="font-size:12px;color:var(--gray-500);margin:0 0 12px;">Ditampilkan hanya jika ada jadwal aktif.</p>
            <div class="form-group">
                <label class="form-label" for="rutin_section_label">Label pill</label>
                <input id="rutin_section_label" name="rutin_section_label" class="form-control" required value="{{ old('rutin_section_label', $program->rutin_section_label) }}">
                @error('rutin_section_label')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="rutin_section_title">Judul blok</label>
                <input id="rutin_section_title" name="rutin_section_title" class="form-control" required value="{{ old('rutin_section_title', $program->rutin_section_title) }}">
                @error('rutin_section_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="rutin_section_sub">Subjudul / penjelasan singkat</label>
                <textarea id="rutin_section_sub" name="rutin_section_sub" class="form-control" rows="2" required>{{ old('rutin_section_sub', $program->rutin_section_sub) }}</textarea>
                @error('rutin_section_sub')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Jika belum ada jadwal aktif</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="empty_section_label">Label pill</label>
                <input id="empty_section_label" name="empty_section_label" class="form-control" required value="{{ old('empty_section_label', $program->empty_section_label) }}">
                @error('empty_section_label')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="empty_section_title">Judul</label>
                <input id="empty_section_title" name="empty_section_title" class="form-control" required value="{{ old('empty_section_title', $program->empty_section_title) }}">
                @error('empty_section_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="empty_section_sub">Paragraf</label>
                <textarea id="empty_section_sub" name="empty_section_sub" class="form-control" rows="2" required>{{ old('empty_section_sub', $program->empty_section_sub) }}</textarea>
                @error('empty_section_sub')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">CTA bawah halaman</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="cta_title">Judul</label>
                <input id="cta_title" name="cta_title" class="form-control" required value="{{ old('cta_title', $program->cta_title) }}">
                @error('cta_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="cta_subtitle">Subjudul</label>
                <input id="cta_subtitle" name="cta_subtitle" class="form-control" required value="{{ old('cta_subtitle', $program->cta_subtitle) }}">
                @error('cta_subtitle')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_donasi">Tombol donasi</label>
                    <input id="cta_btn_donasi" name="cta_btn_donasi" class="form-control" required value="{{ old('cta_btn_donasi', $program->cta_btn_donasi) }}">
                    @error('cta_btn_donasi')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_kunjungan">Tombol kunjungan</label>
                    <input id="cta_btn_kunjungan" name="cta_btn_kunjungan" class="form-control" required value="{{ old('cta_btn_kunjungan', $program->cta_btn_kunjungan) }}">
                    @error('cta_btn_kunjungan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
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
