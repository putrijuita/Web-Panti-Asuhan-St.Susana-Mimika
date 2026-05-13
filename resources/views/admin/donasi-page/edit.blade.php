@extends('admin.layouts.app')

@section('title', 'Konten halaman Donasi')
@section('page-title', 'Konten halaman Donasi (/donasi)')
@section('page-subtitle', 'Hero, kartu donasi keuangan & jasa, transparansi, unduh laporan')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Navigasi, footer situs, serta <strong>teks halaman /donasi/keuangan</strong> dan <strong>/donasi/jasa</strong> diatur di
            <a href="{{ route('admin.beranda.edit') }}">Konten Beranda &amp; Situs</a>.
            Data donasi &amp; grafik di halaman ini dari database transaksi; di sini hanya <strong>teks, ikon, dan gambar hero</strong> halaman <code>/donasi</code>.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.donasi-page.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Judul tab &amp; hero</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="page_meta_title">Judul tab browser</label>
                <input id="page_meta_title" name="page_meta_title" class="form-control" required value="{{ old('page_meta_title', $donasi->page_meta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_image">Gambar hero (opsional)</label>
                @if($donasi->hero_image)
                    <div style="margin-bottom:8px;">
                        <img src="{{ asset('storage/'.$donasi->hero_image) }}" alt="" style="max-width:280px;border-radius:8px;border:1px solid var(--gray-200);">
                    </div>
                    <label style="display:flex;align-items:center;gap:8px;font-size:13px;margin-bottom:8px;">
                        <input type="checkbox" name="remove_hero_image" value="1"> Hapus gambar
                    </label>
                @endif
                <input id="hero_image" name="hero_image" type="file" class="form-control" accept="image/*">
                @error('hero_image')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Lencana atas</p>
            <div class="admin-grid-5-badge">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="hero_badge_keuangan_icon">Ikon lencana keuangan</label>
                    <input id="hero_badge_keuangan_icon" name="hero_badge_keuangan_icon" class="form-control" required value="{{ old('hero_badge_keuangan_icon', $donasi->hero_badge_keuangan_icon) }}">
                    @error('hero_badge_keuangan_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="hero_badge_keuangan_text">Teks</label>
                    <input id="hero_badge_keuangan_text" name="hero_badge_keuangan_text" class="form-control" required value="{{ old('hero_badge_keuangan_text', $donasi->hero_badge_keuangan_text) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="hero_badge_separator">Pemisah</label>
                    <input id="hero_badge_separator" name="hero_badge_separator" class="form-control" required value="{{ old('hero_badge_separator', $donasi->hero_badge_separator) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="hero_badge_jasa_icon">Ikon lencana jasa</label>
                    <input id="hero_badge_jasa_icon" name="hero_badge_jasa_icon" class="form-control" required value="{{ old('hero_badge_jasa_icon', $donasi->hero_badge_jasa_icon) }}">
                    @error('hero_badge_jasa_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="hero_badge_jasa_text">Teks</label>
                    <input id="hero_badge_jasa_text" name="hero_badge_jasa_text" class="form-control" required value="{{ old('hero_badge_jasa_text', $donasi->hero_badge_jasa_text) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_title_line1">Baris judul utama (atas)</label>
                <input id="hero_title_line1" name="hero_title_line1" class="form-control" required value="{{ old('hero_title_line1', $donasi->hero_title_line1) }}">
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="hero_word_red">Kata sorot merah/aksen</label>
                    <input id="hero_word_red" name="hero_word_red" class="form-control" required value="{{ old('hero_word_red', $donasi->hero_word_red) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="hero_word_green">Kata sorot hijau</label>
                    <input id="hero_word_green" name="hero_word_green" class="form-control" required value="{{ old('hero_word_green', $donasi->hero_word_green) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_subtitle">Paragraf (HTML sederhana diperbolehkan)</label>
                <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $donasi->hero_subtitle) }}</textarea>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Kartu Donasi Keuangan</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="card_keu_top_icon">Ikon besar atas kartu</label>
                <input id="card_keu_top_icon" name="card_keu_top_icon" class="form-control" required value="{{ old('card_keu_top_icon', $donasi->card_keu_top_icon) }}">
                @error('card_keu_top_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;"><label class="form-label" for="card_keu_pill">Label pill</label><input id="card_keu_pill" name="card_keu_pill" class="form-control" required value="{{ old('card_keu_pill', $donasi->card_keu_pill) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="card_keu_title">Judul</label><input id="card_keu_title" name="card_keu_title" class="form-control" required value="{{ old('card_keu_title', $donasi->card_keu_title) }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label" for="card_keu_intro">Pengantar</label>
                <textarea id="card_keu_intro" name="card_keu_intro" class="form-control" rows="2" required>{{ old('card_keu_intro', $donasi->card_keu_intro) }}</textarea>
            </div>
            @for ($i = 1; $i <= 4; $i++)
                <div class="form-group">
                    <label class="form-label" for="card_keu_feat{{ $i }}">Poin {{ $i }}</label>
                    <input id="card_keu_feat{{ $i }}" name="card_keu_feat{{ $i }}" class="form-control" required value="{{ old('card_keu_feat'.$i, $donasi->{'card_keu_feat'.$i}) }}">
                </div>
            @endfor
            <div class="form-group">
                <label class="form-label" for="card_keu_cta">Teks tombol CTA</label>
                <input id="card_keu_cta" name="card_keu_cta" class="form-control" required value="{{ old('card_keu_cta', $donasi->card_keu_cta) }}">
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Kartu Donasi Jasa</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="card_jasa_top_icon">Ikon besar atas kartu</label>
                <input id="card_jasa_top_icon" name="card_jasa_top_icon" class="form-control" required value="{{ old('card_jasa_top_icon', $donasi->card_jasa_top_icon) }}">
                @error('card_jasa_top_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;"><label class="form-label" for="card_jasa_pill">Label pill</label><input id="card_jasa_pill" name="card_jasa_pill" class="form-control" required value="{{ old('card_jasa_pill', $donasi->card_jasa_pill) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="card_jasa_title">Judul</label><input id="card_jasa_title" name="card_jasa_title" class="form-control" required value="{{ old('card_jasa_title', $donasi->card_jasa_title) }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label" for="card_jasa_intro">Pengantar</label>
                <textarea id="card_jasa_intro" name="card_jasa_intro" class="form-control" rows="2" required>{{ old('card_jasa_intro', $donasi->card_jasa_intro) }}</textarea>
            </div>
            @for ($i = 1; $i <= 4; $i++)
                <div class="form-group">
                    <label class="form-label" for="card_jasa_feat{{ $i }}">Poin {{ $i }}</label>
                    <input id="card_jasa_feat{{ $i }}" name="card_jasa_feat{{ $i }}" class="form-control" required value="{{ old('card_jasa_feat'.$i, $donasi->{'card_jasa_feat'.$i}) }}">
                </div>
            @endfor
            <div class="form-group">
                <label class="form-label" for="card_jasa_cta">Teks tombol CTA</label>
                <input id="card_jasa_cta" name="card_jasa_cta" class="form-control" required value="{{ old('card_jasa_cta', $donasi->card_jasa_cta) }}">
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Transparansi &amp; grafik</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="section_grafik_icon">Ikon judul blok grafik</label>
                    <input id="section_grafik_icon" name="section_grafik_icon" class="form-control" required value="{{ old('section_grafik_icon', $donasi->section_grafik_icon) }}">
                    @error('section_grafik_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="section_grafik_title">Judul blok grafik</label>
                    <input id="section_grafik_title" name="section_grafik_title" class="form-control" required value="{{ old('section_grafik_title', $donasi->section_grafik_title) }}">
                </div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Label tiga kartu angka</p>
            <div class="admin-grid-3">
                <div class="form-group" style="margin:0;"><label class="form-label" for="stat_lbl_pemasukan">Pemasukan</label><input id="stat_lbl_pemasukan" name="stat_lbl_pemasukan" class="form-control" required value="{{ old('stat_lbl_pemasukan', $donasi->stat_lbl_pemasukan) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="stat_lbl_pengeluaran">Pengeluaran</label><input id="stat_lbl_pengeluaran" name="stat_lbl_pengeluaran" class="form-control" required value="{{ old('stat_lbl_pengeluaran', $donasi->stat_lbl_pengeluaran) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="stat_lbl_sisa">Sisa saldo</label><input id="stat_lbl_sisa" name="stat_lbl_sisa" class="form-control" required value="{{ old('stat_lbl_sisa', $donasi->stat_lbl_sisa) }}"></div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Legenda grafik (Chart.js)</p>
            <div class="admin-grid-3">
                <div class="form-group" style="margin:0;"><label class="form-label" for="chart_lbl_pemasukan">Legenda pemasukan</label><input id="chart_lbl_pemasukan" name="chart_lbl_pemasukan" class="form-control" required value="{{ old('chart_lbl_pemasukan', $donasi->chart_lbl_pemasukan) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="chart_lbl_pengeluaran">Legenda pengeluaran</label><input id="chart_lbl_pengeluaran" name="chart_lbl_pengeluaran" class="form-control" required value="{{ old('chart_lbl_pengeluaran', $donasi->chart_lbl_pengeluaran) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="chart_lbl_sisa">Legenda sisa saldo</label><input id="chart_lbl_sisa" name="chart_lbl_sisa" class="form-control" required value="{{ old('chart_lbl_sisa', $donasi->chart_lbl_sisa) }}"></div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Tabel donatur</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="section_table_icon">Ikon judul</label>
                    <input id="section_table_icon" name="section_table_icon" class="form-control" required value="{{ old('section_table_icon', $donasi->section_table_icon) }}">
                    @error('section_table_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="section_table_title">Judul blok</label>
                    <input id="section_table_title" name="section_table_title" class="form-control" required value="{{ old('section_table_title', $donasi->section_table_title) }}">
                </div>
            </div>
            <div class="admin-grid-4">
                <div class="form-group" style="margin:0;"><label class="form-label" for="tbl_th_nama">Kolom 1</label><input id="tbl_th_nama" name="tbl_th_nama" class="form-control" required value="{{ old('tbl_th_nama', $donasi->tbl_th_nama) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="tbl_th_email">Kolom 2</label><input id="tbl_th_email" name="tbl_th_email" class="form-control" required value="{{ old('tbl_th_email', $donasi->tbl_th_email) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="tbl_th_nominal">Kolom 3</label><input id="tbl_th_nominal" name="tbl_th_nominal" class="form-control" required value="{{ old('tbl_th_nominal', $donasi->tbl_th_nominal) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="tbl_th_waktu">Kolom 4</label><input id="tbl_th_waktu" name="tbl_th_waktu" class="form-control" required value="{{ old('tbl_th_waktu', $donasi->tbl_th_waktu) }}"></div>
            </div>
            <div class="form-group">
                <label class="form-label" for="tbl_empty_msg">Teks jika belum ada data</label>
                <input id="tbl_empty_msg" name="tbl_empty_msg" class="form-control" required value="{{ old('tbl_empty_msg', $donasi->tbl_empty_msg) }}">
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Unduh laporan</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="dl1_text">Teks kartu laporan donasi</label>
                <textarea id="dl1_text" name="dl1_text" class="form-control" rows="2" required>{{ old('dl1_text', $donasi->dl1_text) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="dl1_btn">Label tombol</label>
                <input id="dl1_btn" name="dl1_btn" class="form-control" required value="{{ old('dl1_btn', $donasi->dl1_btn) }}">
            </div>
            <hr style="border:none;border-top:1px solid var(--gray-200);margin:16px 0;">
            <div class="form-group">
                <label class="form-label" for="dl2_text">Teks kartu laporan pengelolaan</label>
                <textarea id="dl2_text" name="dl2_text" class="form-control" rows="2" required>{{ old('dl2_text', $donasi->dl2_text) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="dl2_btn">Label tombol</label>
                <input id="dl2_btn" name="dl2_btn" class="form-control" required value="{{ old('dl2_btn', $donasi->dl2_btn) }}">
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('donasi.index') }}" target="_blank" rel="noopener" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> Lihat /donasi</a>
    </div>
</form>
@endsection
