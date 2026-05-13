@extends('admin.layouts.app')

@section('title', 'Konten Beranda & Situs')
@section('page-title', 'Konten Beranda & Situs')
@section('page-subtitle', 'Sambutan hero, ringkasan Tentang, navigasi, footer, kontak, donasi keuangan & donasi jasa — tersimpan di database')

@section('content')
<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 22px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Semua blok utama <strong>halaman beranda</strong> publik dapat diatur di halaman ini.
            Konten teks halaman <strong>/donasi/keuangan</strong> dan <strong>/donasi/jasa</strong> juga disimpan di sini (kolom JSON pada konten situs).
            Untuk isi halaman <strong>Tentang</strong> lengkap (hero halaman, visi, misi), gunakan menu
            <a href="{{ route('admin.tentang.edit') }}">Konten Tentang</a>.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.beranda.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Sambutan hero (atas beranda)</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="hero_kicker">Label kecil di atas judul (opsional)</label>
                <input id="hero_kicker" type="text" name="hero_kicker" class="form-control" value="{{ old('hero_kicker', $tentang->hero_kicker) }}" placeholder="Contoh: Yayasan Peduli Kasih Mimika">
                @error('hero_kicker')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_title">Judul utama</label>
                <input id="hero_title" type="text" name="hero_title" class="form-control" required value="{{ old('hero_title', $tentang->hero_title) }}">
                @error('hero_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_description">Deskripsi / paragraf sambutan</label>
                <textarea id="hero_description" name="hero_description" class="form-control" rows="5" required>{{ old('hero_description', $tentang->hero_description) }}</textarea>
                @error('hero_description')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Logo situs &amp; ikon tab (favicon)</span></div>
        <div class="card-body">
            @if(!empty($siteLogoCmsReady))
                <p style="font-size:13px;color:var(--gray-600);margin-bottom:12px;line-height:1.55;">
                    Unggah logo (mis. huruf SS atau ikon panti). Gambar ini dipakai di menu atas, footer, panel admin, dan sebagai favicon di tab browser.
                    Disarankan persegi (mis. 512×512 px), format PNG atau WebP, latar transparan atau berwarna sesuai kebutuhan.
                </p>
                @if($site->site_logo)
                    <div style="margin-bottom:12px;">
                        <img src="{{ \App\Models\SiteContent::siteLogoUrl($site->site_logo) }}" alt="Pratinjau logo" style="max-height:96px;border-radius:12px;border:1px solid var(--gray-200);background:var(--gray-50);padding:8px;">
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-label" for="site_logo">Ubah logo (PNG/JPG/WebP/GIF, maks. 3&nbsp;MB)</label>
                    <input id="site_logo" type="file" name="site_logo" class="form-control" accept="image/jpeg,image/png,image/webp,image/gif">
                    @error('site_logo')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                @if($site->site_logo)
                <div class="form-group" style="margin-bottom:0;">
                    <label style="display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;">
                        <input type="hidden" name="remove_site_logo" value="0">
                        <input type="checkbox" name="remove_site_logo" value="1" {{ old('remove_site_logo') ? 'checked' : '' }}>
                        Hapus logo (kembali ke ikon SS bawaan &amp; tanpa favicon kustom)
                    </label>
                </div>
                @endif
            @else
                <p style="margin:0;font-size:13px;color:var(--gray-600);">Kolom logo belum ada di database. Jalankan migrasi terbaru lalu muat ulang halaman ini.</p>
            @endif
        </div>
    </div>

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Navigasi atas</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="nav_brand_suffix">Teks di samping logo</label>
                <input id="nav_brand_suffix" name="nav_brand_suffix" class="form-control" required value="{{ old('nav_brand_suffix', $site->nav_brand_suffix) }}">
                @error('nav_brand_suffix')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
                @foreach ([
                    'nav_beranda' => 'Beranda',
                    'nav_tentang' => 'Tentang',
                    'nav_kegiatan' => 'Kegiatan',
                    'nav_galeri' => 'Galeri',
                    'nav_donasi' => 'Donasi',
                    'nav_kunjungan' => 'Kunjungan',
                    'nav_kontak' => 'Kontak',
                ] as $name => $label)
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
                    <input id="{{ $name }}" name="{{ $name }}" class="form-control" required value="{{ old($name, $site->$name) }}">
                    @error($name)<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Tombol aksi hero (beranda)</span></div>
        <div class="card-body" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;">
            @foreach ([
                'home_btn_donasi' => 'Donasi',
                'home_btn_kunjungan' => 'Kunjungan',
            ] as $name => $label)
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="{{ $name }}">{{ $label }}</label>
                <input id="{{ $name }}" name="{{ $name }}" class="form-control" required value="{{ old($name, $site->$name) }}">
                @error($name)<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            @endforeach
        </div>
    </div>

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Ringkasan &quot;Tentang&quot; di beranda</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="home_tentang_section_title">Judul bagian (mis. Tentang Kami)</label>
                <input id="home_tentang_section_title" name="home_tentang_section_title" class="form-control" required value="{{ old('home_tentang_section_title', $site->home_tentang_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="summary_subtitle">Subjudul di bawah judul bagian</label>
                <input id="summary_subtitle" name="summary_subtitle" class="form-control" required value="{{ old('summary_subtitle', $tentang->summary_subtitle) }}">
                @error('summary_subtitle')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="summary_paragraph_1">Paragraf 1</label>
                <textarea id="summary_paragraph_1" name="summary_paragraph_1" class="form-control" rows="4" required>{{ old('summary_paragraph_1', $tentang->summary_paragraph_1) }}</textarea>
                @error('summary_paragraph_1')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="summary_paragraph_2">Paragraf 2</label>
                <textarea id="summary_paragraph_2" name="summary_paragraph_2" class="form-control" rows="4" required>{{ old('summary_paragraph_2', $tentang->summary_paragraph_2) }}</textarea>
                @error('summary_paragraph_2')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="summary_cta_note">Catatan di atas tombol &quot;lihat halaman Tentang&quot;</label>
                <textarea id="summary_cta_note" name="summary_cta_note" class="form-control" rows="3" required>{{ old('summary_cta_note', $tentang->summary_cta_note) }}</textarea>
                @error('summary_cta_note')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="home_about_image">Gambar samping (opsional, JPG/PNG/WebP)</label>
                @if($site->home_about_image)
                    <div style="margin-bottom:8px;">
                        <img src="{{ \App\Models\SiteContent::aboutImageUrl($site->home_about_image) }}" alt="" style="max-height:120px;border-radius:8px;border:1px solid var(--gray-200);">
                    </div>
                @endif
                <input id="home_about_image" type="file" name="home_about_image" class="form-control" accept="image/jpeg,image/png,image/webp,image/gif">
                <label style="display:flex;align-items:center;gap:8px;margin-top:10px;font-size:13px;color:var(--gray-600);">
                    <input type="hidden" name="remove_home_about_image" value="0">
                    <input type="checkbox" name="remove_home_about_image" value="1" {{ old('remove_home_about_image') ? 'checked' : '' }}>
                    Hapus gambar kustom (kembali ke gambar bawaan)
                </label>
                @error('home_about_image')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="home_about_image_alt">Teks alternatif gambar (aksesibilitas)</label>
                <input id="home_about_image_alt" name="home_about_image_alt" class="form-control" required value="{{ old('home_about_image_alt', $site->home_about_image_alt) }}">
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_visual_title">Keterangan gambar — judul</label>
                    <input id="home_visual_title" name="home_visual_title" class="form-control" required value="{{ old('home_visual_title', $site->home_visual_title) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_visual_subtitle">Keterangan gambar — subjudul</label>
                    <input id="home_visual_subtitle" name="home_visual_subtitle" class="form-control" required value="{{ old('home_visual_subtitle', $site->home_visual_subtitle) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="home_tentang_cta_label">Teks tombol ke halaman Tentang</label>
                <input id="home_tentang_cta_label" name="home_tentang_cta_label" class="form-control" required value="{{ old('home_tentang_cta_label', $site->home_tentang_cta_label) }}">
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Hubungi Kami (beranda)</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="home_kontak_title">Judul</label>
                <input id="home_kontak_title" name="home_kontak_title" class="form-control" required value="{{ old('home_kontak_title', $site->home_kontak_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="home_kontak_intro">Paragraf pengantar</label>
                <textarea id="home_kontak_intro" name="home_kontak_intro" class="form-control" rows="3" required>{{ old('home_kontak_intro', $site->home_kontak_intro) }}</textarea>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:12px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_phone_heading">Judul blok telepon</label>
                    <input id="home_kontak_phone_heading" name="home_kontak_phone_heading" class="form-control" required value="{{ old('home_kontak_phone_heading', $site->home_kontak_phone_heading) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_phone_display">Nomor tampil</label>
                    <input id="home_kontak_phone_display" name="home_kontak_phone_display" class="form-control" required value="{{ old('home_kontak_phone_display', $site->home_kontak_phone_display) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_phone_href">Link tel: (contoh tel:082198595245)</label>
                    <input id="home_kontak_phone_href" name="home_kontak_phone_href" class="form-control" required value="{{ old('home_kontak_phone_href', $site->home_kontak_phone_href) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_wa_text">Teks tautan WhatsApp</label>
                    <input id="home_kontak_wa_text" name="home_kontak_wa_text" class="form-control" required value="{{ old('home_kontak_wa_text', $site->home_kontak_wa_text) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="home_kontak_wa_url">URL WhatsApp</label>
                    <input id="home_kontak_wa_url" name="home_kontak_wa_url" class="form-control" required value="{{ old('home_kontak_wa_url', $site->home_kontak_wa_url) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_fb_heading">Judul Facebook</label>
                    <input id="home_kontak_fb_heading" name="home_kontak_fb_heading" class="form-control" required value="{{ old('home_kontak_fb_heading', $site->home_kontak_fb_heading) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_fb_text">Teks tautan Facebook</label>
                    <input id="home_kontak_fb_text" name="home_kontak_fb_text" class="form-control" required value="{{ old('home_kontak_fb_text', $site->home_kontak_fb_text) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="home_kontak_fb_url">URL Facebook</label>
                    <input id="home_kontak_fb_url" name="home_kontak_fb_url" class="form-control" required value="{{ old('home_kontak_fb_url', $site->home_kontak_fb_url) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_ig_heading">Judul Instagram</label>
                    <input id="home_kontak_ig_heading" name="home_kontak_ig_heading" class="form-control" required value="{{ old('home_kontak_ig_heading', $site->home_kontak_ig_heading) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="home_kontak_ig_text">Teks tautan Instagram</label>
                    <input id="home_kontak_ig_text" name="home_kontak_ig_text" class="form-control" required value="{{ old('home_kontak_ig_text', $site->home_kontak_ig_text) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="home_kontak_ig_url">URL Instagram</label>
                    <input id="home_kontak_ig_url" name="home_kontak_ig_url" class="form-control" required value="{{ old('home_kontak_ig_url', $site->home_kontak_ig_url) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="home_kontak_addr_heading">Judul alamat</label>
                    <input id="home_kontak_addr_heading" name="home_kontak_addr_heading" class="form-control" required value="{{ old('home_kontak_addr_heading', $site->home_kontak_addr_heading) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="home_kontak_addr_text">Teks alamat</label>
                    <input id="home_kontak_addr_text" name="home_kontak_addr_text" class="form-control" required value="{{ old('home_kontak_addr_text', $site->home_kontak_addr_text) }}">
                </div>
            </div>
        </div>
    </div>

    @if(!empty($donasiKeuanganCmsReady))
        @include('admin.beranda._donasi-keuangan-form')
    @else
        <div class="card" style="margin-bottom:18px;">
            <div class="card-header"><span class="card-title">Halaman Donasi Keuangan</span></div>
            <div class="card-body">
                <p style="margin:0;font-size:13.5px;color:var(--gray-600);">
                    Jalankan migrasi basis data (<code>donasi_keuangan_page</code> pada <code>site_contents</code>) untuk mengaktifkan pengelolaan konten <code>/donasi/keuangan</code> dari halaman ini.
                </p>
            </div>
        </div>
    @endif

    @if(!empty($donasiJasaCmsReady))
        @include('admin.beranda._donasi-jasa-form')
    @else
        <div class="card" style="margin-bottom:18px;">
            <div class="card-header"><span class="card-title">Halaman Donasi Jasa</span></div>
            <div class="card-body">
                <p style="margin:0;font-size:13.5px;color:var(--gray-600);">
                    Jalankan migrasi (<code>donasi_jasa_page</code> pada <code>site_contents</code>) untuk mengaktifkan pengelolaan konten <code>/donasi/jasa</code> dari halaman ini.
                </p>
            </div>
        </div>
    @endif

    <div class="card" style="margin-bottom:18px;">
        <div class="card-header"><span class="card-title">Footer situs</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="footer_brand_name">Nama merek (baris pertama)</label>
                <input id="footer_brand_name" name="footer_brand_name" class="form-control" required value="{{ old('footer_brand_name', $site->footer_brand_name) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="footer_brand_desc">Deskripsi singkat</label>
                <textarea id="footer_brand_desc" name="footer_brand_desc" class="form-control" rows="3" required>{{ old('footer_brand_desc', $site->footer_brand_desc) }}</textarea>
            </div>
            <div class="admin-grid-3">
                @foreach ([
                    'footer_heading_menu' => 'Judul kolom menu',
                    'footer_heading_kegiatan' => 'Judul kolom kegiatan',
                    'footer_heading_kontak' => 'Judul kolom kontak',
                ] as $name => $label)
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
                    <input id="{{ $name }}" name="{{ $name }}" class="form-control" required value="{{ old($name, $site->$name) }}">
                </div>
                @endforeach
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Teks tautan menu</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px;">
                @foreach ([
                    'footer_menu_beranda' => 'Beranda',
                    'footer_menu_tentang' => 'Tentang Kami',
                    'footer_menu_kegiatan' => 'Kegiatan',
                    'footer_menu_galeri' => 'Galeri',
                    'footer_menu_donasi' => 'Donasi',
                    'footer_menu_kunjungan' => 'Kunjungan',
                    'footer_menu_kontak' => 'Kontak',
                ] as $name => $label)
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
                    <input id="{{ $name }}" name="{{ $name }}" class="form-control" required value="{{ old($name, $site->$name) }}">
                </div>
                @endforeach
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Tautan kegiatan (footer)</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:10px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_kegiatan_rutin">Kegiatan rutin</label>
                    <input id="footer_kegiatan_rutin" name="footer_kegiatan_rutin" class="form-control" required value="{{ old('footer_kegiatan_rutin', $site->footer_kegiatan_rutin) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_kegiatan_unggulan">Program unggulan</label>
                    <input id="footer_kegiatan_unggulan" name="footer_kegiatan_unggulan" class="form-control" required value="{{ old('footer_kegiatan_unggulan', $site->footer_kegiatan_unggulan) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_kegiatan_lainnya">Program lainnya</label>
                    <input id="footer_kegiatan_lainnya" name="footer_kegiatan_lainnya" class="form-control" required value="{{ old('footer_kegiatan_lainnya', $site->footer_kegiatan_lainnya) }}">
                </div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Kontak footer</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:10px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_phone_display">Telepon tampil</label>
                    <input id="footer_phone_display" name="footer_phone_display" class="form-control" required value="{{ old('footer_phone_display', $site->footer_phone_display) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_phone_href">Link tel:</label>
                    <input id="footer_phone_href" name="footer_phone_href" class="form-control" required value="{{ old('footer_phone_href', $site->footer_phone_href) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_fb_text">Teks Facebook</label>
                    <input id="footer_fb_text" name="footer_fb_text" class="form-control" required value="{{ old('footer_fb_text', $site->footer_fb_text) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="footer_fb_url">URL Facebook</label>
                    <input id="footer_fb_url" name="footer_fb_url" class="form-control" required value="{{ old('footer_fb_url', $site->footer_fb_url) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="footer_ig_text">Teks Instagram</label>
                    <input id="footer_ig_text" name="footer_ig_text" class="form-control" required value="{{ old('footer_ig_text', $site->footer_ig_text) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="footer_ig_url">URL Instagram</label>
                    <input id="footer_ig_url" name="footer_ig_url" class="form-control" required value="{{ old('footer_ig_url', $site->footer_ig_url) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;grid-column:1/-1;">
                    <label class="form-label" for="footer_address">Alamat (teks)</label>
                    <input id="footer_address" name="footer_address" class="form-control" required value="{{ old('footer_address', $site->footer_address) }}">
                </div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Ikon sosial (baris ikon kecil)</p>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:10px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_sosmed_fb_url">URL ikon Facebook</label>
                    <input id="footer_sosmed_fb_url" name="footer_sosmed_fb_url" class="form-control" required value="{{ old('footer_sosmed_fb_url', $site->footer_sosmed_fb_url) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_sosmed_phone_href">URL ikon telepon (tel:)</label>
                    <input id="footer_sosmed_phone_href" name="footer_sosmed_phone_href" class="form-control" required value="{{ old('footer_sosmed_phone_href', $site->footer_sosmed_phone_href) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_sosmed_ig_url">URL ikon Instagram</label>
                    <input id="footer_sosmed_ig_url" name="footer_sosmed_ig_url" class="form-control" required value="{{ old('footer_sosmed_ig_url', $site->footer_sosmed_ig_url) }}">
                </div>
            </div>
            <div class="admin-grid-2 admin-mt-8">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_copyright_left">Hak cipta (setelah tahun)</label>
                    <input id="footer_copyright_left" name="footer_copyright_left" class="form-control" required value="{{ old('footer_copyright_left', $site->footer_copyright_left) }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_copyright_right">Tagline kanan</label>
                    <input id="footer_copyright_right" name="footer_copyright_right" class="form-control" required value="{{ old('footer_copyright_right', $site->footer_copyright_right) }}">
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan ke database</button>
        <a href="{{ url('/') }}" target="_blank" rel="noopener" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> Lihat beranda publik</a>
    </div>
</form>
@endsection
