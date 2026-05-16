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
    margin-bottom: 2.5rem;
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
    max-width: 640px;
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

.schedule-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 18px;
    margin-bottom: 3rem;
}
.schedule-day {
    background: rgba(255,255,255,0.96);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 14px;
    box-shadow: 0 10px 26px rgba(8,47,73,0.05);
}
.schedule-day-title {
    font-family: 'Literata', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--biru-gelap);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.schedule-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    gap: 10px;
}
.schedule-item {
    border-top: 1px solid rgba(186,230,253,0.7);
    padding-top: 10px;
}
.schedule-item:first-child { border-top: 0; padding-top: 0; }
.schedule-time {
    font-size: 0.86rem;
    color: #64748b;
    margin-bottom: 6px;
}
.schedule-title {
    font-weight: 800;
    color: var(--biru-gelap);
    line-height: 1.35;
}
.schedule-meta {
    margin-top: 6px;
    font-size: 0.9rem;
    color: var(--teks-muted);
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.schedule-desc {
    margin-top: 8px;
    font-size: 0.92rem;
    color: var(--teks-muted);
    line-height: 1.65;
}

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

@media (max-width: 480px) {
    .schedule-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="program-hero">
    <h1>{{ $programPage->hero_title }}</h1>
    <p>{{ $programPage->hero_subtitle }}</p>
</div>

@if($jadwalTampil)
    <div style="margin-bottom: 1rem;">
        <div class="section-label"><i class="fas fa-clock" aria-hidden="true"></i> {{ $programPage->rutin_section_label }}</div>
        <h2 class="section-head">{{ $programPage->rutin_section_title }}</h2>
        <p class="section-sub">{{ $programPage->rutin_section_sub }}</p>
    </div>

    @include('partials.jadwal-kegiatan-anak-schedule', ['hariOptions' => $hariOptions, 'jadwalByHari' => $jadwalByHari])
@else
    <div style="margin: 0 0 3rem;">
        <div class="section-label"><i class="fas fa-calendar-days" aria-hidden="true"></i> {{ $programPage->empty_section_label }}</div>
        <h2 class="section-head">{{ $programPage->empty_section_title }}</h2>
        <p class="section-sub">{{ $programPage->empty_section_sub }}</p>
    </div>
@endif

<div class="program-page-cta">
    <h2>{{ $programPage->cta_title }}</h2>
    <p>{{ $programPage->cta_subtitle }}</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('donasi.index') }}" class="btn btn-white"><i class="fas fa-heart" style="margin-right:6px;" aria-hidden="true"></i>{{ $programPage->cta_btn_donasi }}</a>
        <a href="{{ route('kunjungan.create') }}" class="btn btn-outline-light"><i class="fas fa-door-open" style="margin-right:6px;" aria-hidden="true"></i>{{ $programPage->cta_btn_kunjungan }}</a>
    </div>
</div>
@endsection
