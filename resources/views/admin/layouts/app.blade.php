<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Panti Asuhan Santa Susana</title>
    @php
        $adminFavicon = \App\Models\SiteContent::siteLogoUrl(data_get(\App\Models\SiteContent::resolved(), 'site_logo'));
        $adminBodyBgUrl = \App\Models\SiteContent::bodyBackgroundUrl();
    @endphp
    @if(filled($adminFavicon))
        <link rel="icon" href="{{ $adminFavicon }}">
        <link rel="apple-touch-icon" href="{{ $adminFavicon }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,500;0,7..72,600;0,7..72,700&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-light: #38bdf8;
            --primary-dark: #0369a1;
            --sidebar-bg: #1a3324;
            --sidebar-border: rgba(255,255,255,0.1);
            --success: #2e7d32;
            --field-accent: #3d7a52;
            --warning: #b45309;
            --danger: #c62828;
            --gray-50: #f0f9ff;
            --gray-100: #e0f2fe;
            --gray-200: #bae6fd;
            --gray-300: #7dd3fc;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #0f172a;
            --gray-900: #0c4a6e;
            --sidebar-w: 260px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        code { word-break: break-word; }
        body {
            font-family: 'Source Sans 3', system-ui, sans-serif;
            color: var(--gray-800);
            display: flex;
            min-height: 100vh;
            min-height: 100dvh;
            overflow-x: clip;
            background-color: #f0f9ff;
            @if(filled($adminBodyBgUrl))
            background-image: url('{{ $adminBodyBgUrl }}');
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
            background: rgba(240, 249, 255, 0.94);
            pointer-events: none;
            z-index: 0;
        }
        body > * { position: relative; z-index: 1; }
        .topbar-title { font-family: 'Literata', Georgia, serif; }
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            position: fixed; top: 0; left: 0; height: 100vh;
            display: flex; flex-direction: column; z-index: 100;
            transition: transform .3s ease; overflow-y: auto;
            border-right: 1px solid var(--sidebar-border);
        }
        .sidebar-brand { padding: 20px 20px 16px; border-bottom: 1px solid var(--sidebar-border); }
        .sidebar-brand .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .sidebar-brand .logo-icon-wrap {
            width: 40px; height: 40px;
            background: rgba(255,255,255,.1);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sidebar .brand-mark-fallback { color: rgba(255,255,255,0.9); display: inline-flex; align-items: center; justify-content: center; }
        .sidebar .brand-mark-img { border-radius: 8px; }
        .sidebar-brand .logo-text { color: #fff; }
        .sidebar-brand .logo-text strong { display: block; font-size: 14px; font-weight: 700; line-height: 1.2; font-family: 'Literata', Georgia, serif; }
        .sidebar-brand .logo-text span { font-size: 11px; opacity: .75; }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-section { margin-bottom: 20px; }
        .nav-section-title { font-size: 10px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.45); padding: 0 8px 8px; }
        .nav-section-desc { font-size: 11px; line-height: 1.45; color: rgba(255,255,255,.38); padding: 0 8px 10px; margin-top: -4px; }
        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px;
            color: rgba(255,255,255,.82); text-decoration: none; font-size: 13.5px; font-weight: 500;
            transition: background .2s, color .2s; margin-bottom: 2px;
        }
        .nav-link:hover { background: rgba(255,255,255,.1); color: #fff; }
        .nav-link.active { background: rgba(255,255,255,.15); color: #fff; font-weight: 600; }
        .nav-link .icon { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid var(--sidebar-border); }
        .user-info { display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 8px; background: rgba(255,255,255,.08); margin-bottom: 8px; transition: background .2s; }
        .user-info:hover { background: rgba(255,255,255,.14); }
        .user-details-link { flex: 1; min-width: 0; text-decoration: none; color: inherit; border-radius: 6px; outline-offset: 2px; }
        .user-details-link:focus-visible { outline: 2px solid rgba(255,255,255,.5); }
        .user-avatar { width: 34px; height: 34px; background: rgba(255,255,255,.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; color: #fff; flex-shrink: 0; overflow: hidden; }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
        button.user-avatar { border: none; padding: 0; font: inherit; cursor: pointer; }
        button.user-avatar:focus-visible { outline: 2px solid rgba(255,255,255,.65); outline-offset: 2px; }
        .user-details { overflow: hidden; }
        .js-admin-avatar-lightbox { transition: transform .15s ease, box-shadow .15s ease; }
        .js-admin-avatar-lightbox:hover { transform: scale(1.04); box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.55); }
        #adminAvatarLightbox {
            display: none; position: fixed; inset: 0; z-index: 10000;
            align-items: center; justify-content: center; padding: 24px;
            background: rgba(15, 23, 42, .88); backdrop-filter: blur(4px);
        }
        #adminAvatarLightbox.show { display: flex; }
        #adminAvatarLightbox .admin-avatar-lightbox-inner {
            position: relative; max-width: min(92vw, 720px); max-height: 88vh;
            display: flex; flex-direction: column; align-items: center; gap: 12px;
        }
        #adminAvatarLightbox img {
            max-width: 100%; max-height: calc(88vh - 56px); width: auto; height: auto;
            object-fit: contain; border-radius: 12px; box-shadow: 0 20px 50px rgba(0,0,0,.45);
        }
        #adminAvatarLightbox .admin-avatar-lightbox-caption {
            color: #e2e8f0; font-size: 15px; font-weight: 600; text-align: center; max-width: 56ch;
        }
        #adminAvatarLightbox .admin-avatar-lightbox-close {
            position: absolute; top: -8px; right: -8px;
            width: 40px; height: 40px; border: none; border-radius: 50%;
            background: rgba(255,255,255,.12); color: #f1f5f9; font-size: 22px; line-height: 1;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            transition: background .2s;
        }
        #adminAvatarLightbox .admin-avatar-lightbox-close:hover { background: rgba(255,255,255,.22); }
        .user-details strong { display: block; font-size: 12.5px; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-details span { font-size: 11px; color: rgba(255,255,255,.55); }
        .btn-logout {
            display: flex; align-items: center; gap: 8px; width: 100%;
            padding: 8px 12px; border-radius: 8px;
            background: rgba(198, 40, 40, 0.2); color: #ffcdd2; border: none;
            font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; transition: all .2s;
        }
        .btn-logout:hover { background: rgba(198, 40, 40, 0.35); color: #fff; }
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; min-height: 100dvh; min-width: 0; }
        .topbar {
            background: #fff; border-bottom: 1px solid var(--gray-200);
            padding: 0 24px; min-height: 60px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
            gap: 12px;
            flex-wrap: wrap;
        }
        .topbar-left { display: flex; align-items: center; gap: 12px; min-width: 0; flex: 1 1 auto; }
        .topbar-title { font-size: 16px; font-weight: 600; color: var(--gray-800); line-height: 1.25; word-break: break-word; }
        .topbar-subtitle { font-size: 12px; color: var(--gray-500); line-height: 1.35; max-width: 56ch; }
        .topbar-meta { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
        .btn-menu-toggle { display: none; background: none; border: none; font-size: 20px; cursor: pointer; color: var(--gray-600); }
        .content { padding: 28px 24px 32px; flex: 1; min-width: 0; }
        .card { background: #fff; border-radius: 10px; border: 1px solid var(--gray-200); overflow: hidden; max-width: 100%; }
        .card-header {
            padding: 18px 22px; border-bottom: 1px solid var(--gray-100);
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 12px 16px;
        }
        .card-header .card-title { flex: 1 1 auto; min-width: min(100%, 10rem); }
        .card-header-actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; justify-content: flex-end; }
        .card-title { font-size: 14px; font-weight: 600; color: var(--gray-800); font-family: 'Literata', Georgia, serif; }
        .card-body { padding: 22px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 200px), 1fr)); gap: 18px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 10px; border: 1px solid var(--gray-200); padding: 22px; display: flex; align-items: center; gap: 16px; }
        .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
        .stat-icon.blue { background: #e0f2fe; color: var(--primary-dark); }
        .stat-icon.green { background: #e8f5e9; color: var(--success); }
        .stat-icon.yellow { background: #fff8e6; color: var(--warning); }
        .stat-icon.red { background: #ffebee; color: var(--danger); }
        .stat-icon.accent { background: #e0f2fe; color: var(--primary-dark); }
        .stat-icon.teal { background: #e6f4ea; color: var(--field-accent); }
        .stat-value { font-size: 24px; font-weight: 700; color: var(--gray-900); line-height: 1; font-family: 'Literata', Georgia, serif; }
        .stat-label { font-size: 12px; color: var(--gray-500); margin-top: 4px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--gray-50); padding: 11px 16px; text-align: left; font-size: 11px; font-weight: 700; color: var(--gray-700); text-transform: uppercase; letter-spacing: .04em; border-bottom: 2px solid var(--gray-200); }
        td { padding: 12px 16px; font-size: 13.5px; border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--gray-50); }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-success { background: #e8f5e9; color: #1b5e20; }
        .badge-warning { background: #fff8e6; color: #92400e; }
        .badge-danger { background: #ffebee; color: #b71c1c; }
        .badge-info { background: #e0f2fe; color: var(--primary-dark); }
        .badge-gray { background: var(--gray-100); color: var(--gray-600); }
        .badge-purple { background: #dbeafe; color: var(--primary-dark); }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; border: none; text-decoration: none; transition: background .2s; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-sm { padding: 4px 10px; font-size: 12px; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 13.5px; display: flex; align-items: flex-start; flex-wrap: wrap; gap: 8px; }
        .alert-success { background: #e8f5e9; color: #1b5e20; border-left: 4px solid var(--success); }
        .alert-danger { background: #ffebee; color: #b71c1c; border-left: 4px solid var(--danger); }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--gray-700); margin-bottom: 6px; }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid var(--gray-300); border-radius: 8px; font-size: 13.5px; color: var(--gray-800); background: #fff; outline: none; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12); }
        .pagination-wrap { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; padding: 12px 20px; border-top: 1px solid var(--gray-100); font-size: 13px; color: var(--gray-500); }
        .filter-bar { display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end; }
        .filter-bar .form-group { margin-bottom: 0; flex: 1; min-width: min(100%, 160px); }
        .filter-bar-actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: flex-end; }
        .admin-pagination { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; justify-content: center; max-width: 100%; }
        /* Form grids — dipakai halaman CMS & beranda */
        .admin-grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .admin-grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; }
        .admin-grid-112 { display: grid; grid-template-columns: 1fr 1fr 2fr; gap: 10px; }
        .admin-grid-112-end { display: grid; grid-template-columns: 1fr 1fr 2fr; gap: 10px; align-items: end; }
        .admin-grid-12 { display: grid; grid-template-columns: 1fr 2fr; gap: 12px; }
        .admin-grid-21 { display: grid; grid-template-columns: 2fr minmax(100px, 140px); gap: 10px; align-items: start; }
        .admin-grid-5-badge { display: grid; grid-template-columns: 1fr 1fr minmax(52px, 88px) 1fr 1fr; gap: 10px; align-items: end; }
        .admin-grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; }
        .admin-form-row-box {
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 12px;
        }
        .admin-grid-icon-text { display: grid; grid-template-columns: 80px 1fr; gap: 10px; }
        .admin-grid-cta-row {
            display: grid;
            grid-template-columns: 1fr minmax(72px, 100px) minmax(88px, 120px);
            gap: 8px;
            align-items: end;
        }
        .admin-grid-prog-head {
            display: grid;
            grid-template-columns: minmax(40px, 48px) 1fr 2fr;
            gap: 10px;
            align-items: center;
        }
        .admin-grid-split-main {
            display: grid;
            grid-template-columns: 1.15fr 2fr;
            gap: 24px;
            align-items: flex-start;
        }
        .admin-mt-8 { margin-top: 8px; }
        .admin-mt-10 { margin-top: 10px; }
        .admin-mb-8 { margin-bottom: 8px; }
        .admin-mb-10 { margin-bottom: 10px; }
        @media (max-width: 900px) {
            .admin-grid-5-badge { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .admin-grid-4 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 640px) {
            .admin-grid-2,
            .admin-grid-3,
            .admin-grid-112,
            .admin-grid-112-end,
            .admin-grid-12,
            .admin-grid-21,
            .admin-grid-5-badge,
            .admin-grid-4,
            .admin-grid-icon-text,
            .admin-grid-cta-row,
            .admin-grid-prog-head { grid-template-columns: 1fr; align-items: stretch; }
        }
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 99; }
        @media (max-width: 768px) {
            .admin-grid-split-main { grid-template-columns: 1fr; }
            .sidebar {
                transform: translateX(-100%);
                width: min(var(--sidebar-w), calc(100vw - 8px));
                max-width: calc(100vw - env(safe-area-inset-left, 0px) - env(safe-area-inset-right, 0px));
                padding-bottom: max(12px, env(safe-area-inset-bottom));
            }
            .sidebar.open { transform: translateX(0); }
            .overlay.show { display: block; }
            .main { margin-left: 0; }
            .btn-menu-toggle { display: flex; align-items: center; justify-content: center; min-width: 44px; min-height: 44px; }
            .content { padding: 14px 12px 28px; }
            .topbar { padding: 10px 14px; row-gap: 6px; }
            .topbar-meta { width: 100%; justify-content: flex-end; margin-top: 2px; }
            .card-header { padding: 14px 16px; align-items: flex-start; }
            .card-body { padding: 16px; }
            th, td { padding: 10px 12px; }
            th { font-size: 10px; }
            td { font-size: 13px; }
            .stat-card { padding: 16px; }
            .stat-value { font-size: 21px; }
            .pagination-wrap { flex-direction: column; align-items: center; text-align: center; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-bar .form-group { min-width: 0; width: 100%; max-width: none !important; }
            .filter-bar-actions { width: 100%; }
            .filter-bar-actions .btn { flex: 1; justify-content: center; min-height: 42px; }
        }
        @media (max-width: 380px) {
            .content { padding: 12px 10px 24px; }
            .topbar-title { font-size: 14px; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <div class="logo-icon-wrap">
                @include('partials.brand-mark', ['variant' => 'compact'])
            </div>
            <div class="logo-text">
                <strong>Admin Panel</strong>
                <span>Santa Susana Timika</span>
            </div>
        </a>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                Dashboard
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-user-circle"></i></span>
                Profil saya
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Navigasi &amp; situs</div>
            <p class="nav-section-desc">Menu atas, footer, hero beranda, blok kontak di beranda</p>
            @if(\Illuminate\Support\Facades\Schema::hasColumn('site_contents', 'header_navigation'))
                <a href="{{ route('admin.header-site.edit') }}" class="nav-link {{ request()->routeIs('admin.header-site.*') ? 'active' : '' }}">
                    <span class="icon"><i class="fas fa-bars"></i></span>
                    Header situs publik
                </a>
            @endif
            <a href="{{ route('admin.beranda.edit') }}" class="nav-link {{ request()->routeIs('admin.beranda.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-compass"></i></span>
                Beranda &amp; footer publik
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Data &amp; aset</div>
            <p class="nav-section-desc">Transaksi, berkas, daftar kegiatan</p>
            <a href="{{ route('admin.donasi.index') }}" class="nav-link {{ request()->routeIs('admin.donasi.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-hand-holding-heart"></i></span>
                Donasi uang
            </a>
            <a href="{{ route('admin.pengelolaan-donasi.index') }}" class="nav-link {{ request()->routeIs('admin.pengelolaan-donasi.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-wallet"></i></span>
                Pengelolaan donasi
            </a>
            <a href="{{ route('admin.jasa.index') }}" class="nav-link {{ request()->routeIs('admin.jasa.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-hands-helping"></i></span>
                Donasi jasa
            </a>
            <a href="{{ route('admin.kunjungan.index') }}" class="nav-link {{ request()->routeIs('admin.kunjungan.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                Permohonan kunjungan
            </a>
            <a href="{{ route('admin.kontak-pesan.index') }}" class="nav-link {{ request()->routeIs('admin.kontak-pesan.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-envelope"></i></span>
                Pesan kontak
            </a>
            <a href="{{ route('admin.kegiatan.index') }}" class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-list-check"></i></span>
                Manajemen kegiatan
            </a>
            <a href="{{ route('admin.anak-asuh.index') }}" class="nav-link {{ request()->routeIs('admin.anak-asuh.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-children"></i></span>
                Data anak asuh
            </a>
            <a href="{{ route('admin.jadwal-anak.index') }}" class="nav-link {{ request()->routeIs('admin.jadwal-anak.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-clock"></i></span>
                Data jadwal kegiatan anak
            </a>
            <a href="{{ route('admin.struktur.index') }}" class="nav-link {{ request()->routeIs('admin.struktur.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-sitemap"></i></span>
                Struktur organisasi
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-images"></i></span>
                Album galeri &amp; kategori
            </a>
            <a href="{{ route('admin.dokumentasi-video.index') }}" class="nav-link {{ request()->routeIs('admin.dokumentasi-video.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-clapperboard"></i></span>
                Dokumentasi video
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">CMS — halaman</div>
            <p class="nav-section-desc">Teks &amp; tampilan per URL halaman</p>
            <a href="{{ route('admin.tentang.edit') }}" class="nav-link {{ request()->routeIs('admin.tentang.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-circle-info"></i></span>
                Halaman /tentang
            </a>
            <a href="{{ route('admin.program-page.edit') }}" class="nav-link {{ request()->routeIs('admin.program-page.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-book-open"></i></span>
                Halaman /program (jadwal anak)
            </a>
            <a href="{{ route('admin.galeri-page.edit') }}" class="nav-link {{ request()->routeIs('admin.galeri-page.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-photo-film"></i></span>
                Halaman /galeri
            </a>
            <a href="{{ route('admin.donasi-page.edit') }}" class="nav-link {{ request()->routeIs('admin.donasi-page.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                Halaman /donasi
            </a>
            <a href="{{ route('admin.kunjungan-page.edit') }}" class="nav-link {{ request()->routeIs('admin.kunjungan-page.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-file-signature"></i></span>
                Halaman /kunjungan
            </a>
            <a href="{{ route('admin.kontak-page.edit') }}" class="nav-link {{ request()->routeIs('admin.kontak-page.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-address-card"></i></span>
                Halaman /kontak
            </a>
            <a href="{{ route('admin.anak-asuh-page.edit') }}" class="nav-link {{ request()->routeIs('admin.anak-asuh-page.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-file-lines"></i></span>
                Halaman /anak-asuh
            </a>
            <a href="{{ route('admin.login-page.edit') }}" class="nav-link {{ request()->routeIs('admin.login-page.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-right-to-bracket"></i></span>
                Halaman login admin
            </a>
        </div>
        @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->isSuperAdmin())
        <div class="nav-section">
            <div class="nav-section-title">Pengaturan</div>
            <a href="{{ route('admin.admins.index') }}" class="nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-users-cog"></i></span>
                Manajemen Admin
            </a>
        </div>
        @endif
        <div class="nav-section">
            <div class="nav-section-title">Link</div>
            <a href="{{ url('/') }}" target="_blank" class="nav-link">
                <span class="icon"><i class="fas fa-external-link-alt"></i></span>
                Lihat Website
            </a>
        </div>
    </nav>
    <div class="sidebar-footer">
        <div class="user-info">
            @if(Auth::guard('admin')->user()?->avatarUrl())
                <button type="button"
                    class="user-avatar js-admin-avatar-lightbox"
                    data-src="{{ Auth::guard('admin')->user()->avatarUrl() }}"
                    data-caption="{{ Auth::guard('admin')->user()->name }}"
                    title="Tampilkan foto lebih besar"
                    aria-label="Tampilkan foto profil lebih besar">
                    <img src="{{ Auth::guard('admin')->user()->avatarUrl() }}" alt="">
                </button>
            @else
                <div class="user-avatar" aria-hidden="true">
                    <i class="fas fa-user"></i>
                </div>
            @endif
            <a href="{{ route('admin.profile.edit') }}" class="user-details-link" title="Profil &amp; pengaturan akun — klik untuk mengubah nama, foto, dan password">
                <div class="user-details">
                    <strong>{{ Auth::guard('admin')->user()?->name ?? 'Administrator' }}</strong>
                    <span>
                        @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->isSuperAdmin())
                            <i class="fas fa-shield-halved" style="font-size:10px;margin-right:2px;opacity:0.85"></i>Super Admin
                        @else
                            Admin
                        @endif
                        <span style="display:block;margin-top:2px;font-size:10px;opacity:0.75">Edit profil</span>
                    </span>
                </div>
            </a>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <button type="button" class="btn-menu-toggle" onclick="toggleSidebar()" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-subtitle">@yield('page-subtitle', 'Panti Asuhan Santa Susana Timika')</div>
            </div>
        </div>
        <div class="topbar-meta">
            <span style="font-size:12px;color:var(--gray-500);">
                <i class="fas fa-clock" style="margin-right:4px;"></i>
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </header>
    <div class="content">
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

<div id="adminAvatarLightbox" role="dialog" aria-modal="true" aria-labelledby="adminAvatarLightboxTitle" hidden>
    <div class="admin-avatar-lightbox-inner">
        <button type="button" class="admin-avatar-lightbox-close" data-admin-avatar-lightbox-close aria-label="Tutup">&times;</button>
        <img src="" alt="" id="adminAvatarLightboxImg">
        <p id="adminAvatarLightboxTitle" class="admin-avatar-lightbox-caption"></p>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('show');
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
}
(function () {
    var lb = document.getElementById('adminAvatarLightbox');
    var img = document.getElementById('adminAvatarLightboxImg');
    var title = document.getElementById('adminAvatarLightboxTitle');
    if (!lb || !img || !title) return;
    function openLightbox(src, caption) {
        img.src = src;
        img.alt = caption ? 'Foto profil ' + caption : 'Foto profil';
        title.textContent = caption || '';
        title.style.display = caption ? 'block' : 'none';
        lb.classList.add('show');
        lb.removeAttribute('hidden');
        lb.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        lb.classList.remove('show');
        lb.setAttribute('hidden', '');
        lb.setAttribute('aria-hidden', 'true');
        img.removeAttribute('src');
        img.alt = '';
        title.textContent = '';
        document.body.style.overflow = '';
    }
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('.js-admin-avatar-lightbox');
        if (!trigger || !trigger.dataset.src) return;
        e.preventDefault();
        openLightbox(trigger.dataset.src, trigger.dataset.caption || '');
    });
    lb.addEventListener('click', function (e) {
        if (e.target === lb || e.target.closest('[data-admin-avatar-lightbox-close]')) {
            closeLightbox();
        }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lb.classList.contains('show')) closeLightbox();
    });
})();
</script>
@stack('scripts')
</body>
</html>
