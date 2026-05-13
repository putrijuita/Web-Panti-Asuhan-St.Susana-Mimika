<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Balasan pesan</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #F1F5F9; font-family: 'Segoe UI', Arial, sans-serif; color: #1E293B; }
  .wrapper { max-width: 600px; margin: 32px auto; padding: 0 16px; }
  .card { background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
  .header { background: linear-gradient(135deg, #0e7490 0%, #0891b2 55%, #22d3ee 100%); padding: 32px 28px; text-align: center; }
  .header .icon { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; display: block; margin-bottom: 10px; opacity: 0.9; color: rgba(255,255,255,0.95); }
  .header h1 { color: #fff; font-size: 22px; font-weight: 800; margin-bottom: 6px; }
  .header p  { color: rgba(255,255,255,0.88); font-size: 14px; }
  .body { padding: 30px 28px; }
  .greeting { font-size: 16px; font-weight: 600; color: #1E293B; margin-bottom: 10px; }
  .intro { font-size: 14px; color: #475569; line-height: 1.7; margin-bottom: 18px; }
  .ref-box { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px 16px; margin-bottom: 20px; font-size: 13px; color: #64748b; line-height: 1.6; }
  .ref-box strong { color: #334155; }
  .balasan-box { background: #ECFEFF; border: 1px solid #A5F3FC; border-radius: 14px; padding: 18px 20px; margin: 20px 0; white-space: pre-wrap; font-size: 14px; color: #0F172A; line-height: 1.7; }
  .footer { background: #F8FAFC; border-top: 1px solid #E2E8F0; padding: 20px 28px; text-align: center; }
  .footer p { font-size: 12px; color: #94A3B8; line-height: 1.7; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <span class="icon">Pesan dari panti</span>
      <h1>Balasan untuk Anda</h1>
      <p>Panti Asuhan Santa Susana Timika</p>
    </div>
    <div class="body">
      <p class="greeting">Halo, {{ $kontakPesan->nama }},</p>
      <p class="intro">
        Terima kasih telah menghubungi kami melalui halaman kontak. Berikut balasan dari tim kami:
      </p>
      <div class="ref-box">
        <strong>Subjek pesan Anda:</strong> {{ $kontakPesan->subjek }}
      </div>
      <div class="balasan-box">{!! nl2br(e($balasan)) !!}</div>
      <p style="font-size:13px;color:#475569;line-height:1.7;">
        Untuk pertanyaan lebih lanjut, Anda dapat membalas email ini atau menghubungi kami melalui
        <a href="https://pantisusana.web.id/kontak" style="color:#0e7490;">halaman kontak</a> di situs kami.
      </p>
    </div>
    <div class="footer">
      <p><strong>Panti Asuhan Santa Susana Timika</strong></p>
      <p>Yayasan Peduli Kasih Mimika · Timika, Kab. Mimika, Papua Tengah</p>
      <p style="margin-top:8px;"><a href="https://pantisusana.web.id" style="color:#0891b2;">pantisusana.web.id</a></p>
    </div>
  </div>
</div>
</body>
</html>
