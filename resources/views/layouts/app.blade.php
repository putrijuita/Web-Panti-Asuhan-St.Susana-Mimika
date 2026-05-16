<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panti Asuhan Santa Susana Timika')</title>
    @php
        $faviconHref = \App\Models\SiteContent::siteLogoUrl(data_get($siteContent ?? null, 'site_logo'));
        $bodyBgUrl = \App\Models\SiteContent::bodyBackgroundUrl();
    @endphp
    @if(filled($faviconHref))
        <link rel="icon" href="{{ $faviconHref }}">
        <link rel="apple-touch-icon" href="{{ $faviconHref }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,400;0,7..72,600;0,7..72,700;1,7..72,400&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            /* Tema: biru langit (sky) + aksen hijau lapangan via --aksen-zaitun */
            --latar: #f0f9ff;
            --latar-panel: #e0f2fe;
            --aksen: #0ea5e9;
            --aksen-hover: #0284c7;
            --aksen-muda: #7dd3fc;
            --aksen-zaitun: #3d7a52;
            --aksen-gelap: #0c4a6e;
            --putih: #ffffff;
            --teks: #0f172a;
            --teks-muted: #475569;
            --border: #bae6fd;
            --abu-terang: #e0f2fe;
            --abu-gelap: #334155;
            --teks-gelap: #0c4a6e;
            /* Nama legacy — sekarang nuansa biru langit */
            --biru-muda: #7dd3fc;
            --biru-muda-gelap: #0369a1;
            --biru-tua: #0ea5e9;
            --biru-gelap: #0c4a6e;
            /* Footer hijau lapangan */
            --footer-bg-top: #2f5a40;
            --footer-bg-mid: #234a32;
            --footer-bg-bottom: #152e1f;
            --footer-heading: #b8e6c8;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Source Sans 3', system-ui, sans-serif;
            min-height: 100vh;
            color: var(--teks);
            background-color: var(--latar);
            @if(filled($bodyBgUrl))
            background-image: url('{{ $bodyBgUrl }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            @endif
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(240, 249, 255, 0.9);
            pointer-events: none;
            z-index: 0;
        }
        body > * { position: relative; z-index: 1; }

        h1, h2, h3, .font-display {
            font-family: 'Literata', Georgia, serif;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            height: 68px;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 1.05rem;
            font-weight: 700;
            font-family: 'Literata', Georgia, serif;
            color: var(--aksen-gelap);
            text-decoration: none;
        }
        .logo .brand-mark-fallback { color: var(--aksen); display: inline-flex; align-items: center; }
        .logo .brand-mark-img { flex-shrink: 0; }
        .nav-links {
            display: flex;
            gap: 0.2rem;
            align-items: center;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--abu-gelap);
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }
        .nav-links a:hover,
        .nav-links a.active {
            color: var(--aksen);
            background: rgba(14, 165, 233, 0.1);
        }
        .nav-links a.nav-cta {
            background: var(--aksen);
            color: #fff !important;
            padding: 0.5rem 1.15rem;
        }
        .nav-links a.nav-cta:hover {
            background: var(--aksen-hover);
            color: #fff !important;
        }
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 0.5rem;
        }
        .nav-hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--aksen-gelap);
            border-radius: 2px;
        }

        /* ===== MAIN ===== */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: calc(100vh - 68px - 320px);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 0 0 12px 12px;
            box-shadow: 0 1px 0 rgba(8, 47, 73, 0.06);
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(135deg, var(--biru-gelap) 0%, var(--biru-muda-gelap) 55%, #0ea5e9 100%);
            color: #fff;
            padding: 3rem 2rem;
            text-align: center;
            margin: -2rem -2rem 2.5rem -2rem;
            border-radius: 0;
        }
        .page-header h1 {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 0.65rem;
        }
        .page-header p {
            font-size: 1.05rem;
            opacity: 0.92;
            max-width: 560px;
            margin: 0 auto;
            font-family: 'Source Sans 3', sans-serif;
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.88rem;
            opacity: 0.85;
        }
        .breadcrumb a {
            color: #fff;
            text-decoration: none;
        }
        .breadcrumb a:hover { text-decoration: underline; }

        /* ===== COMPONENTS ===== */
        .btn {
            display: inline-block;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            font-family: inherit;
        }
        .btn-primary {
            background: var(--aksen);
            color: #fff;
        }
        .btn-primary:hover {
            background: var(--aksen-hover);
            color: #fff;
        }
        .btn-outline {
            background: transparent;
            border: 2px solid var(--aksen);
            color: var(--aksen);
        }
        .btn-outline:hover {
            background: var(--aksen);
            color: #fff;
        }
        .btn-white {
            background: #fff;
            color: var(--aksen);
            border: 1px solid var(--border);
        }
        .btn-white:hover {
            background: var(--latar-panel);
            color: var(--aksen-gelap);
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            border: 1px solid var(--border);
            box-shadow: 0 2px 12px rgba(8, 47, 73, 0.06);
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.45rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--teks);
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
            color: var(--teks);
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--aksen);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .alert-success { background: #e8f5e9; color: #1b5e20; border: 1px solid #c8e6c9; }
        .alert-error   { background: #ffebee; color: #b71c1c; border: 1px solid #ffcdd2; }
        .error-msg { color: #c62828; font-size: 0.85rem; margin-top: 0.35rem; display: block; }

        /* ===== FOOTER ===== */
        .site-footer {
            background: linear-gradient(165deg, var(--footer-bg-top) 0%, var(--footer-bg-mid) 42%, var(--footer-bg-bottom) 100%);
            color: #fff;
            margin-top: 4rem;
            padding: 3.5rem 2rem 2rem;
            border-top: 1px solid rgba(184, 230, 200, 0.2);
        }
        .footer-container { max-width: 1200px; margin: 0 auto; }
        .footer-top {
            display: grid;
            grid-template-columns: 1.4fr repeat(3, 1fr);
            gap: 2.5rem;
            margin-bottom: 2.5rem;
        }
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1rem;
        }
        .footer-logo .brand-mark-fallback { color: rgba(255,255,255,0.95); display: inline-flex; }
        .footer-logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .footer-brand-name {
            font-weight: 700;
            font-size: 1rem;
            font-family: 'Literata', Georgia, serif;
            color: #fff;
        }
        .footer-brand-desc {
            font-size: 0.9rem;
            line-height: 1.65;
            opacity: 0.85;
            margin-bottom: 1.25rem;
        }
        .footer-sosmed {
            display: flex;
            gap: 0.5rem;
        }
        .footer-sosmed a {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: background 0.2s;
        }
        .footer-sosmed a:hover {
            background: rgba(255,255,255,0.2);
        }
        .footer-col h4 {
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1.1rem;
            color: var(--footer-heading);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.55rem; }
        .footer-col ul li a {
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .footer-col ul li a:hover { color: #fff; }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.9rem;
        }
        .footer-contact-icon {
            width: 32px;
            height: 32px;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .footer-contact-text { font-size: 0.86rem; line-height: 1.5; opacity: 0.85; }
        .footer-contact-text a { color: #fff; text-decoration: none; }
        .footer-contact-text a:hover { text-decoration: underline; }
        .footer-divider { border: none; border-top: 1px solid rgba(255,255,255,0.12); margin: 1.75rem 0 1.25rem; }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.82rem;
            opacity: 0.78;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        @media (max-width: 900px) {
            .footer-top { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 640px) {
            .nav-links { display: none; }
            .nav-links.open {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 68px;
                left: 0;
                right: 0;
                background: #fff;
                padding: 1.25rem;
                border-bottom: 1px solid var(--border);
                gap: 0.15rem;
                z-index: 999;
            }
            .nav-hamburger { display: flex; }
            .footer-top { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
            main { border-radius: 0; padding: 1.25rem; }
            .page-header { margin: -1.25rem -1.25rem 1.5rem -1.25rem; padding: 2rem 1.25rem; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                @include('partials.brand-mark', ['variant' => 'nav'])
                <span>{{ $siteContent->nav_brand_suffix }}</span>
            </a>
            <div class="nav-links" id="navLinks">
                @php($headerNavItems = \App\Models\SiteContent::headerNavResolvedForPublic($siteContent))
                @foreach($headerNavItems as $navItem)
                    <a href="{{ $navItem['url'] }}" class="{{ \App\Models\SiteContent::headerNavItemIsActive($navItem['route'] ?? null) ? 'active' : '' }} {{ ($navItem['style'] ?? 'link') === 'cta' ? 'nav-cta' : '' }}"
                        @if(!empty($navItem['external'])) target="_blank" rel="noopener noreferrer" @endif
                    >{{ $navItem['label'] }}</a>
                @endforeach
            </div>
            <div class="nav-hamburger" onclick="document.getElementById('navLinks').classList.toggle('open')">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="site-footer">
        @php($footerResolved = \App\Models\SiteContent::footerNavResolvedForPublic($siteContent))
        <div class="footer-container">
            <div class="footer-top">
                <div>
                    <div class="footer-logo">
                        @include('partials.brand-mark', ['variant' => 'footer'])
                        <div>
                            <div class="footer-brand-name">{{ $siteContent->footer_brand_name }}</div>
                        </div>
                    </div>
                    <p class="footer-brand-desc">
                        {{ $siteContent->footer_brand_desc }}
                    </p>
                    <div class="footer-sosmed">
                        @foreach($footerResolved['social'] ?? [] as $soc)
                            <a href="{{ $soc['url'] }}"
                                @if(!empty($soc['external'])) target="_blank" rel="noopener noreferrer" @endif
                                title="{{ $soc['title'] }}"><i class="{{ $soc['icon'] }}"></i></a>
                        @endforeach
                    </div>
                </div>
                <div class="footer-col">
                    <h4>{{ $siteContent->footer_heading_menu }}</h4>
                    <ul>
                        @foreach(($footerResolved['menu'] ?? []) as $link)
                        <li><a href="{{ $link['url'] }}"
                                @if(!empty($link['external'])) target="_blank" rel="noopener noreferrer" @endif
                                ><i class="{{ $link['icon'] }}"></i> {{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>{{ $siteContent->footer_heading_kegiatan }}</h4>
                    <ul>
                        @foreach(($footerResolved['kegiatan'] ?? []) as $link)
                        <li><a href="{{ $link['url'] }}"
                                @if(!empty($link['external'])) target="_blank" rel="noopener noreferrer" @endif
                                ><i class="{{ $link['icon'] }}"></i> {{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>{{ $siteContent->footer_heading_kontak }}</h4>
                    @foreach(($footerResolved['contact'] ?? []) as $block)
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="{{ $block['icon'] }}"></i></div>
                        <div class="footer-contact-text">
                            @if(($block['kind'] ?? '') === 'plain')
                                {{ $block['body'] ?? '' }}
                            @else
                                <a href="{{ $block['url'] }}" @if(!empty($block['external'])) target="_blank" rel="noopener noreferrer" @endif>{{ $block['label'] ?? '' }}</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} {{ $siteContent->footer_copyright_left }}</span>
                <span>{{ $siteContent->footer_copyright_right }}</span>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
