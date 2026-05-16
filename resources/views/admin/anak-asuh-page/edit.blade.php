@extends('admin.layouts.app')

@section('title', 'Konten halaman Anak Asuh')
@section('page-title', 'Konten halaman Anak Asuh (/anak-asuh)')
@section('page-subtitle', 'Judul layout, hero, pesan kosong — daftar kartu hanya nama panggilan &amp; foto dari Data anak asuh')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Data anak di <a href="{{ route('admin.anak-asuh.index') }}">Data anak asuh</a>.
            Halaman publik <a href="{{ route('anak-asuh') }}" target="_blank" rel="noopener">/anak-asuh</a> hanya menampilkan <strong>foto</strong> dan <strong>nama panggilan</strong>; anak tanpa nama panggilan tidak tampil.
            Blok di bawah mengatur teks hero dan judul layout.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.anak-asuh-page.update') }}">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Judul tab &amp; header layout</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="page_meta_title">Judul tab browser</label>
                <input id="page_meta_title" name="page_meta_title" class="form-control" required value="{{ old('page_meta_title', $page->page_meta_title) }}">
                @error('page_meta_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="layout_page_title">Judul halaman (breadcrumb / judul atas)</label>
                <input id="layout_page_title" name="layout_page_title" class="form-control" required value="{{ old('layout_page_title', $page->layout_page_title) }}">
                @error('layout_page_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="layout_page_subtitle">Subjudul halaman</label>
                <input id="layout_page_subtitle" name="layout_page_subtitle" class="form-control" required value="{{ old('layout_page_subtitle', $page->layout_page_subtitle) }}">
                @error('layout_page_subtitle')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Blok hero (di dalam konten)</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="hero_title">Judul hero</label>
                <input id="hero_title" name="hero_title" class="form-control" required value="{{ old('hero_title', $page->hero_title) }}">
                @error('hero_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_subtitle">Paragraf hero</label>
                <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $page->hero_subtitle) }}</textarea>
                @error('hero_subtitle')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Daftar kosong</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="empty_text">Teks bila tidak ada anak yang ditampilkan</label>
                <textarea id="empty_text" name="empty_text" class="form-control" rows="2" required>{{ old('empty_text', $page->empty_text) }}</textarea>
                @error('empty_text')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan
        </button>
        <a href="{{ route('anak-asuh') }}" target="_blank" rel="noopener" class="btn btn-secondary">
            <i class="fas fa-external-link-alt"></i> Lihat halaman publik
        </a>
    </div>
</form>
@endsection
