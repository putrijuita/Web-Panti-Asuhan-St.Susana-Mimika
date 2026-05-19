<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('pageTitle', $loginPage->page_title ?? 'Panel Admin — Panti Asuhan Santa Susana')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Literata:ital,opsz,wght@0,7..72,500;0,7..72,600;0,7..72,700;1,7..72,500&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @php
        $heroBgUrl = \App\Models\AdminLoginPageContent::heroBackgroundUrl($loginPage);
    @endphp
    <style>
        :root {
            --forest: #142e1f;
            --forest-mid: #1a3324;
            --forest-light: #234d36;
            --sky: #0ea5e9;
            --sky-soft: #e0f2fe;
            --sky-glow: rgba(14, 165, 233, 0.35);
            --cream: #faf8f5;
            --ink: #0f172a;
            --muted: #64748b;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
            --danger-text: #991b1b;
            --success-bg: #ecfdf5;
            --success-border: #a7f3d0;
            --success-text: #065f46;
            --radius-lg: 20px;
            --radius-md: 12px;
            --shadow-card: 0 4px 6px -1px rgba(15, 23, 42, 0.06), 0 20px 50px -12px rgba(15, 23, 42, 0.18);
            --font-serif: 'Literata', Georgia, 'Times New Roman', serif;
            --font-sans: 'Source Sans 3', system-ui, sans-serif;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { -webkit-font-smoothing: antialiased; }
        body {
            font-family: var(--font-sans);
            min-height: 100dvh;
            color: var(--ink);
            background: var(--cream);
        }
        .login-layout {
            display: grid;
            min-height: 100dvh;
            grid-template-columns: 1fr;
        }
        @media (min-width: 900px) {
            .login-layout {
                grid-template-columns: minmax(320px, 44%) 1fr;
            }
        }
        .login-hero {
            position: relative;
            min-height: 220px;
            padding: clamp(1.75rem, 4vw, 3rem);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
            color: #fff;
            background:
                radial-gradient(120% 80% at 20% 0%, rgba(14, 165, 233, 0.22) 0%, transparent 55%),
                radial-gradient(90% 60% at 100% 100%, rgba(34, 197, 94, 0.18) 0%, transparent 50%),
                linear-gradient(165deg, var(--forest) 0%, var(--forest-mid) 45%, var(--forest-light) 100%);
        }
        @media (min-width: 900px) {
            .login-hero {
                min-height: 100dvh;
                justify-content: center;
            }
        }
        .login-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.34;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            mix-blend-mode: overlay;
            pointer-events: none;
        }
        @if ($heroBgUrl)
        .login-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ $heroBgUrl }}');
            background-size: cover;
            background-position: center;
            opacity: 0.2;
            mix-blend-mode: luminosity;
            pointer-events: none;
        }
        @endif
        .login-hero-inner {
            position: relative;
            z-index: 1;
            max-width: 26rem;
        }
        .login-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
            backdrop-filter: blur(8px);
        }
        .login-hero-badge i { opacity: 0.9; font-size: 0.72rem; }
        .login-hero h1 {
            font-family: var(--font-serif);
            font-size: clamp(1.65rem, 3.5vw, 2.35rem);
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 0.75rem;
            text-shadow: 0 2px 24px rgba(0, 0, 0, 0.25);
        }
        .login-hero h1 em {
            font-style: italic;
            font-weight: 500;
            opacity: 0.92;
        }
        .login-hero p {
            font-size: 1.02rem;
            line-height: 1.55;
            opacity: 0.9;
            max-width: 22ch;
        }
        .login-hero-deco {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        .login-hero-deco.d1 {
            width: min(55vw, 320px);
            height: min(55vw, 320px);
            top: -12%;
            right: -8%;
            background: radial-gradient(circle, var(--sky-glow) 0%, transparent 70%);
            filter: blur(2px);
        }
        .login-hero-deco.d2 {
            width: 180px;
            height: 180px;
            bottom: 10%;
            left: -4%;
            border: 1px solid rgba(255, 255, 255, 0.08);
            opacity: 0.5;
        }
        .login-main {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(1.5rem, 4vw, 3rem);
            position: relative;
        }
        .login-main::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(14, 165, 233, 0.08) 0%, transparent 55%),
                radial-gradient(ellipse 60% 40% at 100% 80%, rgba(26, 51, 36, 0.04) 0%, transparent 45%);
            pointer-events: none;
        }
        .login-card {
            position: relative;
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }
        .login-card-top {
            padding: 1.75rem 1.75rem 0;
        }
        .login-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--sky-soft) 0%, #f0f9ff 100%);
            color: var(--sky);
            font-size: 1.2rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(14, 165, 233, 0.2);
        }
        .login-card-top h2 {
            font-family: var(--font-serif);
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 0.35rem;
        }
        .login-card-top .sub {
            font-size: 0.95rem;
            color: var(--muted);
        }
        .login-body { padding: 1.5rem 1.75rem 1.75rem; }
        .alert {
            padding: 0.8rem 1rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            line-height: 1.45;
        }
        .alert i { margin-top: 0.15rem; flex-shrink: 0; }
        .alert-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
            border: 1px solid var(--danger-border);
        }
        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid var(--success-border);
        }
        .form-group { margin-bottom: 1.1rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.4rem;
            font-size: 0.88rem;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap > i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.95rem;
            pointer-events: none;
        }
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="text"] {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.65rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-family: inherit;
            background: #fafbfc;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .form-group input::placeholder { color: #94a3b8; }
        .form-group input:hover { border-color: #cbd5e1; }
        .form-group input:focus {
            outline: none;
            border-color: var(--sky);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
        }
        .form-group input.input-readonly,
        .form-group input.input-readonly:disabled {
            background: #f1f5f9;
            color: var(--muted);
            cursor: not-allowed;
            opacity: 1;
            -webkit-text-fill-color: var(--muted);
        }
        .form-group input.input-readonly:focus {
            border-color: #e2e8f0;
            box-shadow: none;
            background: #f1f5f9;
        }
        .email-locked {
            margin-bottom: 1.1rem;
        }
        .email-locked label {
            display: block;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.4rem;
            font-size: 0.88rem;
        }
        .email-locked-value {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.85rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-md);
            background: #f1f5f9;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.4;
            word-break: break-word;
        }
        .email-locked-value i {
            color: #94a3b8;
            flex-shrink: 0;
        }
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--muted);
            user-select: none;
        }
        .remember input {
            width: 1.05rem;
            height: 1.05rem;
            accent-color: var(--sky);
            cursor: pointer;
        }
        .btn-login {
            width: 100%;
            padding: 0.92rem 1rem;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            color: #fff;
            border: none;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.35);
            transition: transform 0.15s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .btn-login:hover {
            filter: brightness(1.05);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.42);
        }
        .btn-login:active { transform: scale(0.99); }
        .login-footer {
            text-align: center;
            padding: 1rem 1.75rem 1.35rem;
            border-top: 1px solid #f1f5f9;
            background: linear-gradient(180deg, #fafbfc 0%, #fff 100%);
        }
        .login-footer a {
            color: var(--forest-mid);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: color 0.2s;
        }
        .login-footer a:hover { color: var(--sky); }
        .auth-text-link {
            color: var(--sky);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.88rem;
            transition: color 0.2s;
        }
        .auth-text-link:hover { color: #0284c7; text-decoration: underline; }
        .form-hint {
            font-size: 0.88rem;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 1.25rem;
        }
        @media (prefers-reduced-motion: reduce) {
            .btn-login { transition: none; }
        }
    </style>
</head>
<body>
    <div class="login-layout">
        <aside class="login-hero">
            <span class="login-hero-deco d1"></span>
            <span class="login-hero-deco d2"></span>
            <div class="login-hero-inner">
                <div class="login-hero-badge">
                    <i class="{{ $loginPage->hero_badge_icon ?? 'fas fa-shield-halved' }}"></i>
                    {{ $loginPage->hero_badge_text }}
                </div>
                <h1>{{ $loginPage->hero_title_prefix }} <em>{{ $loginPage->hero_title_emphasis }}</em></h1>
                <p>{{ $loginPage->hero_description }}</p>
            </div>
        </aside>
        <main class="login-main">
            <div class="login-card">
                <div class="login-card-top">
                    <div class="login-card-icon" aria-hidden="true">
                        <i class="fas @yield('cardIcon', 'fa-right-to-bracket')"></i>
                    </div>
                    <h2>@yield('cardTitle', $loginPage->form_title)</h2>
                    <p class="sub">@yield('cardSubtitle', $loginPage->form_subtitle)</p>
                </div>
                <div class="login-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="status">
                            <i class="fas fa-circle-check"></i>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-circle-exclamation"></i>
                            <span>{{ implode(' ', $errors->all()) }}</span>
                        </div>
                    @endif
                    @yield('content')
                </div>
                <div class="login-footer">
                    @hasSection('footer')
                        @yield('footer')
                    @else
                        <a href="{{ config('admin.main_site_url', url('/')) }}">
                            <i class="fas fa-arrow-left"></i>
                            {{ $loginPage->footer_link_text }}
                        </a>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
