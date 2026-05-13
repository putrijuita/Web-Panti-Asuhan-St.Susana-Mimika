@extends('admin.layouts.app')

@section('title', 'Konten halaman Galeri')
@section('page-title', 'Konten halaman Galeri (/galeri)')
@section('page-subtitle', 'Judul hero, filter Semua, album foto, video, CTA — foto & video tetap di Kelola Galeri')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Item foto dan video di halaman publik diatur di <a href="{{ route('admin.galeri.index') }}">Galeri</a> (admin).
            Halaman ini hanya untuk <strong>teks &amp; label kerangka</strong> <a href="{{ route('galeri') }}" target="_blank" rel="noopener">/galeri</a>.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.galeri-page.update') }}">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Judul tab &amp; hero</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="page_meta_title">Judul tab browser</label>
                <input id="page_meta_title" name="page_meta_title" class="form-control" required value="{{ old('page_meta_title', $galeri->page_meta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_icon">Ikon hero (kelas Font Awesome)</label>
                <input id="hero_icon" name="hero_icon" class="form-control" required value="{{ old('hero_icon', $galeri->hero_icon) }}">
                @error('hero_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_title">Judul hero</label>
                <input id="hero_title" name="hero_title" class="form-control" required value="{{ old('hero_title', $galeri->hero_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_subtitle">Paragraf hero</label>
                <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $galeri->hero_subtitle) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="filter_btn_semua">Tombol filter &quot;semua&quot;</label>
                <input id="filter_btn_semua" name="filter_btn_semua" class="form-control" required value="{{ old('filter_btn_semua', $galeri->filter_btn_semua) }}">
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Album foto</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="album_section_icon">Ikon label bagian</label>
                    <input id="album_section_icon" name="album_section_icon" class="form-control" required value="{{ old('album_section_icon', $galeri->album_section_icon) }}">
                    @error('album_section_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="album_section_label">Label pill album</label>
                    <input id="album_section_label" name="album_section_label" class="form-control" required value="{{ old('album_section_label', $galeri->album_section_label) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="album_section_title">Judul blok foto</label>
                <input id="album_section_title" name="album_section_title" class="form-control" required value="{{ old('album_section_title', $galeri->album_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="gallery_overlay_tag">Tag pada overlay foto</label>
                <input id="gallery_overlay_tag" name="gallery_overlay_tag" class="form-control" required value="{{ old('gallery_overlay_tag', $galeri->gallery_overlay_tag) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="gallery_default_caption">Keterangan bawaan bila kosong di data foto</label>
                <textarea id="gallery_default_caption" name="gallery_default_caption" class="form-control" rows="2" required>{{ old('gallery_default_caption', $galeri->gallery_default_caption) }}</textarea>
            </div>
            <hr style="border:none;border-top:1px solid var(--gray-200);margin:12px 0;">
            <p style="font-size:12px;color:var(--gray-500);margin:0 0 8px;">Jika belum ada foto sama sekali</p>
            <div class="form-group">
                <label class="form-label" for="empty_title">Judul</label>
                <input id="empty_title" name="empty_title" class="form-control" required value="{{ old('empty_title', $galeri->empty_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="empty_text">Paragraf</label>
                <textarea id="empty_text" name="empty_text" class="form-control" rows="2" required>{{ old('empty_text', $galeri->empty_text) }}</textarea>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Video</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="video_section_icon">Ikon label bagian</label>
                    <input id="video_section_icon" name="video_section_icon" class="form-control" required value="{{ old('video_section_icon', $galeri->video_section_icon) }}">
                    @error('video_section_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="video_section_label">Label pill</label>
                    <input id="video_section_label" name="video_section_label" class="form-control" required value="{{ old('video_section_label', $galeri->video_section_label) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="video_section_title">Judul blok video</label>
                <input id="video_section_title" name="video_section_title" class="form-control" required value="{{ old('video_section_title', $galeri->video_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="video_section_sub">Paragraf pengantar</label>
                <textarea id="video_section_sub" name="video_section_sub" class="form-control" rows="2" required>{{ old('video_section_sub', $galeri->video_section_sub) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="video_empty_message">Teks jika belum ada video</label>
                <textarea id="video_empty_message" name="video_empty_message" class="form-control" rows="2" required>{{ old('video_empty_message', $galeri->video_empty_message) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="video_browser_unsupported">Teks di dalam tag &lt;video&gt; (browser tidak mendukung)</label>
                <input id="video_browser_unsupported" name="video_browser_unsupported" class="form-control" required value="{{ old('video_browser_unsupported', $galeri->video_browser_unsupported) }}">
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">CTA &amp; lightbox</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="cta_title">Judul CTA</label>
                <input id="cta_title" name="cta_title" class="form-control" required value="{{ old('cta_title', $galeri->cta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="cta_subtitle">Subjudul CTA</label>
                <input id="cta_subtitle" name="cta_subtitle" class="form-control" required value="{{ old('cta_subtitle', $galeri->cta_subtitle) }}">
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_kunjungan">Tombol kunjungan</label>
                    <input id="cta_btn_kunjungan" name="cta_btn_kunjungan" class="form-control" required value="{{ old('cta_btn_kunjungan', $galeri->cta_btn_kunjungan) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_donasi">Tombol donasi</label>
                    <input id="cta_btn_donasi" name="cta_btn_donasi" class="form-control" required value="{{ old('cta_btn_donasi', $galeri->cta_btn_donasi) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="lightbox_close_label">Aria-label tombol tutup lightbox</label>
                <input id="lightbox_close_label" name="lightbox_close_label" class="form-control" required value="{{ old('lightbox_close_label', $galeri->lightbox_close_label) }}">
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('galeri') }}" target="_blank" rel="noopener" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> Lihat /galeri</a>
    </div>
</form>
@endsection
