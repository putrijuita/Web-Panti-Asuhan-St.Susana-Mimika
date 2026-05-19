<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset kata sandi admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #faf8f5; font-family: 'Segoe UI', Arial, sans-serif; color: #0f172a; }
  .wrapper { max-width: 600px; margin: 32px auto; padding: 0 16px; }
  .card { background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(15,23,42,0.12); border: 1px solid rgba(15,23,42,0.06); }
  .header { background: linear-gradient(165deg, #142e1f 0%, #1a3324 45%, #234d36 100%); padding: 32px 28px; text-align: center; }
  .header .icon { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; display: block; margin-bottom: 8px; opacity: 0.9; color: rgba(255,255,255,0.85); }
  .header h1 { color: #ffffff; font-size: 22px; font-weight: 800; margin-bottom: 6px; }
  .header p  { color: rgba(241,245,249,0.86); font-size: 14px; }
  .body { padding: 26px 28px 24px; }
  .body p { font-size: 14px; line-height: 1.7; color: #475569; margin-bottom: 12px; }
  .button-wrapper { text-align: center; margin: 22px 0 10px; }
  .btn-primary { display: inline-block; padding: 12px 26px; border-radius: 12px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: #ffffff !important; font-size: 14px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 14px rgba(14, 165, 233, 0.35); }
  .note { font-size: 12px; color: #64748b; margin-top: 8px; line-height: 1.6; }
  .url-fallback { word-break: break-all; font-size: 12px; color: #94a3b8; margin-top: 16px; padding: 12px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0; }
  .footer { background: #fafbfc; border-top: 1px solid #f1f5f9; padding: 18px 24px; text-align: center; }
  .footer p { font-size: 12px; color: #94a3b8; line-height: 1.7; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <span class="icon">Panel admin</span>
      <h1>Reset kata sandi</h1>
      <p>Panti Asuhan Santa Susana Timika</p>
    </div>
    <div class="body">
      <p>Halo <strong>{{ $admin->name }}</strong>,</p>
      <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun admin Anda. Klik tombol di bawah untuk membuat kata sandi baru.</p>
      <div class="button-wrapper">
        <a href="{{ $resetUrl }}" class="btn-primary">Atur ulang kata sandi</a>
      </div>
      <p class="note">Tautan ini berlaku selama <strong>{{ $expireMinutes }} menit</strong>. Jika Anda tidak meminta reset, abaikan email ini.</p>
      <p class="url-fallback">Jika tombol tidak berfungsi, salin tautan ini ke peramban:<br>{{ $resetUrl }}</p>
    </div>
    <div class="footer">
      <p>Email otomatis dari sistem panel admin.<br>Jangan bagikan tautan ini kepada siapa pun.</p>
    </div>
  </div>
</div>
</body>
</html>
