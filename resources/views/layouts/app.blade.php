<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panti Asuhan Santa Susana Timika')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --biru-muda: #87CEEB;
            --biru-muda-gelap: #5BA3C6;
            --biru-tua: #2E86AB;
            --biru-gelap: #1B5B7A;
            --putih: #FFFFFF;
            --abu-terang: #F8FAFC;
            --abu-gelap: #334155;
            --teks-gelap: #1E293B;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(160deg, #E8F6FF 0%, #C8E9F7 40%, #A3D8EF 100%);
            min-height: 100vh;
            color: var(--teks-gelap);
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(16px);
            box-shadow: 0 2px 24px rgba(46,134,171,0.12);
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
            gap: 0.6rem;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--biru-gelap);
            text-decoration: none;
        }
        .logo-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }
        .nav-links {
            display: flex;
            gap: 0.25rem;
            align-items: center;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--abu-gelap);
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 0.85rem;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .nav-links a:hover,
        .nav-links a.active {
            color: var(--biru-tua);
            background: rgba(46,134,171,0.08);
        }
        .nav-links a.nav-cta {
            background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
            color: white !important;
            padding: 0.5rem 1.2rem;
            box-shadow: 0 3px 12px rgba(46,134,171,0.3);
        }
        .nav-links a.nav-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 16px rgba(46,134,171,0.4);
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
            background: var(--biru-gelap);
            border-radius: 2px;
            transition: all 0.3s;
        }

        /* ===== MAIN ===== */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            min-height: calc(100vh - 68px - 320px);
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(135deg, var(--biru-gelap) 0%, var(--biru-tua) 60%, var(--biru-muda-gelap) 100%);
            color: white;
            padding: 3.5rem 2rem;
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 70% 30%, rgba(255,255,255,0.07) 0%, transparent 60%);
            pointer-events: none;
        }
        .page-header h1 {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            margin-bottom: 0.75rem;
            position: relative;
        }
        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 560px;
            margin: 0 auto;
            position: relative;
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            opacity: 0.8;
            position: relative;
        }
        .breadcrumb a {
            color: white;
            text-decoration: none;
        }
        .breadcrumb a:hover { text-decoration: underline; }

        /* ===== COMPONENTS ===== */
        .btn {
            display: inline-block;
            padding: 0.7rem 1.6rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            font-family: inherit;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
            color: white;
            box-shadow: 0 4px 15px rgba(46,134,171,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46,134,171,0.4);
        }
        .btn-outline {
            background: transparent;
            border: 2px solid var(--biru-tua);
            color: var(--biru-tua);
        }
        .btn-outline:hover {
            background: var(--biru-tua);
            color: white;
            transform: translateY(-2px);
        }
        .btn-white {
            background: white;
            color: var(--biru-tua);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 30px rgba(46,134,171,0.08);
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--teks-gelap);
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.2s;
            background: #FAFCFF;
            color: var(--teks-gelap);
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--biru-tua);
            background: white;
            box-shadow: 0 0 0 4px rgba(46,134,171,0.08);
        }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .alert-success { background: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0; }
        .alert-error   { background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA; }
        .error-msg { color: #DC2626; font-size: 0.8rem; margin-top: 0.35rem; display: block; }

        /* ===== FOOTER ===== */
        .site-footer {
            background: linear-gradient(180deg, var(--biru-gelap) 0%, #0a2d3e 100%);
            color: white;
            margin-top: 5rem;
            padding: 4rem 2rem 2rem;
        }
        .footer-container { max-width: 1200px; margin: 0 auto; }
        .footer-top {
            display: grid;
            grid-template-columns: 1.4fr repeat(3, 1fr);
            gap: 2.5rem;
            margin-bottom: 3rem;
        }
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1rem;
        }
        .footer-logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }
        .footer-brand-name {
            font-weight: 700;
            font-size: 1rem;
            color: white;
        }
        .footer-brand-desc {
            font-size: 0.9rem;
            line-height: 1.7;
            opacity: 0.8;
            margin-bottom: 1.5rem;
        }
        .footer-sosmed {
            display: flex;
            gap: 0.6rem;
        }
        .footer-sosmed a {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.12);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.2s;
        }
        .footer-sosmed a:hover {
            background: var(--biru-tua);
            transform: translateY(-2px);
        }
        .footer-col h4 {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--biru-muda);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.65rem; }
        .footer-col ul li a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .footer-col ul li a:hover { color: white; }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1rem;
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
        .footer-contact-text { font-size: 0.88rem; line-height: 1.5; opacity: 0.85; }
        .footer-contact-text a { color: white; text-decoration: none; }
        .footer-contact-text a:hover { text-decoration: underline; }
        .footer-divider { border: none; border-top: 1px solid rgba(255,255,255,0.1); margin: 2rem 0 1.5rem; }
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            opacity: 0.75;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        /* ===== RESPONSIVE ===== */
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
                background: white;
                padding: 1.5rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                gap: 0.25rem;
                z-index: 999;
            }
            .nav-hamburger { display: flex; }
            .footer-top { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">🏠</div>
                Santa Susana Timika
            </a>
            <div class="nav-links" id="navLinks">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
                <a href="{{ route('program') }}" class="{{ request()->routeIs('program') ? 'active' : '' }}">Kegiatan</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a>
                <a href="{{ route('donasi.index') }}" class="{{ request()->routeIs('donasi.*') ? 'active' : '' }} nav-cta">Donasi</a>
                <a href="{{ route('kunjungan.create') }}" class="{{ request()->routeIs('kunjungan.*') ? 'active' : '' }}">Kunjungan</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
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
        <div class="footer-container">
            <div class="footer-top">
                <div>
                    <div class="footer-logo">
                        <div class="footer-logo-icon">🏠</div>
                        <div>
                            <div class="footer-brand-name">Panti Asuhan Santa Susana</div>
                        </div>
                    </div>
                    <p class="footer-brand-desc">
                        Yayasan Peduli Kasih Mimika – Panti Asuhan Santa Susana Timika.
                        Merawat, mendidik, dan memberdayakan anak-anak dengan penuh kasih di Timika, Papua.
                    </p>
                    <div class="footer-sosmed">
                        <a href="https://facebook.com/YayasanPeduliKasihMimika" target="_blank" rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="tel:082198595245" title="Telepon"><i class="fas fa-phone"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right fa-xs"></i> Beranda</a></li>
                        <li><a href="{{ route('tentang') }}"><i class="fas fa-chevron-right fa-xs"></i> Tentang Kami</a></li>
                        <li><a href="{{ route('program') }}"><i class="fas fa-chevron-right fa-xs"></i> Kegiatan</a></li>
                        <li><a href="{{ route('galeri') }}"><i class="fas fa-chevron-right fa-xs"></i> Galeri</a></li>
                        <li><a href="{{ route('donasi.index') }}"><i class="fas fa-chevron-right fa-xs"></i> Donasi</a></li>
                        <li><a href="{{ route('kunjungan.create') }}"><i class="fas fa-chevron-right fa-xs"></i> Kunjungan</a></li>
                        <li><a href="{{ route('kontak') }}"><i class="fas fa-chevron-right fa-xs"></i> Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kegiatan</h4>
                    <ul>
                        <li><a href="{{ route('program') }}"><i class="fas fa-chevron-right fa-xs"></i> Kegiatan Rutin Kami</a></li>
                        <li><a href="{{ route('program.unggulan') }}"><i class="fas fa-chevron-right fa-xs"></i> Program Unggulan</a></li>
                        <li><a href="{{ route('program.lainnya') }}"><i class="fas fa-chevron-right fa-xs"></i> Program Lainnya</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kontak</h4>
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="fas fa-phone fa-sm"></i></div>
                        <div class="footer-contact-text">
                            <a href="tel:082198595245">0821-9859-5245</a>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="fab fa-facebook-f fa-sm"></i></div>
                        <div class="footer-contact-text">
                            <a href="https://facebook.com/YayasanPeduliKasihMimika" target="_blank" rel="noopener noreferrer">Yayasan Peduli Kasih Mimika</a>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="fab fa-instagram fa-sm"></i></div>
                        <div class="footer-contact-text">
                            <a href="https://www.instagram.com/yayasanpedulikasihmimika/" target="_blank" rel="noopener noreferrer">Yayasan Peduli Kasih Mimika Panti Asuhan Santa Susana Timika</a>
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon"><i class="fas fa-location-dot fa-sm"></i></div>
                        <div class="footer-contact-text">Timika, Kab. Mimika, Papua</div>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} Yayasan Peduli Kasih Mimika — Panti Asuhan Santa Susana Timika</span>
                <span>Dibuat dengan ❤️ untuk anak-anak Papua</span>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
