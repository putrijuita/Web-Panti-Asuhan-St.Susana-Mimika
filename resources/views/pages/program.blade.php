@extends('layouts.app')

@section('title', 'Kegiatan Rutin Kami - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.program-hero {
    background: linear-gradient(135deg, #0f4c75 0%, var(--biru-tua) 50%, #3eb489 100%);
    border-radius: 24px;
    padding: 4rem 3rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.program-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 25% 75%, rgba(255,255,255,0.07) 0%, transparent 55%),
                radial-gradient(circle at 80% 20%, rgba(62,180,137,0.15) 0%, transparent 50%);
}
.program-hero h1 { font-size: clamp(2rem,5vw,3rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.program-hero p  { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; line-height: 1.7; position: relative; }

.section-label {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(46,134,171,0.1); color: var(--biru-tua);
    padding: 0.35rem 1rem; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 0.75rem;
}
.section-head { font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 0.5rem; }
.section-sub  { color: #64748B; font-size: 1rem; margin-bottom: 2rem; }

.program-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 30px rgba(46,134,171,0.08);
    transition: all 0.4s;
    margin-bottom: 2rem;
    display: grid;
    grid-template-columns: 1fr 2fr;
}
.program-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(46,134,171,0.15); }
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
.program-content p  { color: #64748B; line-height: 1.7; margin-bottom: 1rem; }
.program-list { list-style: none; margin-bottom: 1.5rem; }
.program-list li {
    display: flex; align-items: flex-start; gap: 0.6rem;
    margin-bottom: 0.6rem; color: #475569; font-size: 0.95rem;
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
    background: #ffffff;
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 20px 55px rgba(15,76,117,0.18);
    transform-origin: center;
    transition: transform 0.45s ease, box-shadow 0.45s ease;
}
.mini-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 0 0, rgba(59,130,246,0.12), transparent 55%),
        radial-gradient(circle at 100% 100%, rgba(34,197,94,0.12), transparent 55%);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.5s ease;
}
.mini-card:hover {
    transform: translateY(-10px) scale(1.01);
    box-shadow: 0 26px 70px rgba(15,76,117,0.28);
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
    color: #e0f2fe;
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
    background: rgba(15,23,42,0.55);
    color: #e2e8f0;
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
    color: #0f172a;
    background: #e0f2fe;
    box-shadow: 0 12px 25px rgba(15,23,42,0.55);
}
.mini-card:nth-child(3n+1) .mini-index {
    background: #fee2e2;
}
.mini-card:nth-child(3n+2) .mini-index {
    background: #dcfce7;
}
.mini-card:nth-child(3n) .mini-index {
    background: #e0f2fe;
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
    background: rgba(148,163,184,0.16);
    color: #475569;
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
    background: var(--biru-tua);
}
.mini-card h4 {
    font-weight: 800;
    color: var(--biru-gelap);
    margin-bottom: 0.4rem;
    font-size: 1.08rem;
}
.mini-card p {
    color: #64748B;
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
    background: rgba(148,163,184,0.18);
    color: #475569;
}
.mini-chip.primary {
    background: rgba(59,130,246,0.14);
    color: #1d4ed8;
}
.mini-chip.success {
    background: rgba(22,163,74,0.14);
    color: #15803d;
}

.unggul-wrapper {
    margin-bottom: 3rem;
}
.unggul-card {
    background: white;
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 18px 55px rgba(15,76,117,0.22);
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
    color: #e0f2fe;
    font-size: 3.2rem;
}
.unggul-media-label {
    position: absolute;
    left: 1.2rem;
    top: 1.2rem;
    padding: 0.24rem 0.9rem;
    border-radius: 999px;
    background: rgba(15,23,42,0.7);
    color: #e2e8f0;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    font-weight: 700;
    backdrop-filter: blur(12px);
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
    background: rgba(59,130,246,0.10);
    color: #1d4ed8;
    font-size: 0.74rem;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    font-weight: 700;
    margin-bottom: 0.85rem;
}
.unggul-eyebrow span:first-child {
    width: 8px;
    height: 8px;
    flex-shrink: 0;
    border-radius: 999px;
    background: #1d4ed8;
}
.unggul-body h3 {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--biru-gelap);
    margin: 0 0 0.6rem 0;
    line-height: 1.3;
}
.unggul-body p {
    color: #475569;
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
    background: rgba(59,130,246,0.08);
}
.unggul-share-row {
    display: flex;
    flex-wrap: wrap;
    gap: 0.7rem;
    align-items: center;
}
.unggul-share-row small {
    color: #94a3b8;
    font-size: 0.75rem;
}
.btn-share-kegiatan {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.55rem 1.2rem;
    border-radius: 999px;
    border: none;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
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
    background: white;
    border-radius: 16px;
    padding: 2rem 1.5rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(46,134,171,0.06);
}
.involvement-item .step {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
    border-radius: 12px; display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 800; font-size: 1.1rem;
    margin: 0 auto 1rem;
}
.involvement-item h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.involvement-item p  { color: #64748B; font-size: 0.85rem; }

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
    <h1>Kegiatan Rutin Kami</h1>
    <p>Berbagai kegiatan rutin yang kami jalankan untuk memastikan setiap anak tumbuh sehat, cerdas, berkarakter, dan mandiri.</p>
</div>

@if($unggulKegiatan->isNotEmpty())
    <div class="unggul-wrapper">
        <div style="margin-bottom: 1rem;">
            <div class="section-label"><i class="fas fa-star"></i> Program Unggulan</div>
            <h2 class="section-head">Program Unggulan di Panti</h2>
            <p class="section-sub">Program-program inti yang menjadi fokus pengembangan karakter, pendidikan, dan kemandirian anak-anak.</p>
        </div>

        @foreach($unggulKegiatan as $index => $item)
            <article class="unggul-card {{ $index % 2 === 1 ? 'unggul-card-reverse' : '' }}">
                <div class="unggul-media">
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}">
                    @else
                        <div class="unggul-media-fallback">🌟</div>
                    @endif
                    <div class="unggul-media-label">Program Unggulan</div>
                </div>
                <div class="unggul-body">
                    <div class="unggul-eyebrow">
                        <span></span>
                        <span>Fokus Pengembangan Anak</span>
                    </div>
                    <h3>{{ $item->nama }}</h3>
                    <p>{{ $item->deskripsi ?: 'Program fokus pembinaan karakter, pendidikan, dan kemandirian anak di Panti.' }}</p>
                    <div class="unggul-meta">
                        <span class="mini-chip primary">Anak-anak Papua</span>
                        <span class="mini-chip success">Program Unggulan</span>
                    </div>
                    @php
                        $shareText = rawurlencode('Yuk dukung program unggulan "'.$item->nama.'" di Panti Asuhan Santa Susana Timika: '.route('program'));
                    @endphp
                    <div class="unggul-share-row">
                        <a href="https://wa.me/?text={{ $shareText }}" target="_blank" rel="noopener" class="btn-share-kegiatan">
                            <i class="fab fa-whatsapp"></i>
                            <span>Bagikan Kegiatan</span>
                        </a>
                        <small>Bagikan ke keluarga & sahabat agar lebih banyak yang terlibat.</small>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endif

@if($rutinKegiatan->isNotEmpty())
    <div style="margin-bottom: 1rem;">
        <div class="section-label"><i class="fas fa-list-check"></i> Kegiatan Rutin</div>
        <h2 class="section-head">Kegiatan Rutin di Panti</h2>
        <p class="section-sub">Berikut adalah kegiatan rutin yang saat ini berjalan di Panti Asuhan Santa Susana Timika.</p>
    </div>

    <div class="mini-program-grid">
        @foreach($rutinKegiatan as $index => $item)
            <article class="mini-card">
                <div class="mini-media">
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}">
                    @else
                        <div class="mini-media-fallback">📌</div>
                    @endif
                    <div class="mini-badge-strip">
                        <span class="mini-pill">Kegiatan Rutin</span>
                        <span class="mini-index">{{ $index + 1 }}</span>
                    </div>
                </div>
                <div class="mini-body">
                    <div class="mini-eyebrow">
                        <span class="mini-eyebrow-dot"></span>
                        <span>Di Panti Santa Susana</span>
                    </div>
                    <h4>{{ $item->nama }}</h4>
                    <p>{{ $item->deskripsi ?: 'Belum ada keterangan untuk kegiatan ini, namun kegiatan ini berjalan secara rutin di Panti.' }}</p>
                    <div class="mini-meta">
                        <span class="mini-chip primary">Anak-anak Papua</span>
                        <span class="mini-chip success">Program Aktif</span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@elseif($unggulKegiatan->isEmpty())
    <div style="margin: 2rem 0 3rem;">
        <div class="section-label"><i class="fas fa-list-check"></i> Kegiatan</div>
        <h2 class="section-head">Belum Ada Kegiatan Terdaftar</h2>
        <p class="section-sub">Saat ini belum ada data kegiatan rutin yang ditampilkan. Silakan kembali lagi nanti.</p>
    </div>
@endif

<!-- Cara Terlibat -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-handshake"></i> Terlibat</div>
    <h2 class="section-head">Cara Anda Bisa Terlibat</h2>
    <div class="involvement-grid">
        <div class="involvement-item"><div class="step">1</div><h4>Pilih Program</h4><p>Pilih program yang ingin Anda dukung</p></div>
        <div class="involvement-item"><div class="step">2</div><h4>Donasikan</h4><p>Kirim donasi melalui form donasi kami</p></div>
        <div class="involvement-item"><div class="step">3</div><h4>Kunjungi</h4><p>Ajukan kunjungan dan temui anak-anak</p></div>
        <div class="involvement-item"><div class="step">4</div><h4>Dampak</h4><p>Lihat dampak nyata dari kontribusi Anda</p></div>
    </div>
</div>

<!-- CTA -->
<div style="background: linear-gradient(135deg, #0f4c75, var(--biru-tua)); border-radius: 24px; padding: 3rem 2rem; text-align: center; color: white;">
    <h2 style="font-size: 1.75rem; margin-bottom: 0.75rem;">Mulai Berkontribusi Hari Ini</h2>
    <p style="opacity: 0.9; margin-bottom: 2rem;">Setiap kontribusi, sekecil apapun, sangat berarti bagi anak-anak kami.</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('donasi.index') }}" class="btn btn-white">💝 Donasi Sekarang</a>
        <a href="{{ route('kunjungan.create') }}" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4);">🏠 Ajukan Kunjungan</a>
    </div>
</div>
@endsection
