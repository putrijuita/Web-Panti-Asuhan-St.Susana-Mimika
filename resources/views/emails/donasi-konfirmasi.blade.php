<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Konfirmasi Donasi</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #F1F5F9; font-family: 'Segoe UI', Arial, sans-serif; color: #1E293B; }
  .wrapper { max-width: 600px; margin: 32px auto; padding: 0 16px; }
  .card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
  .header { background: linear-gradient(135deg, #7f1d1d 0%, #DC2626 55%, #f97316 100%); padding: 40px 32px; text-align: center; }
  .header .icon { font-size: 56px; display: block; margin-bottom: 16px; }
  .header h1 { color: #fff; font-size: 26px; font-weight: 800; margin-bottom: 6px; }
  .header p  { color: rgba(255,255,255,0.85); font-size: 15px; }
  .body { padding: 36px 32px; }
  .greeting { font-size: 17px; font-weight: 600; color: #1E293B; margin-bottom: 12px; }
  .intro { font-size: 15px; color: #475569; line-height: 1.7; margin-bottom: 28px; }
  .receipt { background: #FFF5F5; border: 1.5px solid #FECACA; border-radius: 16px; padding: 24px; margin-bottom: 28px; }
  .receipt h3 { font-size: 13px; font-weight: 700; color: #DC2626; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px; }
  .receipt-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px dashed #FCA5A5; }
  .receipt-row:last-child { border-bottom: none; padding-bottom: 0; }
  .receipt-row .label { font-size: 13px; color: #64748B; }
  .receipt-row .value { font-size: 14px; font-weight: 600; color: #1E293B; text-align: right; max-width: 60%; }
  .receipt-row .value.nominal { font-size: 20px; font-weight: 800; color: #DC2626; }
  .receipt-row .value.badge { background: #DCFCE7; color: #166534; padding: 3px 12px; border-radius: 50px; font-size: 13px; }
  .message-box { background: #FFFBEB; border-left: 4px solid #F59E0B; border-radius: 0 12px 12px 0; padding: 16px 20px; margin-bottom: 28px; }
  .message-box .label { font-size: 12px; color: #92400E; font-weight: 700; text-transform: uppercase; margin-bottom: 6px; }
  .message-box p { font-size: 14px; color: #78350F; line-height: 1.6; font-style: italic; }
  .impact { background: #F0FDF4; border-radius: 14px; padding: 20px 24px; margin-bottom: 28px; }
  .impact h3 { font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 12px; }
  .impact ul { list-style: none; }
  .impact ul li { font-size: 14px; color: #065F46; padding: 5px 0; display: flex; align-items: center; gap: 8px; }
  .quote { background: linear-gradient(135deg, #FFF7ED, #FFEDD5); border-radius: 14px; padding: 20px 24px; text-align: center; margin-bottom: 28px; }
  .quote p { font-size: 15px; color: #92400E; font-style: italic; line-height: 1.7; }
  .quote .author { font-size: 13px; color: #B45309; font-weight: 600; margin-top: 10px; }
  .footer { background: #F8FAFC; border-top: 1px solid #E2E8F0; padding: 24px 32px; text-align: center; }
  .footer p { font-size: 13px; color: #94A3B8; line-height: 1.7; }
  .footer a { color: #DC2626; text-decoration: none; font-weight: 600; }
  .footer .org { font-weight: 700; color: #475569; font-size: 13px; margin-bottom: 6px; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">

    <!-- Header -->
    <div class="header">
      <span class="icon">🎉</span>
      <h1>Donasi Anda Berhasil!</h1>
      <p>Panti Asuhan Santa Susana Timika berterima kasih</p>
    </div>

    <!-- Body -->
    <div class="body">
      <p class="greeting">Halo, {{ $donasi->nama }}! 👋</p>
      <p class="intro">
        Pembayaran donasi Anda telah <strong>berhasil dikonfirmasi</strong> dan dicatat oleh sistem kami.
        Kebaikan hati Anda sangat berarti bagi anak-anak di Panti Asuhan Santa Susana Timika.
      </p>

      <!-- Kwitansi Donasi -->
      <div class="receipt">
        <h3>📄 Rincian Donasi</h3>
        <div class="receipt-row">
          <span class="label">Nomor Order</span>
          <span class="value" style="font-family: monospace; font-size: 13px;">{{ $donasi->order_id }}</span>
        </div>
        <div class="receipt-row">
          <span class="label">Nominal Donasi</span>
          <span class="value nominal">Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</span>
        </div>
        <div class="receipt-row">
          <span class="label">Atas Nama</span>
          <span class="value">{{ $donasi->nama }}</span>
        </div>
        <div class="receipt-row">
          <span class="label">Email</span>
          <span class="value">{{ $donasi->email }}</span>
        </div>
        @if($donasi->telepon)
        <div class="receipt-row">
          <span class="label">Telepon</span>
          <span class="value">{{ $donasi->telepon }}</span>
        </div>
        @endif
        <div class="receipt-row">
          <span class="label">Metode Pembayaran</span>
          <span class="value">QRIS</span>
        </div>
        <div class="receipt-row">
          <span class="label">Tanggal</span>
          <span class="value">{{ $donasi->updated_at->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }} WIT</span>
        </div>
        <div class="receipt-row">
          <span class="label">Status</span>
          <span class="value badge">✅ Lunas</span>
        </div>
      </div>

      @if($donasi->catatan)
      <!-- Pesan Donatur -->
      <div class="message-box">
        <div class="label">💬 Pesan & Doa Anda</div>
        <p>"{{ $donasi->catatan }}"</p>
      </div>
      @endif

      <!-- Dampak Donasi -->
      <div class="impact">
        <h3>💚 Dampak Nyata Donasi Anda</h3>
        <ul>
          @php
            $nominal = (int) $donasi->nominal;
            $items = [];
            if ($nominal >= 50000)   $items[] = ['🍽️', 'Makan bergizi ' . floor($nominal / 50000) . ' anak selama 3 hari'];
            if ($nominal >= 150000)  $items[] = ['📚', 'Paket buku pelajaran untuk ' . floor($nominal / 150000) . ' anak'];
            if ($nominal >= 500000)  $items[] = ['💊', 'Biaya kesehatan ' . floor($nominal / 500000) . ' anak selama sebulan'];
            if ($nominal >= 1000000) $items[] = ['🎒', 'Biaya sekolah + perlengkapan ' . floor($nominal / 1000000) . ' anak'];
            if (empty($items))       $items[] = ['❤️', 'Berkontribusi nyata untuk kehidupan anak-anak'];
          @endphp
          @foreach($items as $item)
          <li><span>{{ $item[0] }}</span> {{ $item[1] }}</li>
          @endforeach
        </ul>
      </div>

      <!-- Quote -->
      <div class="quote">
        <p>"Donasi Anda bukan sekadar angka — ia adalah senyum di pagi hari, buku yang dibuka dengan semangat, dan mimpi yang berani diperjuangkan."</p>
        <div class="author">— Panti Asuhan Santa Susana Timika</div>
      </div>

      <p style="font-size:14px; color:#475569; line-height:1.7;">
        Jika ada pertanyaan, jangan ragu menghubungi kami di
        <a href="mailto:pantisusana@gmail.com" style="color:#DC2626; font-weight:600;">pantisusana@gmail.com</a>
        atau WhatsApp <a href="https://wa.me/6282198595245" style="color:#DC2626; font-weight:600;">0821-9859-5245</a>.
      </p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p class="org">🏠 Panti Asuhan Santa Susana Timika</p>
      <p>Yayasan Peduli Kasih Mimika · Timika, Kab. Mimika, Papua Tengah</p>
      <p style="margin-top:8px;">
        <a href="https://pantisusana.web.id">pantisusana.web.id</a> &nbsp;·&nbsp;
        <a href="https://wa.me/6282198595245">WhatsApp</a>
      </p>
      <p style="margin-top:12px; font-size:12px; color:#CBD5E1;">
        Email ini dikirim otomatis. Harap simpan sebagai bukti donasi Anda.
      </p>
    </div>

  </div>
</div>
</body>
</html>
