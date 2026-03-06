<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Admin — Panti Asuhan Santa Susana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --biru-muda: #87CEEB;
            --biru-tua: #2E86AB;
            --biru-gelap: #1B5B7A;
            --putih: #FFFFFF;
            --teks: #1E293B;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: linear-gradient(160deg, #E8F6FF 0%, #C8E9F7 40%, #A3D8EF 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(27, 91, 122, 0.15);
            max-width: 420px;
            width: 100%;
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, var(--biru-gelap), var(--biru-tua));
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .login-header .icon-wrap {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.2);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .login-header h1 { font-size: 1.35rem; font-weight: 800; margin-bottom: 0.35rem; }
        .login-header p { font-size: 0.9rem; opacity: 0.9; }
        .login-body { padding: 2rem; }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--teks);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--biru-tua);
        }
        .form-group input::placeholder { color: #94A3B8; }
        .form-group .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-group .remember input { width: auto; }
        .btn-login {
            width: 100%;
            padding: 0.95rem;
            background: linear-gradient(135deg, var(--biru-gelap), var(--biru-tua));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(46, 134, 171, 0.4);
        }
        .login-footer {
            text-align: center;
            padding: 1rem 2rem;
            border-top: 1px solid #F1F5F9;
        }
        .login-footer a {
            color: var(--biru-tua);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .login-footer a:hover { text-decoration: underline; }
        .alert-danger {
            background: #FEE2E2;
            color: #991B1B;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="icon-wrap"><i class="fas fa-shield-halved"></i></div>
            <h1>Admin Panti Susana</h1>
            <p>Masuk ke dashboard</p>
        </div>
        <div class="login-body">
            @if ($errors->any())
                <div class="alert-danger">
                    @foreach ($errors->all() as $e) {{ $e }} @endforeach
                </div>
            @endif
            <form method="POST" action="{{ request()->getHost() === config('admin.domain') ? url('/login') : url('admin/login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>
        </div>
        <div class="login-footer">
            <a href="{{ config('admin.main_site_url', url('/')) }}">&larr; Kembali ke situs</a>
        </div>
    </div>
</body>
</html>
