@extends('admin.layouts.app')

@section('title', 'Konten halaman Tentang')
@section('page-title', 'Konten halaman Tentang')
@section('page-subtitle', 'Hero, visi & misi, nilai, sejarah, pengurus, CTA — tersimpan di database (foto pengurus di Struktur Organisasi)')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            <strong>Sambutan hero beranda</strong> dan <strong>ringkasan Tentang di beranda</strong> diatur di
            <a href="{{ route('admin.beranda.edit') }}">Konten Beranda &amp; Situs</a>.
            Halaman ini khusus untuk isi <a href="{{ route('tentang') }}" target="_blank" rel="noopener">/tentang</a>.
        </p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Isi halaman Tentang (publik)</div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.tentang.update') }}">
            @csrf
            @method('PUT')

            <h3 style="font-size:14px;color:var(--gray-700);margin:0 0 12px;">Judul tab browser</h3>
            <div class="form-group">
                <label class="form-label" for="page_meta_title">Meta title</label>
                <input id="page_meta_title" type="text" name="page_meta_title" class="form-control" required value="{{ old('page_meta_title', $tentang->page_meta_title) }}">
                @error('page_meta_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.25rem 0;">
            <h3 style="font-size:14px;color:var(--gray-700);margin:0 0 12px;">Hero halaman</h3>
            <div class="form-group">
                <label class="form-label" for="tentang_hero_title">Judul</label>
                <input id="tentang_hero_title" type="text" name="tentang_hero_title" class="form-control" required value="{{ old('tentang_hero_title', $tentang->tentang_hero_title) }}">
                @error('tentang_hero_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="tentang_hero_description">Deskripsi</label>
                <textarea id="tentang_hero_description" name="tentang_hero_description" class="form-control" rows="3" required>{{ old('tentang_hero_description', $tentang->tentang_hero_description) }}</textarea>
                @error('tentang_hero_description')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.25rem 0;">
            <h3 style="font-size:14px;color:var(--gray-700);margin:0 0 12px;">Bagian Visi &amp; Misi</h3>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="vm_section_label">Label pill bagian</label>
                    <input id="vm_section_label" name="vm_section_label" class="form-control" required value="{{ old('vm_section_label', $tentang->vm_section_label) }}">
                    @error('vm_section_label')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="vm_visi_icon">Ikon kartu Visi (kelas FA)</label>
                    <input id="vm_visi_icon" name="vm_visi_icon" class="form-control" required value="{{ old('vm_visi_icon', $tentang->vm_visi_icon) }}">
                    @error('vm_visi_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="vm_misi_icon">Ikon kartu Misi (kelas FA)</label>
                    <input id="vm_misi_icon" name="vm_misi_icon" class="form-control" required value="{{ old('vm_misi_icon', $tentang->vm_misi_icon) }}">
                    @error('vm_misi_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="vm_visi_heading">Judul kartu Visi</label>
                    <input id="vm_visi_heading" name="vm_visi_heading" class="form-control" required value="{{ old('vm_visi_heading', $tentang->vm_visi_heading) }}">
                    @error('vm_visi_heading')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="vm_misi_heading">Judul kartu Misi</label>
                    <input id="vm_misi_heading" name="vm_misi_heading" class="form-control" required value="{{ old('vm_misi_heading', $tentang->vm_misi_heading) }}">
                    @error('vm_misi_heading')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="visi_text">Isi Visi</label>
                <textarea id="visi_text" name="visi_text" class="form-control" rows="5" required>{{ old('visi_text', $tentang->visi_text) }}</textarea>
                @error('visi_text')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="misi_text">Poin Misi (satu baris = satu poin)</label>
                <textarea id="misi_text" name="misi_text" class="form-control" rows="8" required>{{ old('misi_text', collect($tentang->misi_items ?? [])->implode("\n")) }}</textarea>
                @error('misi_text')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.25rem 0;">
            <h3 style="font-size:14px;color:var(--gray-700);margin:0 0 12px;">Nilai-nilai</h3>
            <div class="form-group">
                <label class="form-label" for="nilai_section_label">Label pill</label>
                <input id="nilai_section_label" name="nilai_section_label" class="form-control" required value="{{ old('nilai_section_label', $tentang->nilai_section_label) }}">
                @error('nilai_section_label')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="nilai_section_title">Judul blok</label>
                <input id="nilai_section_title" name="nilai_section_title" class="form-control" required value="{{ old('nilai_section_title', $tentang->nilai_section_title) }}">
                @error('nilai_section_title')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="nilai_section_sub">Subjudul (opsional)</label>
                <input id="nilai_section_sub" name="nilai_section_sub" class="form-control" value="{{ old('nilai_section_sub', $tentang->nilai_section_sub) }}">
                @error('nilai_section_sub')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:0 0 8px;">6 kartu — kelas ikon Font Awesome (contoh: <code>fas fa-heart</code>)</p>
            <div style="display:grid;gap:14px;">
                @for($i = 0; $i < 6; $i++)
                    @php $row = $nilaiItems[$i] ?? ['icon' => '', 'title' => '', 'text' => '']; @endphp
                    <div class="admin-form-row-box admin-grid-112-end">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="nilai_icon_{{ $i }}">Ikon (kelas)</label>
                            <input id="nilai_icon_{{ $i }}" name="nilai_items[{{ $i }}][icon]" class="form-control" required value="{{ old("nilai_items.$i.icon", $row['icon'] ?? '') }}">
                            @error("nilai_items.$i.icon")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="nilai_title_{{ $i }}">Judul</label>
                            <input id="nilai_title_{{ $i }}" name="nilai_items[{{ $i }}][title]" class="form-control" required value="{{ old("nilai_items.$i.title", $row['title'] ?? '') }}">
                            @error("nilai_items.$i.title")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="nilai_text_{{ $i }}">Deskripsi</label>
                            <input id="nilai_text_{{ $i }}" name="nilai_items[{{ $i }}][text]" class="form-control" required value="{{ old("nilai_items.$i.text", $row['text'] ?? '') }}">
                            @error("nilai_items.$i.text")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                        </div>
                    </div>
                @endfor
            </div>

            <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.25rem 0;">
            <h3 style="font-size:14px;color:var(--gray-700);margin:0 0 12px;">Sejarah (timeline)</h3>
            <div class="form-group">
                <label class="form-label" for="sejarah_section_label">Label pill</label>
                <input id="sejarah_section_label" name="sejarah_section_label" class="form-control" required value="{{ old('sejarah_section_label', $tentang->sejarah_section_label) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="sejarah_section_title">Judul blok</label>
                <input id="sejarah_section_title" name="sejarah_section_title" class="form-control" required value="{{ old('sejarah_section_title', $tentang->sejarah_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="sejarah_section_sub">Subjudul</label>
                <input id="sejarah_section_sub" name="sejarah_section_sub" class="form-control" required value="{{ old('sejarah_section_sub', $tentang->sejarah_section_sub) }}">
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:0 0 8px;">4 langkah timeline</p>
            <div style="display:grid;gap:14px;">
                @for($i = 0; $i < 4; $i++)
                    @php $s = $sejarahItems[$i] ?? ['badge' => '', 'title' => '', 'body' => '']; @endphp
                    <div class="admin-form-row-box admin-grid-112">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Label fase</label>
                            <input name="sejarah_items[{{ $i }}][badge]" class="form-control" required value="{{ old("sejarah_items.$i.badge", $s['badge'] ?? '') }}">
                            @error("sejarah_items.$i.badge")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Judul</label>
                            <input name="sejarah_items[{{ $i }}][title]" class="form-control" required value="{{ old("sejarah_items.$i.title", $s['title'] ?? '') }}">
                            @error("sejarah_items.$i.title")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Paragraf</label>
                            <textarea name="sejarah_items[{{ $i }}][body]" class="form-control" rows="2" required>{{ old("sejarah_items.$i.body", $s['body'] ?? '') }}</textarea>
                            @error("sejarah_items.$i.body")<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                        </div>
                    </div>
                @endfor
            </div>

            <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.25rem 0;">
            <h3 style="font-size:14px;color:var(--gray-700);margin:0 0 12px;">Pengurus (teks pengantar)</h3>
            <p style="font-size:12px;color:var(--gray-500);margin:-4px 0 10px;">Daftar nama &amp; foto di <a href="{{ route('admin.struktur.index') }}">Struktur Organisasi</a>.</p>
            <div class="form-group">
                <label class="form-label" for="pengurus_section_label">Label pill</label>
                <input id="pengurus_section_label" name="pengurus_section_label" class="form-control" required value="{{ old('pengurus_section_label', $tentang->pengurus_section_label) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="pengurus_section_title">Judul blok</label>
                <input id="pengurus_section_title" name="pengurus_section_title" class="form-control" required value="{{ old('pengurus_section_title', $tentang->pengurus_section_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="pengurus_section_sub">Subjudul</label>
                <input id="pengurus_section_sub" name="pengurus_section_sub" class="form-control" required value="{{ old('pengurus_section_sub', $tentang->pengurus_section_sub) }}">
            </div>

            <hr style="border:none;border-top:1px solid var(--gray-200);margin:1.25rem 0;">
            <h3 style="font-size:14px;color:var(--gray-700);margin:0 0 12px;">Ajakan (CTA) di bawah</h3>
            <div class="form-group">
                <label class="form-label" for="cta_title">Judul</label>
                <input id="cta_title" name="cta_title" class="form-control" required value="{{ old('cta_title', $tentang->cta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="cta_subtitle">Subjudul</label>
                <input id="cta_subtitle" name="cta_subtitle" class="form-control" required value="{{ old('cta_subtitle', $tentang->cta_subtitle) }}">
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_donasi">Tombol Donasi</label>
                    <input id="cta_btn_donasi" name="cta_btn_donasi" class="form-control" required value="{{ old('cta_btn_donasi', $tentang->cta_btn_donasi) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_kunjungan">Tombol Kunjungan</label>
                    <input id="cta_btn_kunjungan" name="cta_btn_kunjungan" class="form-control" required value="{{ old('cta_btn_kunjungan', $tentang->cta_btn_kunjungan) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_btn_kontak">Tombol Kontak</label>
                    <input id="cta_btn_kontak" name="cta_btn_kontak" class="form-control" required value="{{ old('cta_btn_kontak', $tentang->cta_btn_kontak) }}">
                </div>
            </div>

            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:1.25rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan ke database
                </button>
                <a href="{{ route('tentang') }}" target="_blank" class="btn btn-secondary">
                    <i class="fas fa-external-link-alt"></i> Lihat halaman Tentang
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
