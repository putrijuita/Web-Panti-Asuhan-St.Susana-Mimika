@extends('layouts.app')

@section('title', 'Beranda - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
    /* ── Pembuka: sambutan resmi (pertama kali dibuka) ── */
    .home-hero {
        position: relative;
        text-align: center;
        padding: 3rem 1.5rem 3.25rem;
        margin-bottom: 0.5rem;
        border-radius: 24px;
        border: 1px solid var(--border);
        background: linear-gradient(165deg, #ffffff 0%, #f0f9ff 50%, #e0f2fe 100%);
        box-shadow:
            0 12px 40px rgba(8, 47, 73, 0.09),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        overflow: hidden;
    }
    .home-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 80% 60% at 50% -20%, rgba(14, 165, 233, 0.12), transparent 55%),
            radial-gradient(circle at 100% 100%, rgba(56, 189, 248, 0.08), transparent 45%);
        pointer-events: none;
    }
    .home-hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--biru-muda-gelap), var(--biru-tua), var(--biru-muda));
    }
    .home-hero-inner {
        position: relative;
        z-index: 1;
        max-width: 720px;
        margin: 0 auto;
    }
    .home-hero-kicker {
        display: inline-block;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--biru-muda-gelap);
        margin-bottom: 1rem;
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        background: rgba(14, 165, 233, 0.12);
        border: 1px solid rgba(14, 165, 233, 0.2);
    }
    .home-hero h1 {
        font-size: clamp(1.65rem, 4.2vw, 2.65rem);
        font-weight: 800;
        color: var(--biru-gelap);
        line-height: 1.2;
        margin: 0 0 1rem 0;
        animation: fadeInUp 0.75s ease 0.05s both;
    }
    .home-hero-desc {
        font-size: 1.05rem;
        color: var(--teks-muted);
        line-height: 1.75;
        margin: 0 auto 1.75rem;
        max-width: 34rem;
        animation: fadeInUp 0.75s ease 0.15s both;
    }
    .home-hero-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 0.75s ease 0.25s both;
    }
    .home-hero-actions .btn {
        padding: 0.7rem 1.35rem;
        font-size: 0.92rem;
    }
    .home-hero-actions .btn i {
        margin-right: 0.4rem;
        opacity: 0.95;
    }

    .home-section {
        padding: 2.75rem 0;
    }
    .home-section:first-of-type {
        padding-top: 2.25rem;
    }

    /* ── Tentang (kotak profil) ── */
    #tentang .tentang-box {
        background: linear-gradient(165deg, #ffffff 0%, #f0f9ff 45%, #e0f2fe 100%);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 1.75rem 1.5rem 2rem;
        box-shadow:
            0 8px 32px rgba(8, 47, 73, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.85);
        position: relative;
        overflow: hidden;
    }
    #tentang .tentang-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--biru-muda-gelap), var(--biru-tua), var(--biru-muda));
        opacity: 0.95;
    }
    #tentang .tentang-box-header {
        text-align: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1.35rem;
        border-bottom: 1px solid var(--border);
    }
    #tentang .tentang-box-header h2 {
        font-size: clamp(1.75rem, 3.8vw, 2.35rem);
        font-weight: 800;
        color: var(--biru-gelap);
        margin: 0 0 0.5rem 0;
        line-height: 1.2;
    }
    #tentang .tentang-box-subtitle {
        margin: 0 auto;
        max-width: 36rem;
        font-size: 1.02rem;
        line-height: 1.55;
        color: var(--teks-muted);
        font-weight: 500;
    }
    #tentang .about-content p {
        font-size: 1.08rem;
        line-height: 1.82;
    }
    #tentang .about-content strong {
        font-size: 1.06em;
        color: var(--biru-gelap);
    }
    #tentang .about-visual .about-visual-caption h3 {
        font-size: 1.5rem;
    }
    #tentang .about-visual .about-visual-caption p {
        font-size: 1rem;
    }

    .about-card {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        align-items: center;
    }
    #tentang .tentang-box .about-card {
        margin: 0;
        padding: 0;
        background: transparent;
        border: none;
        box-shadow: none;
    }
    .about-visual {
        background: linear-gradient(135deg, var(--biru-muda) 0%, var(--biru-tua) 100%);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        min-height: 280px;
        border: 1px solid rgba(14, 165, 233, 0.2);
        box-shadow: 0 10px 36px rgba(8, 47, 73, 0.12);
    }
    .about-visual .about-photo {
        width: 100%;
        height: 100%;
        min-height: 280px;
        object-fit: cover;
        display: block;
    }
    .about-visual .about-visual-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem 1.5rem 1.25rem;
        background: linear-gradient(to top, rgba(8, 47, 73, 0.88), transparent);
        color: white;
        text-align: center;
    }
    .about-visual .about-image {
        width: 100%;
        min-height: 280px;
        height: 100%;
        object-fit: cover;
        border-radius: 0;
        box-shadow: none;
        margin-bottom: 0;
        display: block;
    }
    .about-visual .about-visual-caption h3,
    .about-visual h3 {
        font-size: 1.4rem;
        margin: 0 0 0.25rem 0;
        font-weight: 700;
    }
    .about-visual .about-visual-caption p {
        margin: 0;
        font-size: 0.95rem;
        opacity: 0.95;
    }
    .about-content p {
        color: var(--teks-muted);
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    #tentang .tentang-about-more {
        margin-top: 1.35rem;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
        text-align: left;
    }
    #tentang .tentang-about-more p {
        font-size: 0.98rem;
        line-height: 1.65;
        color: var(--teks-muted);
        margin-bottom: 1rem;
    }
    #tentang .tentang-about-more p:last-of-type {
        margin-bottom: 0;
    }
    #tentang .tentang-about-more .btn-tentang-lengkap {
        margin-top: 0.35rem;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
    }

    /* ── Kontak beranda ── */
    #kontak .kontak-home-title {
        text-align: center;
        margin-bottom: 0.25rem;
    }
    #kontak .kontak-home-title h2 {
        font-size: clamp(1.65rem, 3.5vw, 2.1rem);
        color: var(--biru-gelap);
        margin-bottom: 0.4rem;
    }
    #kontak .kontak-home-title p {
        color: var(--teks-muted);
        font-size: 1.02rem;
        margin-bottom: 1.75rem;
        max-width: 36rem;
        margin-left: auto;
        margin-right: auto;
    }
    #kontak .kontak-home-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        padding: 1.75rem;
        border-radius: 20px;
        border: 1px solid var(--border);
        background: linear-gradient(180deg, #ffffff 0%, #f0f9ff 100%);
        box-shadow: 0 8px 28px rgba(8, 47, 73, 0.07);
    }
    #kontak .kontak-home-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    #kontak .kontak-home-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: linear-gradient(135deg, var(--biru-muda-gelap), var(--biru-tua));
        box-shadow: 0 4px 14px rgba(14, 165, 233, 0.25);
    }
    #kontak .kontak-home-item h4 {
        margin: 0 0 0.35rem 0;
        font-size: 0.95rem;
        color: var(--biru-gelap);
    }
    #kontak .kontak-home-item a {
        color: var(--biru-tua);
        text-decoration: none;
        font-weight: 600;
    }
    #kontak .kontak-home-item a:hover {
        text-decoration: underline;
    }
    #kontak .kontak-home-item .kontak-home-muted {
        font-size: 0.88rem;
        color: var(--teks-muted);
        margin: 0.2rem 0 0 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (min-width: 640px) {
        .home-hero {
            padding: 3.5rem 2rem 3.75rem;
        }
        #tentang .tentang-box {
            padding: 2.25rem 2rem 2.5rem;
        }
        #tentang .tentang-box-subtitle {
            font-size: 1.08rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Sambutan resmi -->
<section class="home-section home-section--hero" aria-label="Sambutan">
    <div class="home-hero">
        <div class="home-hero-inner">
            @if(!empty($tentangContent->hero_kicker))
                <p class="home-hero-kicker">{{ $tentangContent->hero_kicker }}</p>
            @endif
            <h1>{{ $tentangContent->hero_title }}</h1>
            <p class="home-hero-desc">
                {{ $tentangContent->hero_description }}
            </p>
            <div class="home-hero-actions">
                <a href="{{ route('donasi.index') }}" class="btn btn-primary"><i class="fas fa-heart" aria-hidden="true"></i> {{ $siteContent->home_btn_donasi }}</a>
                <a href="{{ route('kunjungan.create') }}" class="btn btn-outline"><i class="fas fa-calendar-check" aria-hidden="true"></i> {{ $siteContent->home_btn_kunjungan }}</a>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Kami (ringkasan) -->
<section class="home-section" id="tentang">
    <div class="tentang-box">
        <header class="tentang-box-header">
            <h2>{{ $siteContent->home_tentang_section_title }}</h2>
            <p class="tentang-box-subtitle">{{ $tentangContent->summary_subtitle }}</p>
        </header>
        <div class="about-card">
            <div class="about-content">
                <p>
                    {{ $tentangContent->summary_paragraph_1 }}
                </p>
                <p>
                    {{ $tentangContent->summary_paragraph_2 }}
                </p>
                <div class="tentang-about-more">
                    <p>
                        {{ $tentangContent->summary_cta_note }}
                    </p>
                    <a href="{{ route('tentang') }}" class="btn btn-outline btn-tentang-lengkap">
                        <span>{{ $siteContent->home_tentang_cta_label }}</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="about-visual">
                <img src="{{ \App\Models\SiteContent::aboutImageUrl($siteContent->home_about_image ?? null) }}" alt="{{ $siteContent->home_about_image_alt }}" class="about-image">
                <div class="about-visual-caption">
                    <h3>{{ $siteContent->home_visual_title }}</h3>
                    <p>{{ $siteContent->home_visual_subtitle }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kontak -->
<section class="home-section" id="kontak">
    <div class="kontak-home-title">
        <h2>{{ $siteContent->home_kontak_title }}</h2>
        <p>{{ $siteContent->home_kontak_intro }}</p>
    </div>
    <div class="kontak-home-grid">
        <div class="kontak-home-item">
            <div class="kontak-home-icon" aria-hidden="true"><i class="fas fa-phone"></i></div>
            <div>
                <h4>{{ $siteContent->home_kontak_phone_heading }}</h4>
                <a href="{{ $siteContent->home_kontak_phone_href }}">{{ $siteContent->home_kontak_phone_display }}</a>
                <p class="kontak-home-muted"><a href="{{ $siteContent->home_kontak_wa_url }}" target="_blank" rel="noopener">{{ $siteContent->home_kontak_wa_text }}</a></p>
            </div>
        </div>
        <div class="kontak-home-item">
            <div class="kontak-home-icon" aria-hidden="true"><i class="fab fa-facebook-f"></i></div>
            <div>
                <h4>{{ $siteContent->home_kontak_fb_heading }}</h4>
                <a href="{{ $siteContent->home_kontak_fb_url }}" target="_blank" rel="noopener">{{ $siteContent->home_kontak_fb_text }}</a>
            </div>
        </div>
        <div class="kontak-home-item">
            <div class="kontak-home-icon" aria-hidden="true"><i class="fab fa-instagram"></i></div>
            <div>
                <h4>{{ $siteContent->home_kontak_ig_heading }}</h4>
                <a href="{{ $siteContent->home_kontak_ig_url }}" target="_blank" rel="noopener">{{ $siteContent->home_kontak_ig_text }}</a>
            </div>
        </div>
        <div class="kontak-home-item">
            <div class="kontak-home-icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></div>
            <div>
                <h4>{{ $siteContent->home_kontak_addr_heading }}</h4>
                <p class="kontak-home-muted" style="margin:0;">{{ $siteContent->home_kontak_addr_text }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
