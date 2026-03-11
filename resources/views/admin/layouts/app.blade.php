<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Panti Asuhan Santa Susana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --primary-dark: #1e3a8a;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --sidebar-w: 260px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--gray-100); color: var(--gray-800); display: flex; min-height: 100vh; }
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(175deg, var(--primary-dark) 0%, var(--primary) 60%, var(--primary-light) 100%);
            position: fixed; top: 0; left: 0; height: 100vh;
            display: flex; flex-direction: column; z-index: 100;
            transition: transform .3s ease; overflow-y: auto;
        }
        .sidebar-brand { padding: 20px 20px 16px; border-bottom: 1px solid rgba(255,255,255,.12); }
        .sidebar-brand .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .sidebar-brand .logo-icon { width: 40px; height: 40px; background: rgba(255,255,255,.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .sidebar-brand .logo-text { color: #fff; }
        .sidebar-brand .logo-text strong { display: block; font-size: 14px; font-weight: 700; line-height: 1.2; }
        .sidebar-brand .logo-text span { font-size: 11px; opacity: .75; }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-section { margin-bottom: 24px; }
        .nav-section-title { font-size: 10px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.5); padding: 0 8px 8px; }
        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 8px;
            color: rgba(255,255,255,.8); text-decoration: none; font-size: 13.5px; font-weight: 500;
            transition: all .2s; margin-bottom: 2px;
        }
        .nav-link:hover { background: rgba(255,255,255,.12); color: #fff; }
        .nav-link.active { background: rgba(255,255,255,.2); color: #fff; font-weight: 600; }
        .nav-link .icon { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.12); }
        .user-info { display: flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 8px; background: rgba(255,255,255,.1); margin-bottom: 8px; }
        .user-avatar { width: 34px; height: 34px; background: rgba(255,255,255,.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; color: #fff; flex-shrink: 0; }
        .user-details { overflow: hidden; }
        .user-details strong { display: block; font-size: 12.5px; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-details span { font-size: 11px; color: rgba(255,255,255,.6); }
        .btn-logout {
            display: flex; align-items: center; gap: 8px; width: 100%;
            padding: 8px 12px; border-radius: 8px;
            background: rgba(239,68,68,.2); color: #fca5a5; border: none;
            font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; transition: all .2s;
        }
        .btn-logout:hover { background: rgba(239,68,68,.35); color: #fff; }
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar {
            background: #fff; border-bottom: 1px solid var(--gray-200);
            padding: 0 24px; height: 60px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .topbar-title { font-size: 16px; font-weight: 600; color: var(--gray-800); }
        .topbar-subtitle { font-size: 12px; color: var(--gray-500); }
        .btn-menu-toggle { display: none; background: none; border: none; font-size: 20px; cursor: pointer; color: var(--gray-600); }
        .content { padding: 24px; flex: 1; }
        .card { background: #fff; border-radius: 12px; border: 1px solid var(--gray-200); overflow: hidden; }
        .card-header { padding: 16px 20px; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; }
        .card-title { font-size: 14px; font-weight: 600; color: var(--gray-800); }
        .card-body { padding: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 12px; border: 1px solid var(--gray-200); padding: 20px; display: flex; align-items: center; gap: 16px; }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .stat-icon.blue { background: #dbeafe; color: var(--primary); }
        .stat-icon.green { background: #d1fae5; color: var(--success); }
        .stat-icon.yellow { background: #fef3c7; color: var(--warning); }
        .stat-icon.red { background: #fee2e2; color: var(--danger); }
        .stat-icon.purple { background: #ede9fe; color: #7c3aed; }
        .stat-icon.teal { background: #ccfbf1; color: #0d9488; }
        .stat-value { font-size: 24px; font-weight: 700; color: var(--gray-900); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--gray-500); margin-top: 4px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--gray-50); padding: 10px 16px; text-align: left; font-size: 11px; font-weight: 600; color: var(--gray-500); text-transform: uppercase; letter-spacing: .05em; border-bottom: 1px solid var(--gray-200); }
        td { padding: 12px 16px; font-size: 13.5px; border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--gray-50); }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-gray { background: var(--gray-100); color: var(--gray-600); }
        .badge-purple { background: #ede9fe; color: #5b21b6; }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 7px; font-size: 13px; font-weight: 500; cursor: pointer; border: none; text-decoration: none; transition: all .2s; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-sm { padding: 4px 10px; font-size: 12px; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 13.5px; display: flex; align-items: center; gap: 8px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid var(--success); }
        .alert-danger { background: #fee2e2; color: #991b1b; border-left: 4px solid var(--danger); }
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; color: var(--gray-700); margin-bottom: 6px; }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid var(--gray-300); border-radius: 7px; font-size: 13.5px; color: var(--gray-800); background: #fff; outline: none; }
        .form-control:focus { border-color: var(--primary-light); box-shadow: 0 0 0 3px rgba(59,130,246,.12); }
        .pagination-wrap { display: flex; align-items: center; justify-content: space-between; padding: 12px 20px; border-top: 1px solid var(--gray-100); font-size: 13px; color: var(--gray-500); }
        .filter-bar { display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end; }
        .filter-bar .form-group { margin-bottom: 0; flex: 1; min-width: 160px; }
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 99; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .overlay.show { display: block; }
            .main { margin-left: 0; }
            .btn-menu-toggle { display: flex; }
            .content { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <div class="logo-icon">🏠</div>
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
        </div>
        <div class="nav-section">
            <div class="nav-section-title">Manajemen</div>
            <a href="{{ route('admin.donasi.index') }}" class="nav-link {{ request()->routeIs('admin.donasi.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-hand-holding-heart"></i></span>
                Donasi Uang
            </a>
            <a href="{{ route('admin.jasa.index') }}" class="nav-link {{ request()->routeIs('admin.jasa.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-hands-helping"></i></span>
                Donasi Jasa
            </a>
            <a href="{{ route('admin.kunjungan.index') }}" class="nav-link {{ request()->routeIs('admin.kunjungan.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                Kunjungan
            </a>
            <a href="{{ route('admin.kegiatan.index') }}" class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                <span class="icon"><i class="fas fa-list-check"></i></span>
                Manajemen Kegiatan
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
            <div class="user-avatar"><i class="fas fa-user"></i></div>
            <div class="user-details">
                <strong>{{ Auth::guard('admin')->user()?->name ?? 'Administrator' }}</strong>
                <span>
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->isSuperAdmin())
                        <i class="fas fa-crown" style="font-size:10px;margin-right:2px;color:gold"></i>Super Admin
                    @else
                        Admin
                    @endif
                </span>
            </div>
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
            <button class="btn-menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-subtitle">@yield('page-subtitle', 'Panti Asuhan Santa Susana Timika')</div>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
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

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('show');
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
}
</script>
@stack('scripts')
</body>
</html>
