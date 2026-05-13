@extends('layouts.app')

@section('title', $kunjunganPage->page_meta_title ?? 'Ajukan Kunjungan')

@push('styles')
<style>
.kunjungan-hero {
    background: linear-gradient(135deg, var(--aksen-gelap) 0%, var(--aksen) 65%, var(--biru-muda-gelap) 100%);
    border-radius: 24px;
    padding: 3.5rem 2.5rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.kunjungan-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.12) 0%, transparent 52%);
}
.kunjungan-hero-image {
    position: relative;
    max-width: min(520px, 100%);
    margin: 0 auto 1.25rem;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0,0,0,0.2);
}
.kunjungan-hero-image img {
    display: block;
    width: 100%;
    height: auto;
    vertical-align: middle;
}
.kunjungan-hero h1 {
    font-size: clamp(2rem,5vw,2.8rem);
    font-weight: 800;
    margin-bottom: 1rem;
    position: relative;
    line-height: 1.2;
    word-wrap: break-word;
}
.kunjungan-hero h1 i { margin-right: 0.3em; opacity: 0.95; color: #fff; }
.kunjungan-hero p  {
    font-size: 1.05rem;
    opacity: 0.9;
    max-width: 580px;
    margin: 0 auto;
    line-height: 1.7;
    position: relative;
    word-wrap: break-word;
}

/* Penjelasan tujuan halaman */
.page-explanation {
    background: var(--latar-panel);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.5rem 2rem;
    margin-bottom: 2rem;
}
.page-explanation h2 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--aksen-gelap);
    margin-bottom: 1rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    line-height: 1.35;
}
.page-explanation h2 i { flex-shrink: 0; margin-top: 0.15rem; }
.page-explanation ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.page-explanation li {
    display: flex;
    align-items: flex-start;
    gap: 0.6rem;
    margin-bottom: 0.6rem;
    font-size: 0.95rem;
    color: var(--teks-muted);
    line-height: 1.5;
}
.page-explanation li:last-child { margin-bottom: 0; }
.page-explanation li i {
    color: var(--aksen);
    margin-top: 0.2rem;
    flex-shrink: 0;
}
/* Satu kolom teks: isi HTML harus dalam wrapper agar flex tidak memecah tiap teks/<strong> jadi kolom */
.page-explanation-li-body {
    flex: 1;
    min-width: 0;
    overflow-wrap: break-word;
    word-wrap: break-word;
}
.page-explanation-li-body strong {
    font-weight: 700;
    color: var(--teks);
}
.page-explanation-li-body p { margin: 0; }

.kunjungan-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    align-items: start;
}
.form-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    border: 1px solid var(--border);
    box-shadow: 0 10px 36px rgba(8, 47, 73, 0.09);
    position: sticky;
    top: 88px;
}
.info-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    border: 1px solid var(--border);
    box-shadow: 0 4px 20px rgba(8, 47, 73, 0.06);
    margin-bottom: 1.5rem;
}
.info-card h3 { font-size: 1.1rem; color: var(--biru-gelap); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }

.step-list { list-style: none; }
.step-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.25rem;
    align-items: flex-start;
}
.step-num {
    width: 32px; height: 32px; min-width: 32px;
    background: linear-gradient(135deg, var(--aksen), var(--biru-muda-gelap));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 800; font-size: 0.85rem;
}
.step-text h4 { font-weight: 700; color: var(--teks-gelap); margin-bottom: 0.2rem; font-size: 0.95rem; }
.step-text { min-width: 0; flex: 1; }
.step-text p  { font-size: 0.85rem; color: var(--teks-muted); line-height: 1.5; }

.kegiatan-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-top: 1rem;
}
.kegiatan-item {
    background: rgba(14, 165, 233, 0.08);
    border: 1px solid rgba(14, 165, 233, 0.18);
    border-radius: 10px;
    padding: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.85rem;
    color: var(--aksen-gelap);
    font-weight: 500;
    min-width: 0;
    word-wrap: break-word;
}
.kegiatan-item i { flex-shrink: 0; }

.kunjungan-layout > div { min-width: 0; }

.submit-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, var(--aksen), var(--biru-muda-gelap));
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(14, 165, 233, 0.28);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.35rem;
    text-align: center;
    line-height: 1.3;
    box-sizing: border-box;
}
.submit-btn i { flex-shrink: 0; color: inherit; }
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(14, 165, 233, 0.38); }

.form-card-footer-note {
    text-align: center;
    margin-top: 1.25rem;
    font-size: 0.82rem;
    color: var(--teks-muted);
    line-height: 1.5;
    padding: 0 0.25rem;
}
.form-card-footer-note i { margin-right: 0.35em; color: var(--aksen); }

.aturan-list {
    list-style: none;
}
.aturan-list li {
    display: flex; gap: 0.5rem;
    margin-bottom: 0.6rem;
    font-size: 0.88rem;
    color: var(--teks-muted);
    align-items: flex-start;
}
.aturan-list .dot {
    width: 6px; height: 6px;
    background: var(--aksen);
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 7px;
}

.required-star {
    color: #b91c1c;
    margin-left: 0.15rem;
}

.field-status {
    color: var(--teks-muted);
    font-size: 0.82rem;
    font-weight: 500;
    margin-left: 0.2rem;
}

.field-note {
    margin-top: 0.35rem;
    display: block;
    color: var(--teks-muted);
    font-size: 0.82rem;
}

@media (max-width: 860px) {
    .kunjungan-layout {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    /* Form di atas agar mudah diisi di ponsel */
    .kunjungan-layout > div:not(.form-card) { order: 2; }
    .kunjungan-layout > .form-card { order: 1; }
    .form-card { position: static; }
    .kegiatan-grid { grid-template-columns: 1fr; }
    .form-card .form-row { grid-template-columns: 1fr; }
}

@media (max-width: 640px) {
    .kunjungan-hero {
        padding: 2rem 1.15rem;
        border-radius: 16px;
        margin-bottom: 1.5rem;
    }
    .kunjungan-hero h1 { font-size: clamp(1.45rem, 7vw, 2rem); }
    .kunjungan-hero p { font-size: 0.95rem; }
    .kunjungan-hero-image {
        max-width: 100%;
        margin-bottom: 1rem;
        border-radius: 12px;
    }
    .page-explanation {
        padding: 1.15rem 1rem;
        margin-bottom: 1.5rem;
        border-radius: 14px;
    }
    .page-explanation h2 { font-size: 1rem; }
    .page-explanation li { font-size: 0.9rem; gap: 0.5rem; }
    .info-card {
        padding: 1.2rem 1rem;
        border-radius: 16px;
        margin-bottom: 1rem;
    }
    .info-card h3 {
        font-size: 1rem;
        line-height: 1.3;
        align-items: flex-start;
    }
    .info-card h3 i { flex-shrink: 0; margin-top: 0.12rem; }
    .form-card {
        padding: 1.25rem 1rem;
        border-radius: 16px;
    }
    .form-card > h2 { font-size: 1.2rem !important; line-height: 1.25; }
    .form-card > p { font-size: 0.88rem !important; margin-bottom: 1.35rem !important; }
    .step-item { gap: 0.65rem; margin-bottom: 1rem; }
    .step-num {
        width: 28px;
        height: 28px;
        min-width: 28px;
        font-size: 0.8rem;
    }
    .step-text h4 { font-size: 0.9rem; }
    .step-text p { font-size: 0.82rem; }
    .kegiatan-item {
        padding: 0.65rem 0.7rem;
        font-size: 0.82rem;
        min-height: 44px;
        box-sizing: border-box;
    }
    .submit-btn {
        font-size: 1rem;
        padding: 0.95rem 0.85rem;
        min-height: 48px;
    }
    /* Cegah zoom iOS pada fokus input */
    .form-card .form-group input,
    .form-card .form-group textarea,
    .form-card .form-group select {
        font-size: 16px;
    }
    .aturan-list li { font-size: 0.84rem; line-height: 1.45; }
}

@media (max-width: 380px) {
    .kunjungan-hero { padding: 1.65rem 0.9rem; }
    .kegiatan-grid { gap: 0.5rem; }
}
</style>
@endpush

@section('content')
<div class="kunjungan-hero">
    @if(!empty($kunjunganPage->hero_image))
        <div class="kunjungan-hero-image">
            <img src="{{ asset('storage/'.$kunjunganPage->hero_image) }}" alt="">
        </div>
    @endif
    <h1><i class="{{ $kunjunganPage->hero_icon }}" aria-hidden="true"></i>{{ $kunjunganPage->hero_title }}</h1>
    <p>{{ $kunjunganPage->hero_subtitle }}</p>
</div>

<div class="page-explanation">
    <h2><i class="{{ $kunjunganPage->explain_icon }}" aria-hidden="true"></i> {{ $kunjunganPage->explain_title }}</h2>
    <ul>
        <li><i class="fas fa-check" aria-hidden="true"></i><div class="page-explanation-li-body">{!! $kunjunganPage->explain_li_1 !!}</div></li>
        <li><i class="fas fa-check" aria-hidden="true"></i><div class="page-explanation-li-body">{!! $kunjunganPage->explain_li_2 !!}</div></li>
        <li><i class="fas fa-check" aria-hidden="true"></i><div class="page-explanation-li-body">{!! $kunjunganPage->explain_li_3 !!}</div></li>
    </ul>
</div>

<div class="kunjungan-layout">
    <!-- Info Kiri -->
    <div>
        <div class="info-card">
            <h3><i class="{{ $kunjunganPage->flow_icon }}" style="color:var(--aksen);" aria-hidden="true"></i> {{ $kunjunganPage->flow_title }}</h3>
            <ul class="step-list">
                <li class="step-item"><div class="step-num">1</div><div class="step-text"><h4>{{ $kunjunganPage->step1_title }}</h4><p>{{ $kunjunganPage->step1_text }}</p></div></li>
                <li class="step-item"><div class="step-num">2</div><div class="step-text"><h4>{{ $kunjunganPage->step2_title }}</h4><p>{{ $kunjunganPage->step2_text }}</p></div></li>
                <li class="step-item"><div class="step-num">3</div><div class="step-text"><h4>{{ $kunjunganPage->step3_title }}</h4><p>{{ $kunjunganPage->step3_text }}</p></div></li>
                <li class="step-item"><div class="step-num">4</div><div class="step-text"><h4>{{ $kunjunganPage->step4_title }}</h4><p>{{ $kunjunganPage->step4_text }}</p></div></li>
            </ul>
        </div>

        <div class="info-card">
            <h3><i class="{{ $kunjunganPage->activities_icon }}" style="color:var(--aksen);" aria-hidden="true"></i> {{ $kunjunganPage->activities_title }}</h3>
            <p style="color: var(--teks-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">{{ $kunjunganPage->activities_intro }}</p>
            <div class="kegiatan-grid">
                @for ($i = 1; $i <= 6; $i++)
                    @php $icon = $kunjunganPage->{'act'.$i.'_icon'}; $text = $kunjunganPage->{'act'.$i.'_text'}; @endphp
                    <div class="kegiatan-item"><i class="{{ $icon }}" style="margin-right:6px;color:var(--aksen);" aria-hidden="true"></i>{{ $text }}</div>
                @endfor
            </div>
        </div>

        <div class="info-card" style="background: #fffaf2;">
            <h3><i class="{{ $kunjunganPage->rules_icon }}" style="color:#D97706;" aria-hidden="true"></i> {{ $kunjunganPage->rules_title }}</h3>
            <ul class="aturan-list">
                @for ($i = 1; $i <= 5; $i++)
                    <li><span class="dot"></span>{{ $kunjunganPage->{'rule'.$i} }}</li>
                @endfor
            </ul>
        </div>

    </div>

    <!-- Form Kanan -->
    <div class="form-card">
        <h2 style="font-size: 1.4rem; color: var(--biru-gelap); margin-bottom: 0.4rem;">{{ $kunjunganPage->form_title }}</h2>
        <p style="color: var(--teks-muted); font-size: 0.9rem; margin-bottom: 2rem;">{{ $kunjunganPage->form_intro }}</p>

        <form action="{{ route('kunjungan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>{{ $kunjunganPage->lbl_nama }} <span class="required-star">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="{{ $kunjunganPage->ph_nama }}">
                @error('nama')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>{{ $kunjunganPage->lbl_email }} <span class="required-star">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="{{ $kunjunganPage->ph_email }}">
                    @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>{{ $kunjunganPage->lbl_telepon }} <span class="field-status">{{ $kunjunganPage->tag_optional }}</span></label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="{{ $kunjunganPage->ph_telepon }}">
                    @error('telepon')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <label>{{ $kunjunganPage->lbl_tanggal }} <span class="required-star">*</span></label>
                <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}" required min="{{ date('Y-m-d') }}">
                <small class="field-note">{{ $kunjunganPage->note_tanggal }}</small>
                @error('tanggal_kunjungan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>{{ $kunjunganPage->lbl_instansi }} <span class="field-status">{{ $kunjunganPage->tag_optional_instansi }}</span></label>
                <input type="text" name="instansi" value="{{ old('instansi') }}" placeholder="{{ $kunjunganPage->ph_instansi }}">
                @error('instansi')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>{{ $kunjunganPage->lbl_keperluan }} <span class="required-star">*</span></label>
                <textarea name="keperluan" required placeholder="{{ $kunjunganPage->ph_keperluan }}">{{ old('keperluan') }}</textarea>
                <small class="field-note">{{ $kunjunganPage->note_keperluan }}</small>
                @error('keperluan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>{{ $kunjunganPage->lbl_catatan }} <span class="field-status">{{ $kunjunganPage->tag_optional_catatan }}</span></label>
                <textarea name="catatan" placeholder="{{ $kunjunganPage->ph_catatan }}">{{ old('catatan') }}</textarea>
                <small class="field-note">{{ $kunjunganPage->note_catatan }}</small>
                @error('catatan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="submit-btn"><i class="{{ $kunjunganPage->btn_submit_icon }}" aria-hidden="true"></i>{{ $kunjunganPage->btn_submit_text }}</button>
        </form>
        <div class="form-card-footer-note">
            <i class="{{ $kunjunganPage->form_footer_icon }}" aria-hidden="true"></i>{{ $kunjunganPage->form_footer_text }}
        </div>
    </div>
</div>
@endsection
