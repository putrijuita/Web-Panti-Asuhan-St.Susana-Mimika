@extends('admin.layouts.app')

@section('title', 'Konten halaman Kontak')
@section('page-title', 'Konten halaman Kontak (/kontak)')
@section('page-subtitle', 'Hero, info kontak, tautan cepat, jam, FAQ, form, pesan sukses')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Navigasi &amp; footer situs di <strong>Konten Beranda &amp; Situs</strong>.
            Nilai <strong>value</strong> pada pilihan subjek harus konsisten (dipakai saat memproses form); ubah hanya jika Anda tahu dampaknya pada backend/email.
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.kontak-page.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Judul tab &amp; hero</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="page_meta_title">Judul tab browser</label>
                <input id="page_meta_title" name="page_meta_title" class="form-control" required value="{{ old('page_meta_title', $kontak->page_meta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_image">Gambar hero (opsional)</label>
                @include('admin.partials.cms-current-file', [
                    'url' => $kontak->hero_image ? asset('storage/'.$kontak->hero_image) : null,
                    'path' => $kontak->hero_image,
                    'emptyText' => 'Belum ada gambar hero — bagian hero tanpa foto latar.',
                ])
                @if($kontak->hero_image)
                    <label style="display:flex;align-items:center;gap:8px;font-size:13px;margin-bottom:8px;">
                        <input type="checkbox" name="remove_hero_image" value="1"> Hapus gambar
                    </label>
                @endif
                <input id="hero_image" name="hero_image" type="file" class="form-control" accept="image/*">
                @error('hero_image')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_icon">Ikon judul hero</label>
                <input id="hero_icon" name="hero_icon" class="form-control" required value="{{ old('hero_icon', $kontak->hero_icon) }}">
                @error('hero_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_title">Judul hero</label>
                <input id="hero_title" name="hero_title" class="form-control" required value="{{ old('hero_title', $kontak->hero_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_subtitle">Paragraf</label>
                <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $kontak->hero_subtitle) }}</textarea>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Informasi kontak</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="info_block_icon">Ikon judul blok</label>
                    <input id="info_block_icon" name="info_block_icon" class="form-control" required value="{{ old('info_block_icon', $kontak->info_block_icon) }}">
                    @error('info_block_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="info_block_title">Judul blok</label>
                    <input id="info_block_title" name="info_block_title" class="form-control" required value="{{ old('info_block_title', $kontak->info_block_title) }}">
                </div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Telepon</p>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;"><label class="form-label" for="phone_item_icon">Ikon</label><input id="phone_item_icon" name="phone_item_icon" class="form-control" required value="{{ old('phone_item_icon', $kontak->phone_item_icon) }}">@error('phone_item_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="phone_title">Judul</label><input id="phone_title" name="phone_title" class="form-control" required value="{{ old('phone_title', $kontak->phone_title) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="phone_href">Link (tel:…)</label><input id="phone_href" name="phone_href" class="form-control" required value="{{ old('phone_href', $kontak->phone_href) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="phone_display">Nomor tampil</label><input id="phone_display" name="phone_display" class="form-control" required value="{{ old('phone_display', $kontak->phone_display) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="phone_note">Catatan</label><input id="phone_note" name="phone_note" class="form-control" required value="{{ old('phone_note', $kontak->phone_note) }}"></div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Facebook</p>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;"><label class="form-label" for="fb_item_icon">Ikon</label><input id="fb_item_icon" name="fb_item_icon" class="form-control" required value="{{ old('fb_item_icon', $kontak->fb_item_icon) }}">@error('fb_item_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="fb_title">Judul</label><input id="fb_title" name="fb_title" class="form-control" required value="{{ old('fb_title', $kontak->fb_title) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="fb_url">URL</label><input id="fb_url" name="fb_url" class="form-control" required value="{{ old('fb_url', $kontak->fb_url) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="fb_link_text">Teks tautan</label><input id="fb_link_text" name="fb_link_text" class="form-control" required value="{{ old('fb_link_text', $kontak->fb_link_text) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="fb_note">Catatan (opsional)</label><input id="fb_note" name="fb_note" class="form-control" value="{{ old('fb_note', $kontak->fb_note) }}"></div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Instagram</p>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;"><label class="form-label" for="ig_item_icon">Ikon</label><input id="ig_item_icon" name="ig_item_icon" class="form-control" required value="{{ old('ig_item_icon', $kontak->ig_item_icon) }}">@error('ig_item_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="ig_title">Judul</label><input id="ig_title" name="ig_title" class="form-control" required value="{{ old('ig_title', $kontak->ig_title) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="ig_url">URL</label><input id="ig_url" name="ig_url" class="form-control" required value="{{ old('ig_url', $kontak->ig_url) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="ig_link_text">Teks tautan</label><textarea id="ig_link_text" name="ig_link_text" class="form-control" rows="2" required>{{ old('ig_link_text', $kontak->ig_link_text) }}</textarea></div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Alamat</p>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;"><label class="form-label" for="addr_item_icon">Ikon</label><input id="addr_item_icon" name="addr_item_icon" class="form-control" required value="{{ old('addr_item_icon', $kontak->addr_item_icon) }}">@error('addr_item_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="addr_title">Judul</label><input id="addr_title" name="addr_title" class="form-control" required value="{{ old('addr_title', $kontak->addr_title) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="addr_line1">Baris 1</label><input id="addr_line1" name="addr_line1" class="form-control" required value="{{ old('addr_line1', $kontak->addr_line1) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="addr_line2">Baris 2</label><input id="addr_line2" name="addr_line2" class="form-control" required value="{{ old('addr_line2', $kontak->addr_line2) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="addr_line3">Baris 3</label><input id="addr_line3" name="addr_line3" class="form-control" required value="{{ old('addr_line3', $kontak->addr_line3) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;">
                    <label class="form-label" for="addr_maps_url">Tautan Google Maps (opsional)</label>
                    <input id="addr_maps_url" name="addr_maps_url" class="form-control" value="{{ old('addr_maps_url', $kontak->addr_maps_url ?? '') }}" placeholder="https://maps.app.goo.gl/… atau https://www.google.com/maps/place/…">
                    <small style="display:block;margin-top:6px;font-size:12px;color:var(--gray-500);">Tempel tautan dari menu Bagikan di Google Maps agar pin lokasi tepat. Kosongkan untuk memakai pencarian otomatis dari teks alamat di atas.</small>
                    @error('addr_maps_url')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Terhubung cepat</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="quick_block_icon">Ikon judul</label>
                    <input id="quick_block_icon" name="quick_block_icon" class="form-control" required value="{{ old('quick_block_icon', $kontak->quick_block_icon) }}">
                    @error('quick_block_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="quick_block_title">Judul</label>
                    <input id="quick_block_title" name="quick_block_title" class="form-control" required value="{{ old('quick_block_title', $kontak->quick_block_title) }}">
                </div>
            </div>
            <div class="form-group"><label class="form-label" for="quick_fb_text">Teks tombol Facebook</label><input id="quick_fb_text" name="quick_fb_text" class="form-control" required value="{{ old('quick_fb_text', $kontak->quick_fb_text) }}"></div>
            <div class="form-group"><label class="form-label" for="quick_fb_url">URL Facebook</label><input id="quick_fb_url" name="quick_fb_url" class="form-control" required value="{{ old('quick_fb_url', $kontak->quick_fb_url) }}"></div>
            <div class="form-group"><label class="form-label" for="quick_ig_text">Teks tombol Instagram</label><textarea id="quick_ig_text" name="quick_ig_text" class="form-control" rows="2" required>{{ old('quick_ig_text', $kontak->quick_ig_text) }}</textarea></div>
            <div class="form-group"><label class="form-label" for="quick_ig_url">URL Instagram</label><input id="quick_ig_url" name="quick_ig_url" class="form-control" required value="{{ old('quick_ig_url', $kontak->quick_ig_url) }}"></div>
            <div class="form-group"><label class="form-label" for="quick_phone_text">Teks tombol telepon</label><input id="quick_phone_text" name="quick_phone_text" class="form-control" required value="{{ old('quick_phone_text', $kontak->quick_phone_text) }}"></div>
            <div class="form-group"><label class="form-label" for="quick_phone_url">URL telepon (tel:…)</label><input id="quick_phone_url" name="quick_phone_url" class="form-control" required value="{{ old('quick_phone_url', $kontak->quick_phone_url) }}"></div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Jam operasional</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="jam_block_icon">Ikon</label>
                    <input id="jam_block_icon" name="jam_block_icon" class="form-control" required value="{{ old('jam_block_icon', $kontak->jam_block_icon) }}">
                    @error('jam_block_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="jam_block_title">Judul</label>
                    <input id="jam_block_title" name="jam_block_title" class="form-control" required value="{{ old('jam_block_title', $kontak->jam_block_title) }}">
                </div>
            </div>
            @for ($r = 1; $r <= 3; $r++)
                <div class="admin-grid-2 admin-mt-10">
                    <div class="form-group" style="margin:0;"><label class="form-label" for="jam_row{{ $r }}_hari">Baris {{ $r }} — hari</label><input id="jam_row{{ $r }}_hari" name="jam_row{{ $r }}_hari" class="form-control" required value="{{ old('jam_row'.$r.'_hari', $kontak->{'jam_row'.$r.'_hari'}) }}"></div>
                    <div class="form-group" style="margin:0;"><label class="form-label" for="jam_row{{ $r }}_waktu">Baris {{ $r }} — waktu</label><input id="jam_row{{ $r }}_waktu" name="jam_row{{ $r }}_waktu" class="form-control" required value="{{ old('jam_row'.$r.'_waktu', $kontak->{'jam_row'.$r.'_waktu'}) }}"></div>
                </div>
            @endfor
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">FAQ (4 item)</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="faq_block_icon">Ikon judul</label>
                    <input id="faq_block_icon" name="faq_block_icon" class="form-control" required value="{{ old('faq_block_icon', $kontak->faq_block_icon) }}">
                    @error('faq_block_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="faq_block_title">Judul</label>
                    <input id="faq_block_title" name="faq_block_title" class="form-control" required value="{{ old('faq_block_title', $kontak->faq_block_title) }}">
                </div>
            </div>
            @for ($f = 1; $f <= 4; $f++)
                <hr style="border:none;border-top:1px solid var(--gray-200);margin:14px 0;">
                <p style="font-size:12px;color:var(--gray-500);margin:0 0 8px;">FAQ {{ $f }}</p>
                <div class="form-group">
                    <label class="form-label" for="faq{{ $f }}_q">Pertanyaan</label>
                    <input id="faq{{ $f }}_q" name="faq{{ $f }}_q" class="form-control" required value="{{ old('faq'.$f.'_q', $kontak->{'faq'.$f.'_q'}) }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="faq{{ $f }}_a">Jawaban</label>
                    <textarea id="faq{{ $f }}_a" name="faq{{ $f }}_a" class="form-control" rows="3" required>{{ old('faq'.$f.'_a', $kontak->{'faq'.$f.'_a'}) }}</textarea>
                </div>
            @endfor
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Form kirim pesan</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="form_title">Judul</label>
                <input id="form_title" name="form_title" class="form-control" required value="{{ old('form_title', $kontak->form_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="form_subtitle">Pengantar</label>
                <textarea id="form_subtitle" name="form_subtitle" class="form-control" rows="2" required>{{ old('form_subtitle', $kontak->form_subtitle) }}</textarea>
            </div>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_nama">Label nama</label><input id="lbl_nama" name="lbl_nama" class="form-control" required value="{{ old('lbl_nama', $kontak->lbl_nama) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="ph_nama">Placeholder nama</label><input id="ph_nama" name="ph_nama" class="form-control" required value="{{ old('ph_nama', $kontak->ph_nama) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_email">Label email</label><input id="lbl_email" name="lbl_email" class="form-control" required value="{{ old('lbl_email', $kontak->lbl_email) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="ph_email">Placeholder email</label><input id="ph_email" name="ph_email" class="form-control" required value="{{ old('ph_email', $kontak->ph_email) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_subjek">Label subjek</label><input id="lbl_subjek" name="lbl_subjek" class="form-control" required value="{{ old('lbl_subjek', $kontak->lbl_subjek) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="select_placeholder">Placeholder pilihan subjek</label><input id="select_placeholder" name="select_placeholder" class="form-control" required value="{{ old('select_placeholder', $kontak->select_placeholder) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_pesan">Label pesan</label><input id="lbl_pesan" name="lbl_pesan" class="form-control" required value="{{ old('lbl_pesan', $kontak->lbl_pesan) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="ph_pesan">Placeholder pesan</label><input id="ph_pesan" name="ph_pesan" class="form-control" required value="{{ old('ph_pesan', $kontak->ph_pesan) }}"></div>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Opsi subjek (value | label tampilan)</p>
            @for ($o = 1; $o <= 6; $o++)
                <div class="admin-grid-12 admin-mb-8">
                    <input name="opt{{ $o }}_value" class="form-control" required placeholder="value" value="{{ old('opt'.$o.'_value', $kontak->{'opt'.$o.'_value'}) }}">
                    <input name="opt{{ $o }}_label" class="form-control" required placeholder="label" value="{{ old('opt'.$o.'_label', $kontak->{'opt'.$o.'_label'}) }}">
                </div>
            @endfor
            <div class="admin-grid-2 admin-mt-10">
                <div class="form-group" style="margin:0;"><label class="form-label" for="btn_submit_icon">Ikon kirim</label><input id="btn_submit_icon" name="btn_submit_icon" class="form-control" required value="{{ old('btn_submit_icon', $kontak->btn_submit_icon) }}">@error('btn_submit_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="btn_submit_text">Teks kirim</label><input id="btn_submit_text" name="btn_submit_text" class="form-control" required value="{{ old('btn_submit_text', $kontak->btn_submit_text) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="form_footer_icon">Ikon footer form</label><input id="form_footer_icon" name="form_footer_icon" class="form-control" required value="{{ old('form_footer_icon', $kontak->form_footer_icon) }}">@error('form_footer_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="form_footer_text">Teks footer form</label><input id="form_footer_text" name="form_footer_text" class="form-control" required value="{{ old('form_footer_text', $kontak->form_footer_text) }}"></div>
            </div>
            <hr style="border:none;border-top:1px solid var(--gray-200);margin:16px 0;">
            <div class="form-group">
                <label class="form-label" for="divider_text">Teks atas tombol &quot;hubungi langsung&quot;</label>
                <input id="divider_text" name="divider_text" class="form-control" required value="{{ old('divider_text', $kontak->divider_text) }}">
            </div>
            <div class="admin-grid-3">
                <div class="form-group" style="margin:0;"><label class="form-label" for="divider_btn_icon">Ikon tombol</label><input id="divider_btn_icon" name="divider_btn_icon" class="form-control" required value="{{ old('divider_btn_icon', $kontak->divider_btn_icon) }}">@error('divider_btn_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="divider_btn_text">Teks tombol</label><input id="divider_btn_text" name="divider_btn_text" class="form-control" required value="{{ old('divider_btn_text', $kontak->divider_btn_text) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="divider_btn_href">Link (tel:…)</label><input id="divider_btn_href" name="divider_btn_href" class="form-control" required value="{{ old('divider_btn_href', $kontak->divider_btn_href) }}"></div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Setelah kirim form</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="success_message">Flash pesan sukses (redirect)</label>
                <textarea id="success_message" name="success_message" class="form-control" rows="2" required>{{ old('success_message', $kontak->success_message) }}</textarea>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('kontak') }}" target="_blank" rel="noopener" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> Lihat /kontak</a>
    </div>
</form>
@endsection
