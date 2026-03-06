<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifikasi Donasi Baru</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #F1F5F9; font-family: 'Segoe UI', Arial, sans-serif; color: #1E293B; }
  .wrapper { max-width: 600px; margin: 32px auto; padding: 0 16px; }
  .card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
  .header { background: linear-gradient(135deg, #1e3a5f 0%, #1D4ED8 60%, #0EA5E9 100%); padding: 36px 32px; text-align: center; }
  .header .icon { font-size: 52px; display: block; margin-bottom: 14px; }
  .header h1 { color: #fff; font-size: 24px; font-weight: 800; margin-bottom: 6px; }
  .header p  { color: rgba(255,255,255,0.82); font-size: 14px; }
  .alert-bar { background: #DCFCE7; border-bottom: 2px solid #BBF7D0; padding: 14px 32px; display: flex; align-items: center; gap: 10px; }
  .alert-bar span { font-size: 14px; color: #166534; font-weight: 700; }
  .body { padding: 32px 32px; }
  .section-label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .1em; color: #94A3B8; margin-bottom: 12px; }
  .data-table { width: 100%; border-collapse: collapse; margin-bottom: 28px; }
  .data-table tr:nth-child(even) td { background: #F8FAFC; }
  .data-table td { padding: 11px 16px; font-size: 14px; border: 1px solid #E2E8F0; }
  .data-table td:first-child { color: #64748B; font-weight: 600; width: 38%; }
  .data-table td:last-child  { color: #1E293B; font-weight: 500; }
  .nominal-big { font-size: 28px; font-weight: 900; color: #16A34A; text-align: center; padding: 20px; background: #F0FDF4; border-radius: 14px; margin-bottom: 28px; border: 2px solid #BBF7D0; }
  .nominal-big small { display: block; font-size: 13px; font-weight: 500; color: #4ADE80; margin-bottom: 4px; }
  .message-box { background: #FFFBEB; border-left: 4px solid #F59E0B; border-radius: 0 12px 12px 0; padding: 14px 18px; margin-bottom: 28px; }
  .message-box .label { font-size: 11px; color: #92400E; font-weight: 800; text-transform: uppercase; margin-bottom: 6px; }
  .message-box p { font-size: 14px; color: #78350F; line-height: 1.6; font-style: italic; }
  .footer { background: #F8FAFC; border-top: 1px solid #E2E8F0; padding: 20px 32px; text-align: center; }
  .footer p { font-size: 12px; color: #94A3B8; line-height: 1.7; }
  .badge { display: inline-block; padding: 4px 14px; border-radius: 50px; font-size: 12px; font-weight: 700; }
  .badge-success { background: #DCFCE7; color: #166534; }
  .badge-qris { background: #DBEAFE; color: #1E40AF; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">

    <!-- Header -->
    <div class="header">
      <span class="icon">🔔</span>
      <h1>Donasi Baru Masuk!</h1>
      <p>Sistem Panti Asuhan Santa Susana Timika</p>
    </div>

    <!-- Alert bar -->
    <div class="alert-bar">
      <span>✅ Pembayaran QRIS berhasil dikonfirmasi oleh Midtrans</span>
    </div>

    <div class="body">

      <!-- Nominal besar -->
      <div class="nominal-big">
        <small>Total Donasi Diterima</small>
        Rp {{ number_format($donasi->nominal, 0, ',', '.') }}
      </div>

      <!-- Data donatur -->
      <p class="section-label">📋 Data Donatur</p>
      <table class="data-table">
        <tr>
          <td>Order ID</td>
          <td><code style="font-family:monospace; font-size:13px; background:#F1F5F9; padding:2px 6px; border-radius:4px;">{{ $donasi->order_id }}</code></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td><strong>{{ $donasi->nama }}</strong></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><a href="mailto:{{ $donasi->email }}" style="color:#1D4ED8;">{{ $donasi->email }}</a></td>
        </tr>
        <tr>
          <td>Telepon</td>
          <td>{{ $donasi->telepon ?: '-' }}</td>
        </tr>
        <tr>
          <td>Nominal</td>
          <td><strong style="color:#16A34A; font-size:15px;">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
          <td>Metode Bayar</td>
          <td><span class="badge badge-qris">QRIS</span></td>
        </tr>
        <tr>
          <td>Status</td>
          <td><span class="badge badge-success">✅ Lunas / Completed</span></td>
        </tr>
        <tr>
          <td>Waktu</td>
          <td>{{ $donasi->updated_at->locale('id')->isoFormat('dddd, D MMMM Y · HH:mm') }} WIT</td>
        </tr>
      </table>

      @if($donasi->catatan)
      <!-- Pesan donatur -->
      <div class="message-box">
        <div class="label">💬 Pesan dari Donatur</div>
        <p>"{{ $donasi->catatan }}"</p>
      </div>
      @endif

      <p style="font-size:14px; color:#475569; line-height:1.7;">
        Dana donasi telah tercatat di sistem dan siap digunakan untuk kebutuhan anak-anak.
        Segera catat ke pembukuan panti untuk transparansi laporan.
      </p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p><strong>🏠 Panti Asuhan Santa Susana Timika</strong></p>
      <p>Email notifikasi otomatis · Yayasan Peduli Kasih Mimika</p>
      <p style="margin-top:8px; font-size:11px; color:#CBD5E1;">
        Jangan balas email ini. Untuk bantuan hubungi admin sistem.
      </p>
    </div>

  </div>
</div>
</body>
</html>
