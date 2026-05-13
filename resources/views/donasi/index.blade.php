@extends('layouts.app')

@section('title', $donasiPage->page_meta_title ?? 'Donasi')

@push('styles')
<style>
/* ── Hero ── */
.donasi-hero-image {
    position: relative;
    max-width: min(560px, 100%);
    margin: 0 auto 1.5rem;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(8, 47, 73, 0.12);
}
.donasi-hero-image img {
    display: block;
    width: 100%;
    height: auto;
    vertical-align: middle;
}
.donasi-hero {
    position: relative;
    text-align: center;
    padding: 4.5rem 2rem 3rem;
    overflow: hidden;
    margin-bottom: 3rem;
}
.donasi-hero::before {
    content: '';
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse at 15% 50%, rgba(14,165,233,0.14) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 50%, rgba(56,189,248,0.14) 0%, transparent 55%);
    pointer-events: none;
}
.hero-badge-wrap { display: flex; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
.hero-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    padding: 0.4rem 1rem; border-radius: 50px;
    font-size: 0.82rem; font-weight: 700;
}
.badge-red   { background: rgba(14, 165, 233, 0.1); color: var(--aksen-gelap); }
.badge-green { background: rgba(56, 189, 248, 0.12); color: var(--aksen); }
.hero-badge i { color: inherit; }
.donasi-hero h1 {
    font-size: clamp(2.2rem, 5.5vw, 3.5rem);
    font-weight: 800;
    color: var(--biru-gelap);
    line-height: 1.15;
    margin-bottom: 1.25rem;
}
.donasi-hero h1 .highlight-red   { color: var(--aksen); }
.donasi-hero h1 .highlight-green { color: var(--biru-muda-gelap); }
.donasi-hero p {
    font-size: 1.15rem; color: var(--teks-muted);
    max-width: 580px; margin: 0 auto 2.5rem;
    line-height: 1.7;
}

/* ── Divider Animated ── */
.divider-or {
    display: flex; align-items: center; gap: 1rem;
    margin: 2.5rem 0;
    color: var(--teks-muted); font-weight: 700; font-size: 0.9rem;
}
.divider-or::before, .divider-or::after {
    content: ''; flex: 1;
    height: 1px; background: linear-gradient(90deg, transparent, var(--border), transparent);
}

/* ── Split Cards ── */
.split-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}
.split-card {
    border-radius: 28px;
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: 0 8px 36px rgba(8, 47, 73, 0.09);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    position: relative;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
}
.split-card:hover {
    transform: translateY(-10px) scale(1.01);
    box-shadow: 0 20px 56px rgba(8, 47, 73, 0.14);
}
.split-card-top {
    padding: 3rem 2.5rem 2.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    min-height: 260px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.split-card-top::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 30% 70%, rgba(255,255,255,0.12) 0%, transparent 60%);
}
.card-emoji {
    font-size: 5rem;
    margin-bottom: 1rem;
    position: relative;
    display: block;
    filter: drop-shadow(0 8px 16px rgba(0,0,0,0.15));
    transition: transform 0.4s;
}
.split-card:hover .card-emoji { transform: scale(1.15) rotate(-5deg); }
/* Ikon besar di header kartu: latar gelap → putih */
.split-card-top .card-emoji i { color: #fff; }
.card-type-label {
    display: inline-block;
    background: rgba(255,255,255,0.25);
    color: white;
    padding: 0.3rem 1rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 1rem;
}
.split-card-top h2 {
    font-size: 1.85rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
    position: relative;
}
.split-card-top p {
    color: rgba(255,255,255,0.85);
    font-size: 0.95rem;
    line-height: 1.6;
    position: relative;
}
.split-card-bottom {
    background: white;
    padding: 2rem 2.5rem 2.5rem;
    flex: 1;
}
.feature-list { list-style: none; margin-bottom: 2rem; }
.feature-list li {
    display: flex; align-items: flex-start; gap: 0.75rem;
    margin-bottom: 0.85rem;
    font-size: 0.9rem; color: var(--teks-muted);
    line-height: 1.5;
}
.feature-list .check {
    width: 22px; height: 22px; min-width: 22px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem;
    color: white;
    font-weight: 900;
    margin-top: 1px;
}
.feature-list .check i { color: #fff; }
.cta-btn {
    display: block;
    width: 100%;
    padding: 1rem;
    border-radius: 16px;
    text-align: center;
    font-weight: 700;
    font-size: 1.05rem;
    text-decoration: none;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
}
.cta-btn:hover { transform: translateY(-2px); }

/* ── Info Strip ── */
.info-strip {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.25rem;
    margin-bottom: 3rem;
}
.info-strip-item {
    background: white;
    border-radius: 18px;
    padding: 1.5rem;
    text-align: center;
    border: 1px solid var(--border);
    box-shadow: 0 4px 20px rgba(8, 47, 73, 0.06);
    border-top: 3px solid transparent;
    transition: transform 0.3s;
}
.info-strip-item:hover { transform: translateY(-4px); }
.info-strip-item .icon { font-size: 2rem; margin-bottom: 0.75rem; }
.info-strip-item h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.3rem; font-size: 0.95rem; }
.info-strip-item p  { font-size: 0.82rem; color: var(--teks-muted); line-height: 1.5; }

/* ── Comparison Table ── */
.compare-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: 0 4px 24px rgba(8, 47, 73, 0.07);
    margin-bottom: 3rem;
}
.compare-table th {
    padding: 1.25rem 1.5rem;
    font-size: 1rem;
    font-weight: 700;
    color: white;
}
.compare-table th:first-child { background: var(--latar-panel); color: var(--teks-muted); }
.compare-table th:nth-child(2) { background: linear-gradient(135deg, var(--aksen), var(--biru-muda-gelap)); }
.compare-table th:nth-child(3) { background: linear-gradient(135deg, var(--aksen-gelap), var(--aksen)); }
.compare-table td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border);
    font-size: 0.9rem;
    color: var(--teks-muted);
}
.compare-table tr:last-child td { border-bottom: none; }
.compare-table td:first-child { font-weight: 600; color: var(--teks-gelap); }
.compare-table td:nth-child(2) { background: rgba(14, 165, 233, 0.06); text-align: center; }
.compare-table td:nth-child(3) { background: rgba(56, 189, 248, 0.08); text-align: center; }
.compare-table .yes { color: var(--aksen); font-size: 1.1rem; }
.compare-table .no  { color: #9f1239; font-size: 1.1rem; }

/* ── Transparansi Donasi ── */
.transparansi-section { margin-bottom: 3rem; }
.transparansi-card {
    background: white;
    border-radius: 20px;
    border: 1px solid var(--border);
    box-shadow: 0 4px 24px rgba(8, 47, 73, 0.07);
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.transparansi-card h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--biru-gelap);
    padding: 1.25rem 1.5rem;
    margin: 0;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.transparansi-card h3 > i { color: var(--biru-gelap); }
.transparansi-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}
.transparansi-table th {
    text-align: left;
    padding: 0.85rem 1.5rem;
    background: var(--latar-panel);
    color: var(--teks-muted);
    font-weight: 700;
}
.transparansi-table td {
    padding: 0.85rem 1.5rem;
    border-bottom: 1px solid var(--border);
    color: var(--teks-muted);
}
.transparansi-table tr:last-child td { border-bottom: none; }
.transparansi-table .nominal { font-weight: 700; color: var(--aksen); }
.download-card {
    background: #f0f9ff;
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 1.5rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}
.download-card p { margin: 0; color: var(--teks-gelap); font-weight: 600; font-size: 1rem; flex: 1; min-width: 200px; }
.download-card > p i { color: var(--biru-gelap); margin-right: 0.4em; }
.download-card-actions a i { color: inherit; }
.download-card-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.65rem;
    align-items: center;
    justify-content: flex-end;
}
.download-card-actions a {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1.25rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s, border-color 0.2s;
}
.download-card-actions a.download-view {
    background: white;
    color: var(--aksen);
    border: 2px solid var(--aksen);
}
.download-card-actions a.download-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(14,165,233,0.2);
    background: rgba(14, 165, 233, 0.06);
    color: var(--aksen-hover);
}
.download-card-actions a.download-save {
    background: linear-gradient(135deg, var(--aksen), var(--biru-muda-gelap));
    color: white;
    border: 2px solid transparent;
}
.download-card-actions a.download-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(14,165,233,0.35);
    color: white;
}

.grafik-donasi-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.grafik-donasi-card {
    border-radius: 16px;
    padding: 1.25rem;
    text-align: center;
    border: 1px solid var(--border);
    box-shadow: 0 4px 18px rgba(8, 47, 73, 0.06);
    min-width: 0;
}
.grafik-donasi-card h4 { font-size: 0.8rem; font-weight: 700; margin: 0 0 0.5rem 0; line-height: 1.25; }
.grafik-donasi-card .nilai { font-size: clamp(0.95rem, 3.5vw, 1.1rem); font-weight: 800; word-break: break-word; }

.grafik-chart-wrap {
    position: relative;
    width: 100%;
    height: min(280px, 42vh);
    min-height: 200px;
}
.grafik-chart-wrap canvas {
    max-width: 100%;
}

.transparansi-card-inner {
    padding: 1rem 1.5rem;
}

.transparansi-table-wrap {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

@media (min-width: 561px) {
    .transparansi-table { min-width: 520px; }
}

@media (max-width: 700px) {
    .split-grid { grid-template-columns: 1fr; }
    .split-card-top { min-height: 200px; padding: 2.5rem 2rem 2rem; }
    .split-card-bottom { padding: 1.5rem 1.15rem; }
    .compare-table { display: none; }
    .donasi-hero { padding: 2.5rem 1rem 2rem; }
    .grafik-donasi-cards { grid-template-columns: 1fr; gap: 0.65rem; }
    .grafik-donasi-card { padding: 0.85rem 0.75rem; }
    .grafik-donasi-card .nilai { font-size: 1rem; }
    .grafik-chart-wrap {
        height: 240px;
        min-height: 220px;
        margin: 0 -0.25rem;
    }
    .transparansi-card h3 {
        font-size: 1rem;
        padding: 1rem 1rem;
        line-height: 1.3;
        align-items: flex-start;
    }
    .transparansi-card h3 > i { margin-top: 0.15rem; flex-shrink: 0; }
    .transparansi-card-inner { padding: 0.75rem 1rem; }
    .download-card {
        flex-direction: column;
        align-items: stretch;
        padding: 1.1rem 1rem;
    }
    .download-card p { min-width: 0; font-size: 0.92rem; }
    .download-card-actions {
        justify-content: stretch;
        flex-direction: column;
    }
    .download-card-actions a {
        justify-content: center;
        width: 100%;
    }
}

/* Tabel → kartu baris di layar sempit (tanpa scroll horizontal) */
@media (max-width: 560px) {
    .transparansi-table-wrap { overflow-x: visible; }
    .transparansi-table { font-size: 0.88rem; min-width: 0; }
    .transparansi-table thead { display: none; }
    .transparansi-table tbody tr {
        display: block;
        border: 1px solid var(--border);
        border-radius: 12px;
        margin-bottom: 0.75rem;
        padding: 0.5rem 0;
        background: #fff;
    }
    .transparansi-table tbody tr:last-child { margin-bottom: 0; }
    .transparansi-table td {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.45rem 0.85rem;
        border-bottom: none;
        text-align: right;
        word-break: break-word;
    }
    .transparansi-table td::before {
        content: attr(data-label);
        font-weight: 700;
        color: var(--biru-gelap);
        text-align: left;
        flex-shrink: 0;
        max-width: 42%;
    }
    .transparansi-table td.nominal { color: var(--aksen); }
    .transparansi-table tbody tr td[colspan] {
        display: block;
        text-align: center;
        padding: 1.5rem 0.75rem;
    }
    .transparansi-table tbody tr td[colspan]::before {
        display: none;
        content: '';
    }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="donasi-hero">
    @if(!empty($donasiPage->hero_image))
        <div class="donasi-hero-image">
            <img src="{{ asset('storage/'.$donasiPage->hero_image) }}" alt="">
        </div>
    @endif
    <div class="hero-badge-wrap">
        <span class="hero-badge badge-red"><i class="{{ $donasiPage->hero_badge_keuangan_icon }}" style="margin-right:6px;" aria-hidden="true"></i>{{ $donasiPage->hero_badge_keuangan_text }}</span>
        <span style="color:var(--teks-muted); font-weight:700; font-size:1.1rem; align-self:center;">{{ $donasiPage->hero_badge_separator }}</span>
        <span class="hero-badge badge-green"><i class="{{ $donasiPage->hero_badge_jasa_icon }}" style="margin-right:6px;" aria-hidden="true"></i>{{ $donasiPage->hero_badge_jasa_text }}</span>
    </div>
    <h1>
        {{ $donasiPage->hero_title_line1 }}<br>
        <span class="highlight-red">{{ $donasiPage->hero_word_red }}</span> &amp;
        <span class="highlight-green">{{ $donasiPage->hero_word_green }}</span>
    </h1>
    <p>{!! $donasiPage->hero_subtitle !!}</p>
</section>

<!-- Split Cards Pilihan -->
<div class="split-grid">
    <!-- Donasi Keuangan -->
    <a href="{{ route('donasi.keuangan') }}" class="split-card">
        <div class="split-card-top" style="background: linear-gradient(135deg, var(--aksen-gelap), var(--aksen) 55%, var(--biru-muda-gelap));">
            <span class="card-emoji" aria-hidden="true"><i class="{{ $donasiPage->card_keu_top_icon }}"></i></span>
            <span class="card-type-label">{{ $donasiPage->card_keu_pill }}</span>
            <h2>{{ $donasiPage->card_keu_title }}</h2>
            <p>{{ $donasiPage->card_keu_intro }}</p>
        </div>
        <div class="split-card-bottom">
            <ul class="feature-list">
                <li>
                    <span class="check" style="background:var(--aksen);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_keu_feat1 }}
                </li>
                <li>
                    <span class="check" style="background:var(--aksen);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_keu_feat2 }}
                </li>
                <li>
                    <span class="check" style="background:var(--aksen);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_keu_feat3 }}
                </li>
                <li>
                    <span class="check" style="background:var(--aksen);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_keu_feat4 }}
                </li>
            </ul>
            <span class="cta-btn" style="background: linear-gradient(135deg, var(--aksen), var(--biru-muda-gelap)); color: white; box-shadow: 0 6px 24px rgba(14,165,233,0.3);">
                {{ $donasiPage->card_keu_cta }}
            </span>
        </div>
    </a>

    <!-- Donasi Jasa -->
    <a href="{{ route('donasi.jasa') }}" class="split-card">
        <div class="split-card-top" style="background: linear-gradient(135deg, #234a32, var(--aksen-zaitun) 55%, #4a8f5c);">
            <span class="card-emoji" aria-hidden="true"><i class="{{ $donasiPage->card_jasa_top_icon }}"></i></span>
            <span class="card-type-label">{{ $donasiPage->card_jasa_pill }}</span>
            <h2>{{ $donasiPage->card_jasa_title }}</h2>
            <p>{{ $donasiPage->card_jasa_intro }}</p>
        </div>
        <div class="split-card-bottom">
            <ul class="feature-list">
                <li>
                    <span class="check" style="background:var(--aksen-zaitun);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_jasa_feat1 }}
                </li>
                <li>
                    <span class="check" style="background:var(--aksen-zaitun);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_jasa_feat2 }}
                </li>
                <li>
                    <span class="check" style="background:var(--aksen-zaitun);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_jasa_feat3 }}
                </li>
                <li>
                    <span class="check" style="background:var(--aksen-zaitun);" aria-hidden="true"><i class="fas fa-check"></i></span>
                    {{ $donasiPage->card_jasa_feat4 }}
                </li>
            </ul>
            <span class="cta-btn" style="background: linear-gradient(135deg, #2f5a40, var(--aksen-zaitun)); color: white; box-shadow: 0 6px 24px rgba(61,122,82,0.35);">
                {{ $donasiPage->card_jasa_cta }}
            </span>
        </div>
    </a>
</div>

<!-- Transparansi Donasi -->
<section class="transparansi-section">
    {{-- Grafik Pemasukan, Pengeluaran & Sisa Saldo --}}
    <div class="transparansi-card">
        <h3><i class="{{ $donasiPage->section_grafik_icon }}" aria-hidden="true"></i> {{ $donasiPage->section_grafik_title }}</h3>
        <div class="transparansi-card-inner">
            <div class="grafik-donasi-cards">
                <div class="grafik-donasi-card" style="background: linear-gradient(135deg,#e0f2fe 0%,#bae6fd 100%);">
                    <h4 style="color:var(--biru-gelap);">{{ $donasiPage->stat_lbl_pemasukan }}</h4>
                    <div class="nilai" style="color:var(--aksen);">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</div>
                </div>
                <div class="grafik-donasi-card" style="background: linear-gradient(135deg,#fff7ed 0%,#ffedd5 100%);">
                    <h4 style="color:#9a3412;">{{ $donasiPage->stat_lbl_pengeluaran }}</h4>
                    <div class="nilai" style="color:#c2410c;">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</div>
                </div>
                <div class="grafik-donasi-card" style="background: linear-gradient(135deg,#ecfdf5 0%,#d1fae5 100%);">
                    <h4 style="color:#14532d;">{{ $donasiPage->stat_lbl_sisa }}</h4>
                    <div class="nilai" style="color:var(--aksen-zaitun);">Rp {{ number_format($sisa_saldo, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="grafik-chart-wrap">
                <canvas id="grafikPemasukanPengeluaranSaldo"></canvas>
            </div>
        </div>
    </div>

    <div class="transparansi-card">
        <h3><i class="{{ $donasiPage->section_table_icon }}" aria-hidden="true"></i> {{ $donasiPage->section_table_title }}</h3>
        <div class="transparansi-table-wrap">
            <table class="transparansi-table">
                <thead>
                    <tr>
                        <th>{{ $donasiPage->tbl_th_nama }}</th>
                        <th>{{ $donasiPage->tbl_th_email }}</th>
                        <th>{{ $donasiPage->tbl_th_nominal }}</th>
                        <th>{{ $donasiPage->tbl_th_waktu }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donasiList as $d)
                    <tr>
                        <td data-label="{{ $donasiPage->tbl_th_nama }}">{{ $d->nama }}</td>
                        <td data-label="{{ $donasiPage->tbl_th_email }}">{{ $d->email }}</td>
                        <td class="nominal" data-label="{{ $donasiPage->tbl_th_nominal }}">Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                        <td data-label="{{ $donasiPage->tbl_th_waktu }}">{{ $d->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 2rem; color: var(--teks-muted);">{{ $donasiPage->tbl_empty_msg }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="download-card">
        <p><i class="fas fa-file-download" aria-hidden="true"></i> {{ $donasiPage->dl1_text }}</p>
        <div class="download-card-actions">
            <a href="{{ route('donasi.laporan', ['inline' => 1]) }}" target="_blank" rel="noopener noreferrer" class="download-view"><i class="fas fa-eye" aria-hidden="true"></i> Lihat di browser</a>
            <a href="{{ route('donasi.laporan') }}" class="download-save"><i class="fas fa-download" aria-hidden="true"></i> {{ $donasiPage->dl1_btn }}</a>
        </div>
    </div>
    <div class="download-card" style="margin-top: 1rem;">
        <p><i class="fas fa-file-pdf" aria-hidden="true"></i> {{ $donasiPage->dl2_text }}</p>
        <div class="download-card-actions">
            <a href="{{ route('donasi.laporan-pengelolaan', ['inline' => 1]) }}" target="_blank" rel="noopener noreferrer" class="download-view"><i class="fas fa-eye" aria-hidden="true"></i> Lihat di browser</a>
            <a href="{{ route('donasi.laporan-pengelolaan') }}" class="download-save"><i class="fas fa-download" aria-hidden="true"></i> {{ $donasiPage->dl2_btn }}</a>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function() {
    const grafikDonasi = @json($grafik_donasi);
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const labelBulan = (compact) => grafikDonasi.map(d => {
        const [y, m] = d.bulan.split('-');
        const mi = parseInt(m, 10) - 1;
        if (compact) return months[mi] + "'" + String(y).slice(-2);
        return months[mi] + ' ' + y;
    });
    const ctx = document.getElementById('grafikPemasukanPengeluaranSaldo');
    if (!ctx) return;

    const isMobile = window.matchMedia('(max-width: 640px)').matches;
    const labels = labelBulan(isMobile);

    const tickMoney = (v) =>
        'Rp ' + (v >= 1e6 ? (v / 1e6).toFixed(1) + 'jt' : (v / 1e3).toFixed(0) + 'rb');

    const baseDatasets = [
        {
            label: @json($donasiPage->chart_lbl_pemasukan),
            data: grafikDonasi.map(d => d.pemasukan),
            backgroundColor: 'rgba(16,185,129,.85)',
            borderRadius: 6,
            yAxisID: 'y',
        },
        {
            label: @json($donasiPage->chart_lbl_pengeluaran),
            data: grafikDonasi.map(d => d.pengeluaran),
            backgroundColor: 'rgba(239,68,68,.85)',
            borderRadius: 6,
            yAxisID: 'y',
        },
        {
            label: @json($donasiPage->chart_lbl_sisa),
            data: grafikDonasi.map(d => d.sisa_saldo),
            type: 'line',
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,.12)',
            fill: true,
            tension: 0.3,
            pointRadius: isMobile ? 3 : 4,
            borderWidth: isMobile ? 2 : 2,
            yAxisID: isMobile ? 'y' : 'y1',
        },
    ];

    const scalesMobile = {
        y: {
            type: 'linear',
            position: 'left',
            grid: { color: '#f1f5f9' },
            ticks: {
                callback: tickMoney,
                font: { size: 9 },
                maxTicksLimit: 5,
            },
        },
        x: {
            grid: { display: false },
            ticks: {
                font: { size: 9 },
                maxRotation: 0,
                minRotation: 0,
                autoSkip: true,
                maxTicksLimit: 7,
            },
        },
    };

    const scalesDesktop = {
        y: {
            type: 'linear',
            position: 'left',
            grid: { color: '#f1f5f9' },
            ticks: {
                callback: tickMoney,
                font: { size: 10 },
            },
        },
        y1: {
            type: 'linear',
            position: 'right',
            grid: { drawOnChartArea: false },
            ticks: {
                callback: tickMoney,
                font: { size: 10 },
            },
        },
        x: {
            grid: { display: false },
            ticks: { font: { size: 11 }, maxRotation: 40 },
        },
    };

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: baseDatasets,
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    position: isMobile ? 'bottom' : 'top',
                    align: 'center',
                    labels: {
                        boxWidth: isMobile ? 10 : 12,
                        padding: isMobile ? 10 : 12,
                        font: { size: isMobile ? 10 : 11 },
                        usePointStyle: isMobile,
                    },
                },
                tooltip: {
                    callbacks: {
                        label(c) {
                            return c.dataset.label + ': Rp ' + c.raw.toLocaleString('id-ID');
                        },
                    },
                },
            },
            scales: isMobile ? scalesMobile : scalesDesktop,
        },
    });
})();
</script>
@endpush

@endsection
