<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Respon Kunjungan</title>
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
  .respon-box { background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 14px; padding: 18px 20px; margin: 20px 0; white-space: pre-wrap; font-size: 14px; color: #0F172A; line-height: 1.7; }
  .footer { background: #F8FAFC; border-top: 1px solid #E2E8F0; padding: 20px 28px; text-align: center; }
  .footer p { font-size: 12px; color: #94A3B8; line-height: 1.7; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <span class="icon">📬</span>
      <h1>Respon Permohonan Kunjungan</h1>
      <p>Panti Asuhan Santa Susana Timika</p>
    </div>
    <div class="body">
      <p class="greeting">Halo, {{ $kunjungan->nama }} 👋</p>
      <p class="intro">
        Terima kasih telah mengajukan kunjungan ke Panti Asuhan Santa Susana Timika.
        Berikut respon dari tim kami terkait permohonan Anda:
      </p>
      <div class="respon-box">{!! nl2br(e($respon)) !!}</div>
      <p style="font-size:13px;color:#475569;line-height:1.7;">
        Untuk pertanyaan lebih lanjut, Anda dapat menghubungi kami melalui email
        <a href="mailto:pantisusana@gmail.com" style="color:#0F766E;">pantisusana@gmail.com</a>
        atau WhatsApp
        <a href="https://wa.me/6282198595245" style="color:#0F766E;">0821-9859-5245</a>.
      </p>
    </div>
    <div class="footer">
      <p><strong>🏠 Panti Asuhan Santa Susana Timika</strong></p>
      <p>Yayasan Peduli Kasih Mimika · Timika, Kab. Mimika, Papua Tengah</p>
      <p style="margin-top:8px;"><a href="https://pantisusana.web.id" style="color:#059669;">pantisusana.web.id</a></p>
    </div>
  </div>
</div>
</body>
</html>
