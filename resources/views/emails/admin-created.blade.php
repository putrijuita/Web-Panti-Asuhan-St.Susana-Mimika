<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Akun Admin Baru</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #F1F5F9; font-family: 'Segoe UI', Arial, sans-serif; color: #0F172A; }
  .wrapper { max-width: 600px; margin: 32px auto; padding: 0 16px; }
  .card { background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(15,23,42,0.12); }
  .header { background: linear-gradient(135deg, #0f172a 0%, #1D4ED8 55%, #22C55E 100%); padding: 32px 28px; text-align: center; }
  .header .icon { font-size: 46px; display: block; margin-bottom: 10px; }
  .header h1 { color: #ffffff; font-size: 22px; font-weight: 800; margin-bottom: 6px; }
  .header p  { color: rgba(241,245,249,0.86); font-size: 14px; }
  .body { padding: 26px 28px 24px; }
  .body h2 { font-size: 18px; font-weight: 700; margin-bottom: 10px; color: #0F172A; }
  .body p { font-size: 14px; line-height: 1.7; color: #475569; margin-bottom: 12px; }
  .highlight-box { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 16px 18px; margin: 18px 0; }
  .highlight-box h3 { font-size: 13px; text-transform: uppercase; letter-spacing: .08em; color: #64748B; margin-bottom: 10px; }
  .credentials-table { width: 100%; border-collapse: collapse; }
  .credentials-table td { padding: 7px 6px; font-size: 14px; }
  .credentials-table td:first-child { color: #64748B; font-weight: 600; width: 35%; }
  .credentials-table code { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; font-size: 13px; background: #E5E7EB; padding: 2px 6px; border-radius: 6px; }
  .button-wrapper { text-align: center; margin-top: 18px; margin-bottom: 6px; }
  .btn-primary { display: inline-block; padding: 10px 22px; border-radius: 999px; background: #1D4ED8; color: #ffffff !important; font-size: 14px; font-weight: 600; text-decoration: none; box-shadow: 0 10px 20px rgba(37,99,235,0.25); }
  .btn-primary:hover { background: #1E40AF; }
  .note { font-size: 12px; color: #9CA3AF; margin-top: 4px; text-align: center; }
  .footer { background: #F9FAFB; border-top: 1px solid #E5E7EB; padding: 18px 24px; text-align: center; }
  .footer p { font-size: 12px; color: #9CA3AF; line-height: 1.7; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <span class="icon">🎉</span>
      <h1>Selamat, Akun Admin Dibuat</h1>
      <p>Sistem Panti Asuhan Santa Susana Timika</p>
    </div>

    <div class="body">
      <h2>Halo {{ $admin->name }},</h2>
      <p>
        Selamat! Anda telah ditambahkan sebagai <strong>admin</strong> pada sistem
        manajemen Panti Asuhan Santa Susana Timika.
      </p>
      <p>
        Berikut adalah detail akun dan kredensial sementara Anda. Mohon
        disimpan dengan baik dan segera ganti password setelah berhasil masuk.
      </p>

      <div class="highlight-box">
        <h3>Detail Akun Admin</h3>
        <table class="credentials-table">
          <tr>
            <td>Nama lengkap</td>
            <td><strong>{{ $admin->name }}</strong></td>
          </tr>
          <tr>
            <td>Alamat email</td>
            <td><a href="mailto:{{ $admin->email }}" style="color:#1D4ED8; text-decoration:none;">{{ $admin->email }}</a></td>
          </tr>
          <tr>
            <td>Role</td>
            <td><code>{{ $admin->role }}</code></td>
          </tr>
          <tr>
            <td>Password awal</td>
            <td><code>{{ $plainPassword }}</code></td>
          </tr>
        </table>
      </div>

      <div class="button-wrapper">
        <a href="{{ url('/admin/login') }}" class="btn-primary">Masuk ke Dashboard Admin</a>
        <div class="note">
          Setelah berhasil login, segera ubah password di pengaturan akun untuk keamanan.
        </div>
      </div>

      <p>
        Terima kasih atas kesediaan Anda membantu pengelolaan dan pelayanan di
        Panti Asuhan Santa Susana Timika. Semoga pelayanan Anda menjadi berkat
        bagi banyak anak dan keluarga.
      </p>

      <p>Salam hangat,<br><strong>Yayasan Peduli Kasih Mimika</strong></p>
    </div>

    <div class="footer">
      <p>Email ini dikirim otomatis oleh sistem. Mohon tidak membalas email ini secara langsung.</p>
    </div>
  </div>
</div>
</body>
</html>

