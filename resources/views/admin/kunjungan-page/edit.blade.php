@extends('admin.layouts.app')

@section('title', 'Konten halaman Kunjungan')
@section('page-title', 'Konten halaman Kunjungan (/kunjungan)')
@section('page-subtitle', 'Hero, penjelasan, alur, kegiatan, aturan, label form, halaman terima kasih')

@section('content')
<div class="card" style="margin-bottom:18px;">
    <div class="card-body" style="padding:14px 20px;">
        <p style="margin:0;font-size:13.5px;color:var(--gray-600);line-height:1.55;">
            Navigasi &amp; footer situs di <a href="{{ route('admin.beranda.edit') }}">Konten Beranda &amp; Situs</a>.
            Data permohonan kunjungan di <a href="{{ route('admin.kunjungan.index') }}">Kunjungan</a> (admin).
            Tiga poin &quot;Apa itu Kunjungan?&quot; mendukung HTML sederhana (mis. <code>&lt;strong&gt;</code>).
        </p>
    </div>
</div>

<form method="POST" action="{{ route('admin.kunjungan-page.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Judul tab &amp; hero</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="page_meta_title">Judul tab (form ajukan)</label>
                <input id="page_meta_title" name="page_meta_title" class="form-control" required value="{{ old('page_meta_title', $kunjungan->page_meta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="thanks_meta_title">Judul tab (terima kasih)</label>
                <input id="thanks_meta_title" name="thanks_meta_title" class="form-control" required value="{{ old('thanks_meta_title', $kunjungan->thanks_meta_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_icon">Ikon hero (kelas Font Awesome)</label>
                <input id="hero_icon" name="hero_icon" class="form-control" required value="{{ old('hero_icon', $kunjungan->hero_icon) }}">
                @error('hero_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_title">Judul hero</label>
                <input id="hero_title" name="hero_title" class="form-control" required value="{{ old('hero_title', $kunjungan->hero_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_subtitle">Paragraf hero</label>
                <textarea id="hero_subtitle" name="hero_subtitle" class="form-control" rows="3" required>{{ old('hero_subtitle', $kunjungan->hero_subtitle) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_image">Gambar hero (opsional)</label>
                @if($kunjungan->hero_image)
                    <div style="margin-bottom:8px;">
                        <img src="{{ asset('storage/'.$kunjungan->hero_image) }}" alt="" style="max-width:280px;border-radius:8px;border:1px solid var(--gray-200);">
                    </div>
                    <label style="display:flex;align-items:center;gap:8px;font-size:13px;margin-bottom:8px;">
                        <input type="checkbox" name="remove_hero_image" value="1" {{ old('remove_hero_image') ? 'checked' : '' }}> Hapus gambar
                    </label>
                @endif
                <input id="hero_image" name="hero_image" type="file" class="form-control" accept="image/*">
                @error('hero_image')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Apa itu Kunjungan?</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="explain_icon">Ikon judul</label>
                    <input id="explain_icon" name="explain_icon" class="form-control" required value="{{ old('explain_icon', $kunjungan->explain_icon) }}">
                    @error('explain_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="explain_title">Judul</label>
                    <input id="explain_title" name="explain_title" class="form-control" required value="{{ old('explain_title', $kunjungan->explain_title) }}">
                </div>
            </div>
            @foreach (['explain_li_1' => 'Poin 1', 'explain_li_2' => 'Poin 2', 'explain_li_3' => 'Poin 3'] as $field => $label)
                <div class="form-group">
                    <label class="form-label" for="{{ $field }}">{{ $label }}</label>
                    <textarea id="{{ $field }}" name="{{ $field }}" class="form-control" rows="2" required>{{ old($field, $kunjungan->$field) }}</textarea>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Alur pengajuan</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="flow_icon">Ikon judul</label>
                    <input id="flow_icon" name="flow_icon" class="form-control" required value="{{ old('flow_icon', $kunjungan->flow_icon) }}">
                    @error('flow_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="flow_title">Judul</label>
                    <input id="flow_title" name="flow_title" class="form-control" required value="{{ old('flow_title', $kunjungan->flow_title) }}">
                </div>
            </div>
            @for ($i = 1; $i <= 4; $i++)
                <hr style="border:none;border-top:1px solid var(--gray-200);margin:14px 0;">
                <p style="font-size:12px;color:var(--gray-500);margin:0 0 8px;">Langkah {{ $i }}</p>
                <div class="admin-grid-2">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label" for="step{{ $i }}_title">Judul</label>
                        <input id="step{{ $i }}_title" name="step{{ $i }}_title" class="form-control" required value="{{ old('step'.$i.'_title', $kunjungan->{'step'.$i.'_title'}) }}">
                    </div>
                    <div class="form-group" style="margin:0;grid-column:span 2;">
                        <label class="form-label" for="step{{ $i }}_text">Teks</label>
                        <textarea id="step{{ $i }}_text" name="step{{ $i }}_text" class="form-control" rows="2" required>{{ old('step'.$i.'_text', $kunjungan->{'step'.$i.'_text'}) }}</textarea>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Kegiatan yang bisa dilakukan</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="activities_icon">Ikon judul</label>
                    <input id="activities_icon" name="activities_icon" class="form-control" required value="{{ old('activities_icon', $kunjungan->activities_icon) }}">
                    @error('activities_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="activities_title">Judul</label>
                    <input id="activities_title" name="activities_title" class="form-control" required value="{{ old('activities_title', $kunjungan->activities_title) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="activities_intro">Paragraf pengantar</label>
                <textarea id="activities_intro" name="activities_intro" class="form-control" rows="2" required>{{ old('activities_intro', $kunjungan->activities_intro) }}</textarea>
            </div>
            @for ($i = 1; $i <= 6; $i++)
                <div class="admin-grid-12 admin-mt-10">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label" for="act{{ $i }}_icon">Ikon {{ $i }}</label>
                        <input id="act{{ $i }}_icon" name="act{{ $i }}_icon" class="form-control" required value="{{ old('act'.$i.'_icon', $kunjungan->{'act'.$i.'_icon'}) }}">
                        @error('act'.$i.'_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label" for="act{{ $i }}_text">Teks {{ $i }}</label>
                        <input id="act{{ $i }}_text" name="act{{ $i }}_text" class="form-control" required value="{{ old('act'.$i.'_text', $kunjungan->{'act'.$i.'_text'}) }}">
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Aturan kunjungan</span></div>
        <div class="card-body">
            <div class="admin-grid-12">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="rules_icon">Ikon judul</label>
                    <input id="rules_icon" name="rules_icon" class="form-control" required value="{{ old('rules_icon', $kunjungan->rules_icon) }}">
                    @error('rules_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="rules_title">Judul</label>
                    <input id="rules_title" name="rules_title" class="form-control" required value="{{ old('rules_title', $kunjungan->rules_title) }}">
                </div>
            </div>
            @for ($i = 1; $i <= 5; $i++)
                <div class="form-group">
                    <label class="form-label" for="rule{{ $i }}">Aturan {{ $i }}</label>
                    <input id="rule{{ $i }}" name="rule{{ $i }}" class="form-control" required value="{{ old('rule'.$i, $kunjungan->{'rule'.$i}) }}">
                </div>
            @endfor
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Formulir</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="form_title">Judul blok form</label>
                <input id="form_title" name="form_title" class="form-control" required value="{{ old('form_title', $kunjungan->form_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="form_intro">Pengantar</label>
                <textarea id="form_intro" name="form_intro" class="form-control" rows="2" required>{{ old('form_intro', $kunjungan->form_intro) }}</textarea>
            </div>
            <p style="font-size:12px;color:var(--gray-500);margin:12px 0 8px;">Label &amp; placeholder</p>
            <div class="admin-grid-2">
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_nama">Label nama</label><input id="lbl_nama" name="lbl_nama" class="form-control" required value="{{ old('lbl_nama', $kunjungan->lbl_nama) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="ph_nama">Placeholder nama</label><input id="ph_nama" name="ph_nama" class="form-control" required value="{{ old('ph_nama', $kunjungan->ph_nama) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_email">Label email</label><input id="lbl_email" name="lbl_email" class="form-control" required value="{{ old('lbl_email', $kunjungan->lbl_email) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="ph_email">Placeholder email</label><input id="ph_email" name="ph_email" class="form-control" required value="{{ old('ph_email', $kunjungan->ph_email) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_telepon">Label telepon</label><input id="lbl_telepon" name="lbl_telepon" class="form-control" required value="{{ old('lbl_telepon', $kunjungan->lbl_telepon) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="tag_optional">Teks &quot;opsional&quot; (telepon)</label><input id="tag_optional" name="tag_optional" class="form-control" required value="{{ old('tag_optional', $kunjungan->tag_optional) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="ph_telepon">Placeholder telepon</label><input id="ph_telepon" name="ph_telepon" class="form-control" required value="{{ old('ph_telepon', $kunjungan->ph_telepon) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_tanggal">Label tanggal</label><input id="lbl_tanggal" name="lbl_tanggal" class="form-control" required value="{{ old('lbl_tanggal', $kunjungan->lbl_tanggal) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="note_tanggal">Catatan bawah tanggal</label><textarea id="note_tanggal" name="note_tanggal" class="form-control" rows="2" required>{{ old('note_tanggal', $kunjungan->note_tanggal) }}</textarea></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_instansi">Label instansi</label><input id="lbl_instansi" name="lbl_instansi" class="form-control" required value="{{ old('lbl_instansi', $kunjungan->lbl_instansi) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="tag_optional_instansi">Teks opsional instansi</label><input id="tag_optional_instansi" name="tag_optional_instansi" class="form-control" required value="{{ old('tag_optional_instansi', $kunjungan->tag_optional_instansi) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="ph_instansi">Placeholder instansi</label><input id="ph_instansi" name="ph_instansi" class="form-control" required value="{{ old('ph_instansi', $kunjungan->ph_instansi) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_keperluan">Label keperluan</label><input id="lbl_keperluan" name="lbl_keperluan" class="form-control" required value="{{ old('lbl_keperluan', $kunjungan->lbl_keperluan) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="ph_keperluan">Placeholder keperluan</label><input id="ph_keperluan" name="ph_keperluan" class="form-control" required value="{{ old('ph_keperluan', $kunjungan->ph_keperluan) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="note_keperluan">Catatan keperluan</label><textarea id="note_keperluan" name="note_keperluan" class="form-control" rows="2" required>{{ old('note_keperluan', $kunjungan->note_keperluan) }}</textarea></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="lbl_catatan">Label catatan</label><input id="lbl_catatan" name="lbl_catatan" class="form-control" required value="{{ old('lbl_catatan', $kunjungan->lbl_catatan) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="tag_optional_catatan">Teks opsional catatan</label><input id="tag_optional_catatan" name="tag_optional_catatan" class="form-control" required value="{{ old('tag_optional_catatan', $kunjungan->tag_optional_catatan) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="ph_catatan">Placeholder catatan</label><input id="ph_catatan" name="ph_catatan" class="form-control" required value="{{ old('ph_catatan', $kunjungan->ph_catatan) }}"></div>
                <div class="form-group" style="margin:0;grid-column:span 2;"><label class="form-label" for="note_catatan">Catatan bawah catatan</label><textarea id="note_catatan" name="note_catatan" class="form-control" rows="2" required>{{ old('note_catatan', $kunjungan->note_catatan) }}</textarea></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="btn_submit_icon">Ikon tombol kirim</label><input id="btn_submit_icon" name="btn_submit_icon" class="form-control" required value="{{ old('btn_submit_icon', $kunjungan->btn_submit_icon) }}">@error('btn_submit_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="btn_submit_text">Teks tombol kirim</label><input id="btn_submit_text" name="btn_submit_text" class="form-control" required value="{{ old('btn_submit_text', $kunjungan->btn_submit_text) }}"></div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="form_footer_icon">Ikon footer form</label><input id="form_footer_icon" name="form_footer_icon" class="form-control" required value="{{ old('form_footer_icon', $kunjungan->form_footer_icon) }}">@error('form_footer_icon')<small style="color:#b91c1c;">{{ $message }}</small>@enderror</div>
                <div class="form-group" style="margin:0;"><label class="form-label" for="form_footer_text">Teks footer form</label><input id="form_footer_text" name="form_footer_text" class="form-control" required value="{{ old('form_footer_text', $kunjungan->form_footer_text) }}"></div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;">
        <div class="card-header"><span class="card-title">Halaman terima kasih</span></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="thanks_emoji">Emoji / simbol atas</label>
                <input id="thanks_emoji" name="thanks_emoji" class="form-control" required value="{{ old('thanks_emoji', $kunjungan->thanks_emoji) }}" maxlength="20">
            </div>
            <div class="form-group">
                <label class="form-label" for="thanks_title">Judul</label>
                <input id="thanks_title" name="thanks_title" class="form-control" required value="{{ old('thanks_title', $kunjungan->thanks_title) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="thanks_body">Paragraf</label>
                <textarea id="thanks_body" name="thanks_body" class="form-control" rows="3" required>{{ old('thanks_body', $kunjungan->thanks_body) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="thanks_btn_text">Tombol kembali</label>
                <input id="thanks_btn_text" name="thanks_btn_text" class="form-control" required value="{{ old('thanks_btn_text', $kunjungan->thanks_btn_text) }}">
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('kunjungan.create') }}" target="_blank" rel="noopener" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> Lihat /kunjungan</a>
    </div>
</form>
@endsection
