<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Informasi Kunjungan</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #F1F5F9; font-family: 'Segoe UI', Arial, sans-serif; color: #1E293B; }
  .wrapper { max-width: 600px; margin: 32px auto; padding: 0 16px; }
  .card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
  .header { background: linear-gradient(135deg, #065f46 0%, #059669 55%, #22c55e 100%); padding: 32px 28px; text-align: center; }
  .header .icon { font-size: 52px; display: block; margin-bottom: 14px; }
  .header h1 { color: #fff; font-size: 22px; font-weight: 800; margin-bottom: 6px; }
  .header p  { color: rgba(255,255,255,0.85); font-size: 14px; }
  .body { padding: 30px 28px; }
  .greeting { font-size: 16px; font-weight: 600; color: #1E293B; margin-bottom: 10px; }
  .intro { font-size: 14px; color: #475569; line-height: 1.7; margin-bottom: 22px; }
  .status-box { background: #ECFEFF; border: 1px solid #BAE6FD; border-radius: 14px; padding: 16px 18px; margin-bottom: 22px; }
  .status-box-title { font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: #0369A1; margin-bottom: 6px; }
  .status-badge { display: inline-block; padding: 4px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; }
  .status-pending { background: #FEF3C7; color: #92400E; }
  .status-approved { background: #DCFCE7; color: #166534; }
  .status-rejected { background: #FEE2E2; color: #B91C1C; }
  .status-completed { background: #DBEAFE; color: #1D4ED8; }
  .status-text { font-size: 13px; color: #0F172A; margin-top: 8px; line-height: 1.6; }
  .data-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; }
  .data-table tr:nth-child(even) td { background: #F8FAFC; }
  .data-table td { padding: 9px 12px; font-size: 13px; border: 1px solid #E2E8F0; vertical-align: top; }
  .data-table td:first-child { color: #64748B; font-weight: 600; width: 40%; }
  .data-table td:last-child  { color: #0F172A; }
  .footer { background: #F8FAFC; border-top: 1px solid #E2E8F0; padding: 20px 28px; text-align: center; }
  .footer p { font-size: 12px; color: #94A3B8; line-height: 1.7; }
  .footer a { color: #059669; text-decoration: none; font-weight: 600; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">

    <div class="header">
      <span class="icon">📅</span>
      <h1>Informasi Permohonan Kunjungan</h1>
      <p>Panti Asuhan Santa Susana Timika</p>
    </div>

    <div class="body">
      <p class="greeting">Halo, {{ $kunjungan->nama }} 👋</p>
      <p class="intro">
        Terima kasih telah mengajukan kunjungan ke Panti Asuhan Santa Susana Timika.
        Berikut kami sampaikan informasi terbaru terkait permohonan Anda.
      </p>

      @php
        $status = $kunjungan->status ?? 'pending';
        $statusLabel = match($status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'completed' => 'Selesai',
            default => 'Menunggu Konfirmasi',
        };
        $statusClass = match($status) {
            'approved' => 'status-approved',
            'rejected' => 'status-rejected',
            'completed' => 'status-completed',
            default => 'status-pending',
        };
      @endphp

      <div class="status-box">
        <div class="status-box-title">Status Permohonan</div>
        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
        <p class="status-text">
          Permohonan kunjungan Anda saat ini berstatus <strong>{{ $statusLabel }}</strong>.
          Bila diperlukan, tim kami akan menghubungi Anda melalui email atau nomor telepon yang tercantum.
        </p>
      </div>

      <p class="section-label" style="font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#94A3B8;margin-bottom:8px;">
        📋 Data Permohonan
      </p>
      <table class="data-table">
        <tr>
          <td>Nama</td>
          <td>{{ $kunjungan->nama }}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td><a href="mailto:{{ $kunjungan->email }}" style="color:#0F766E;">{{ $kunjungan->email }}</a></td>
        </tr>
        <tr>
          <td>Telepon</td>
          <td>{{ $kunjungan->telepon ?: '-' }}</td>
        </tr>
        <tr>
          <td>Instansi / Organisasi</td>
          <td>{{ $kunjungan->instansi ?: 'Perorangan' }}</td>
        </tr>
        <tr>
          <td>Tanggal Kunjungan</td>
          <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
        </tr>
        <tr>
          <td>Keperluan</td>
          <td>{{ $kunjungan->keperluan }}</td>
        </tr>
        <tr>
          <td>Catatan Tambahan</td>
          <td>{{ $kunjungan->catatan ?: '-' }}</td>
        </tr>
      </table>

      <p style="font-size:13px;color:#475569;line-height:1.7;margin-bottom:12px;">
        Jika jadwal atau jumlah rombongan berubah, mohon informasikan kepada kami agar kunjungan dapat berjalan dengan baik.
      </p>
      <p style="font-size:13px;color:#475569;line-height:1.7;">
        Untuk pertanyaan lebih lanjut, Anda dapat menghubungi kami melalui email
        <a href="mailto:pantisusana@gmail.com">pantisusana@gmail.com</a>
        atau WhatsApp
        <a href="https://wa.me/6282198595245">0821-9859-5245</a>.
      </p>
    </div>

    <div class="footer">
      <p><strong>🏠 Panti Asuhan Santa Susana Timika</strong></p>
      <p>Yayasan Peduli Kasih Mimika · Timika, Kab. Mimika, Papua</p>
      <p style="margin-top:8px;">
        <a href="https://pantisusana.web.id">pantisusana.web.id</a>
      </p>
      <p style="margin-top:10px;font-size:11px;color:#CBD5E1;">
        Email ini dikirim otomatis berdasarkan data permohonan kunjungan di website kami.
      </p>
    </div>

  </div>
</div>
</body>
</html>

