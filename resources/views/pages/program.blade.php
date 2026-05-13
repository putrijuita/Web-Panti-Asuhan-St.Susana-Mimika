@extends('layouts.app')

@section('title')
{{ $programPage->page_meta_title }}
@endsection

@push('styles')
<style>
.program-hero {
    position: relative;
    text-align: center;
    padding: 4rem 2rem 3rem;
    overflow: hidden;
    margin-bottom: 3rem;
    border-radius: 24px;
}
.program-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 24px;
    background:
        radial-gradient(ellipse at 15% 50%, rgba(14, 165, 233, 0.12) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 50%, rgba(56, 189, 248, 0.12) 0%, transparent 55%);
    pointer-events: none;
}
.program-hero h1 {
    font-size: clamp(2rem, 5vw, 2.85rem);
    font-weight: 800;
    color: var(--biru-gelap);
    margin-bottom: 1rem;
    position: relative;
}
.program-hero p {
    font-size: 1.1rem;
    color: var(--teks-muted);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
    position: relative;
}

.section-label {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(14, 165, 233, 0.1);
    color: var(--aksen);
    padding: 0.35rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}
.section-head { font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 0.5rem; }
.section-sub  { color: var(--teks-muted); font-size: 1rem; margin-bottom: 2rem; }

.program-card {
    background: var(--putih);
    border: 1px solid var(--border);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 8px 36px rgba(8, 47, 73, 0.09);
    transition: all 0.4s;
    margin-bottom: 2rem;
    display: grid;
    grid-template-columns: 1fr 2fr;
}
.program-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 48px rgba(8, 47, 73, 0.12);
}
.program-card.reverse { direction: rtl; }
.program-card.reverse > * { direction: ltr; }
.program-visual {
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    padding: 3rem 2rem; text-align: center;
    min-height: 280px;
}
.program-icon { font-size: 4.5rem; margin-bottom: 1rem; }
.program-tag {
    display: inline-block;
    background: rgba(255,255,255,0.25);
    color: white;
    padding: 0.3rem 0.9rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.program-content { padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
.program-content h3 { font-size: 1.5rem; color: var(--biru-gelap); margin-bottom: 0.75rem; }
.program-content p  { color: var(--teks-muted); line-height: 1.7; margin-bottom: 1rem; }
.program-list { list-style: none; margin-bottom: 1.5rem; }
.program-list li {
    display: flex; align-items: flex-start; gap: 0.6rem;
    margin-bottom: 0.6rem; color: var(--teks-muted); font-size: 0.95rem;
}
.program-list .dot {
    width: 8px; height: 8px;
    background: var(--biru-tua);
    border-radius: 50%; flex-shrink: 0; margin-top: 7px;
}

.mini-program-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 2rem;
    margin-bottom: 3.5rem;
}
.mini-card {
    position: relative;
    background: var(--putih);
    border: 1px solid var(--border);
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 8px 36px rgba(8, 47, 73, 0.09);
    transform-origin: center;
    transition: transform 0.45s ease, box-shadow 0.45s ease;
}
.mini-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 0 0, rgba(14, 165, 233, 0.08), transparent 55%),
        radial-gradient(circle at 100% 100%, rgba(56, 189, 248, 0.1), transparent 55%);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.5s ease;
}
.mini-card:hover {
    transform: translateY(-8px) scale(1.01);
    box-shadow: 0 20px 56px rgba(8, 47, 73, 0.14);
}
.mini-card:hover::before {
    opacity: 1;
}
.mini-media {
    position: relative;
    height: 190px;
    overflow: hidden;
}
.mini-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scale(1.03);
    transition: transform 0.6s ease;
}
.mini-card:hover .mini-media img {
    transform: scale(1.08);
}
.mini-media-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
    color: var(--latar);
    font-size: 3rem;
}
.mini-badge-strip {
    position: absolute;
    inset: auto 1.4rem 1.4rem 1.4rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none;
}
.mini-pill {
    padding: 0.18rem 0.9rem;
    border-radius: 999px;
    backdrop-filter: blur(12px);
    background: rgba(8, 47, 73, 0.72);
    color: #f0f9ff;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    font-weight: 700;
}
.mini-index {
    width: 34px;
    height: 34px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 0.9rem;
    color: var(--aksen-gelap);
    background: var(--latar-panel);
    box-shadow: 0 8px 20px rgba(8, 47, 73, 0.2);
}
.mini-card:nth-child(3n+1) .mini-index {
    background: rgba(196, 168, 130, 0.35);
}
.mini-card:nth-child(3n+2) .mini-index {
    background: rgba(61, 122, 82, 0.2);
}
.mini-card:nth-child(3n) .mini-index {
    background: rgba(56, 189, 248, 0.22);
}
.mini-body {
    padding: 1.7rem 1.7rem 1.8rem;
}
.mini-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.18rem 0.8rem;
    border-radius: 999px;
    background: rgba(14, 165, 233, 0.1);
    color: var(--teks-muted);
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    font-weight: 700;
    margin-bottom: 0.4rem;
}
.mini-eyebrow-dot {
    width: 6px;
    height: 6px;
    border-radius: 999px;
    background: var(--aksen);
}
.mini-card h4 {
    font-weight: 800;
    color: var(--biru-gelap);
    margin-bottom: 0.4rem;
    font-size: 1.08rem;
}
.mini-card p {
    color: var(--teks-muted);
    font-size: 0.9rem;
    line-height: 1.7;
    margin-bottom: 0.6rem;
}
.mini-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.55rem;
    margin-top: 0.5rem;
}
.mini-chip {
    padding: 0.28rem 0.75rem;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 600;
    background: rgba(14, 165, 233, 0.1);
    color: var(--teks-muted);
}
.mini-chip.primary {
    background: rgba(14, 165, 233, 0.14);
    color: var(--aksen);
}
.mini-chip.success {
    background: rgba(61, 122, 82, 0.12);
    color: var(--aksen-zaitun);
}

.unggul-wrapper {
    margin-bottom: 3rem;
}
.unggul-card {
    background: var(--putih);
    border: 1px solid var(--border);
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 8px 36px rgba(8, 47, 73, 0.1);
    display: grid;
    grid-template-columns: minmax(0, 1.3fr) minmax(0, 2fr);
    align-items: stretch;
    gap: 0;
    margin-bottom: 2rem;
    position: relative;
}
.unggul-media {
    position: relative;
    min-height: 230px;
    overflow: hidden;
}
.unggul-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scale(1.03);
    transition: transform 0.6s ease;
}
.unggul-card:hover .unggul-media img {
    transform: scale(1.08);
}
.unggul-card-reverse {
    direction: rtl;
}
.unggul-card-reverse > * {
    direction: ltr;
}
.unggul-media-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
    color: var(--latar);
    font-size: 3.2rem;
}
.unggul-body {
    padding: 2.2rem 2.3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.unggul-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    background: rgba(14, 165, 233, 0.12);
    color: var(--aksen);
    font-size: 0.74rem;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    font-weight: 700;
    margin-bottom: 0.85rem;
}
.unggul-eyebrow span:first-child {
    width: 8px;
    height: 8px;
    min-width: 8px;
    border-radius: 999px;
    background: var(--aksen);
    flex-shrink: 0;
}
.unggul-body h3 {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--biru-gelap);
    margin: 0 0 0.6rem 0;
    line-height: 1.3;
}
.unggul-body p {
    color: var(--teks-muted);
    line-height: 1.7;
    margin-bottom: 1rem;
}
.unggul-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.55rem;
    margin-bottom: 1.2rem;
}
.unggul-meta .mini-chip {
    background: rgba(14, 165, 233, 0.1);
}
.unggul-share-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0.7rem;
    align-items: center;
}
.unggul-share-row small {
    color: var(--teks-muted);
    font-size: 0.75rem;
}
.btn-share-kegiatan {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.55rem 1.2rem;
    border-radius: 999px;
    border: none;
    background: linear-gradient(135deg, var(--aksen), var(--aksen-hover));
    color: var(--putih);
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
}
.btn-share-kegiatan:hover {
    filter: brightness(1.05);
    color: var(--putih);
}
.btn-share-kegiatan i {
    font-size: 0.9rem;
}

.involvement-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.involvement-item {
    background: var(--putih);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 2rem 1.5rem;
    text-align: center;
    box-shadow: 0 8px 28px rgba(8, 47, 73, 0.08);
}
.involvement-item .step {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
    border-radius: 12px; display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 800; font-size: 1.1rem;
    margin: 0 auto 1rem;
}
.involvement-item h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.involvement-item p  { color: var(--teks-muted); font-size: 0.85rem; }

.program-page-cta {
    background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
    border-radius: 24px;
    padding: 3rem 2rem;
    text-align: center;
    color: var(--putih);
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 12px 40px rgba(8, 47, 73, 0.18);
}
.program-page-cta h2 {
    font-size: 1.75rem;
    margin-bottom: 0.75rem;
    color: inherit;
}
.program-page-cta > p {
    opacity: 0.95;
    margin-bottom: 2rem;
}
.program-page-cta .btn-outline-light {
    background: rgba(255, 255, 255, 0.12);
    color: var(--putih);
    border: 2px solid rgba(255, 255, 255, 0.45);
}
.program-page-cta .btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.2);
    color: var(--putih);
}

@media (max-width: 700px) {
    .program-card { grid-template-columns: 1fr; }
    .program-card.reverse { direction: ltr; }
    .program-visual { min-height: 180px; padding: 2rem; }
    .program-content { padding: 1.75rem; }
    .unggul-card {
        grid-template-columns: 1fr;
    }
    .unggul-card-reverse {
        direction: ltr;
    }
    .unggul-body {
        padding: 1.8rem 1.6rem 2rem;
    }
}
</style>
@endpush

@section('content')
<div class="program-hero">
    <h1>{{ $programPage->hero_title }}</h1>
    <p>{{ $programPage->hero_subtitle }}</p>
</div>

@if($unggulKegiatan->isNotEmpty())
    <div class="unggul-wrapper">
        <div style="margin-bottom: 1rem;">
            <div class="section-label"><i class="fas fa-star" aria-hidden="true"></i> {{ $programPage->unggul_section_label }}</div>
            <h2 class="section-head">{{ $programPage->unggul_section_title }}</h2>
            <p class="section-sub">{{ $programPage->unggul_section_sub }}</p>
        </div>

        @foreach($unggulKegiatan as $index => $item)
            <article class="unggul-card {{ $index % 2 === 1 ? 'unggul-card-reverse' : '' }}">
                <div class="unggul-media">
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}">
                    @else
                        <div class="unggul-media-fallback"><i class="{{ $programPage->unggul_fallback_icon }}" aria-hidden="true"></i></div>
                    @endif
                </div>
                <div class="unggul-body">
                    <div class="unggul-eyebrow">
                        <span></span>
                        <span>{{ $programPage->unggul_eyebrow }}</span>
                    </div>
                    <h3>{{ $item->nama }}</h3>
                    <p>{{ $item->deskripsi ?: $programPage->unggul_default_desc }}</p>
                    <div class="unggul-meta">
                        <span class="mini-chip success">{{ $programPage->unggul_chip }}</span>
                    </div>
                    <div class="unggul-share-row">
                        <a href="{{ route('donasi.index') }}" class="btn-share-kegiatan">
                            <i class="fas fa-hand-holding-heart" aria-hidden="true"></i>
                            <span>{{ $programPage->unggul_donate_btn }}</span>
                        </a>
                        <small>{{ $programPage->unggul_donate_hint }}</small>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endif

@if($rutinKegiatan->isNotEmpty())
    <div style="margin-bottom: 1rem;">
        <div class="section-label"><i class="fas fa-list-check" aria-hidden="true"></i> {{ $programPage->rutin_section_label }}</div>
        <h2 class="section-head">{{ $programPage->rutin_section_title }}</h2>
        <p class="section-sub">{{ $programPage->rutin_section_sub }}</p>
    </div>

    <div class="mini-program-grid">
        @foreach($rutinKegiatan as $index => $item)
            <article class="mini-card">
                <div class="mini-media">
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}">
                    @else
                        <div class="mini-media-fallback"><i class="{{ $programPage->rutin_fallback_icon }}" aria-hidden="true"></i></div>
                    @endif
                    <div class="mini-badge-strip">
                        <span class="mini-pill">{{ $programPage->rutin_pill }}</span>
                        <span class="mini-index">{{ $index + 1 }}</span>
                    </div>
                </div>
                <div class="mini-body">
                    <div class="mini-eyebrow">
                        <span class="mini-eyebrow-dot"></span>
                        <span>{{ $programPage->rutin_eyebrow }}</span>
                    </div>
                    <h4>{{ $item->nama }}</h4>
                    <p>{{ $item->deskripsi ?: $programPage->rutin_default_desc }}</p>
                    <div class="mini-meta">
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@elseif($unggulKegiatan->isEmpty())
    <div style="margin: 2rem 0 3rem;">
        <div class="section-label"><i class="fas fa-list-check" aria-hidden="true"></i> {{ $programPage->empty_section_label }}</div>
        <h2 class="section-head">{{ $programPage->empty_section_title }}</h2>
        <p class="section-sub">{{ $programPage->empty_section_sub }}</p>
    </div>
@endif

<!-- Cara Terlibat -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-handshake" aria-hidden="true"></i> {{ $programPage->involve_section_label }}</div>
    <h2 class="section-head">{{ $programPage->involve_section_title }}</h2>
    <div class="involvement-grid">
        @foreach(($programPage->involve_steps ?? []) as $idx => $step)
            <div class="involvement-item">
                <div class="step">{{ $idx + 1 }}</div>
                <h4>{{ $step['title'] ?? '' }}</h4>
                <p>{{ $step['text'] ?? '' }}</p>
            </div>
        @endforeach
    </div>
</div>

<!-- CTA -->
<div class="program-page-cta">
    <h2>{{ $programPage->cta_title }}</h2>
    <p>{{ $programPage->cta_subtitle }}</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('donasi.index') }}" class="btn btn-white"><i class="fas fa-heart" style="margin-right:6px;" aria-hidden="true"></i>{{ $programPage->cta_btn_donasi }}</a>
        <a href="{{ route('kunjungan.create') }}" class="btn btn-outline-light"><i class="fas fa-door-open" style="margin-right:6px;" aria-hidden="true"></i>{{ $programPage->cta_btn_kunjungan }}</a>
    </div>
</div>
@endsection
