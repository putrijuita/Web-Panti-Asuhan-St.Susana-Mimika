@extends('layouts.app')

@section('title', 'Program - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.program-hero {
    background: linear-gradient(135deg, #0f4c75 0%, var(--biru-tua) 50%, #3eb489 100%);
    border-radius: 24px;
    padding: 4rem 3rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.program-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 25% 75%, rgba(255,255,255,0.07) 0%, transparent 55%),
                radial-gradient(circle at 80% 20%, rgba(62,180,137,0.15) 0%, transparent 50%);
}
.program-hero h1 { font-size: clamp(2rem,5vw,3rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.program-hero p  { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; line-height: 1.7; position: relative; }

.section-label {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(46,134,171,0.1); color: var(--biru-tua);
    padding: 0.35rem 1rem; border-radius: 50px;
    font-size: 0.85rem; font-weight: 600; margin-bottom: 0.75rem;
}
.section-head { font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 0.5rem; }
.section-sub  { color: #64748B; font-size: 1rem; margin-bottom: 2rem; }

.program-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 30px rgba(46,134,171,0.08);
    transition: all 0.4s;
    margin-bottom: 2rem;
    display: grid;
    grid-template-columns: 1fr 2fr;
}
.program-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(46,134,171,0.15); }
.program-card.reverse { direction: rtl; }
.program-card.reverse > * { direction: ltr; }
.program-visual {
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    padding: 3rem 2rem; text-align: center;
    min-height: 280px;
}
.program-icon { font-size: 4.5rem; margin-bottom: 1rem; }
.program-tag {
    display: inline-block;
    background: rgba(255,255,255,0.25);
    color: white;
    padding: 0.3rem 0.9rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.program-content { padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
.program-content h3 { font-size: 1.5rem; color: var(--biru-gelap); margin-bottom: 0.75rem; }
.program-content p  { color: #64748B; line-height: 1.7; margin-bottom: 1rem; }
.program-list { list-style: none; margin-bottom: 1.5rem; }
.program-list li {
    display: flex; align-items: flex-start; gap: 0.6rem;
    margin-bottom: 0.6rem; color: #475569; font-size: 0.95rem;
}
.program-list .dot {
    width: 8px; height: 8px;
    background: var(--biru-tua);
    border-radius: 50%; flex-shrink: 0; margin-top: 7px;
}

.mini-program-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.mini-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
    transition: all 0.3s;
    border-top: 4px solid var(--biru-tua);
}
.mini-card:hover { transform: translateY(-5px); }
.mini-icon { font-size: 2rem; margin-bottom: 1rem; }
.mini-card h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.5rem; }
.mini-card p  { color: #64748B; font-size: 0.9rem; line-height: 1.6; }

.involvement-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.involvement-item {
    background: white;
    border-radius: 16px;
    padding: 2rem 1.5rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(46,134,171,0.06);
}
.involvement-item .step {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
    border-radius: 12px; display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 800; font-size: 1.1rem;
    margin: 0 auto 1rem;
}
.involvement-item h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.involvement-item p  { color: #64748B; font-size: 0.85rem; }

@media (max-width: 700px) {
    .program-card { grid-template-columns: 1fr; }
    .program-card.reverse { direction: ltr; }
    .program-visual { min-height: 180px; padding: 2rem; }
    .program-content { padding: 1.75rem; }
}
</style>
@endpush

@section('content')
<div class="program-hero">
    <h1>Program Kami</h1>
    <p>Berbagai program yang kami jalankan untuk memastikan setiap anak tumbuh sehat, cerdas, berkarakter, dan mandiri</p>
</div>

<!-- Program Utama -->
<div style="margin-bottom: 1rem;">
    <div class="section-label"><i class="fas fa-list-check"></i> Program Unggulan</div>
    <h2 class="section-head">Program Utama Panti</h2>
</div>

<div id="pendidikan" class="program-card">
    <div class="program-visual" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
        <div class="program-icon">📚</div>
        <div class="program-tag">Pendidikan</div>
    </div>
    <div class="program-content">
        <h3>Beasiswa & Pendidikan Formal</h3>
        <p>Kami memastikan setiap anak mendapatkan akses pendidikan formal dari tingkat SD hingga SMA. Bekerjasama dengan sekolah-sekolah di Timika untuk memberikan beasiswa penuh.</p>
        <ul class="program-list">
            <li><span class="dot"></span>Biaya sekolah, seragam, dan buku ditanggung</li>
            <li><span class="dot"></span>Bimbingan belajar setiap hari oleh tutor sukarela</li>
            <li><span class="dot"></span>Fasilitas perpustakaan mini dan komputer</li>
            <li><span class="dot"></span>Dukungan untuk melanjutkan ke perguruan tinggi</li>
        </ul>
        <a href="{{ route('donasi.index') }}" class="btn btn-primary" style="align-self: flex-start;">Dukung Program Ini</a>
    </div>
</div>

<div id="kesehatan" class="program-card reverse">
    <div class="program-visual" style="background: linear-gradient(135deg, #065f46, #10b981);">
        <div class="program-icon">🏥</div>
        <div class="program-tag">Kesehatan</div>
    </div>
    <div class="program-content">
        <h3>Kesehatan & Gizi Anak</h3>
        <p>Memastikan setiap anak mendapatkan asupan gizi yang cukup dan layanan kesehatan yang baik. Bekerjasama dengan tenaga medis untuk pemeriksaan rutin berkala.</p>
        <ul class="program-list">
            <li><span class="dot"></span>3 kali makan bergizi setiap hari</li>
            <li><span class="dot"></span>Pemeriksaan kesehatan rutin setiap bulan</li>
            <li><span class="dot"></span>Imunisasi dan suplemen vitamin</li>
            <li><span class="dot"></span>Konsultasi psikologi dan dukungan mental</li>
        </ul>
        <a href="{{ route('donasi.index') }}" class="btn btn-primary" style="align-self: flex-start;">Dukung Program Ini</a>
    </div>
</div>

<div id="ketrampilan" class="program-card">
    <div class="program-visual" style="background: linear-gradient(135deg, #7c3aed, #a855f7);">
        <div class="program-icon">🛠️</div>
        <div class="program-tag">Keterampilan</div>
    </div>
    <div class="program-content">
        <h3>Pelatihan Keterampilan & Kemandirian</h3>
        <p>Program keterampilan hidup untuk membekali remaja di panti agar mandiri ketika memasuki dunia kerja atau menjadi wirausaha.</p>
        <ul class="program-list">
            <li><span class="dot"></span>Keterampilan memasak dan tata boga</li>
            <li><span class="dot"></span>Menjahit dan kerajinan tangan</li>
            <li><span class="dot"></span>Pelatihan komputer dasar</li>
            <li><span class="dot"></span>Literasi keuangan dan wirausaha</li>
        </ul>
        <a href="{{ route('donasi.index') }}" class="btn btn-primary" style="align-self: flex-start;">Dukung Program Ini</a>
    </div>
</div>

<div id="rohani" class="program-card reverse" style="margin-bottom: 3rem;">
    <div class="program-visual" style="background: linear-gradient(135deg, #92400e, #f59e0b);">
        <div class="program-icon">🙏</div>
        <div class="program-tag">Rohani</div>
    </div>
    <div class="program-content">
        <h3>Pembinaan Rohani & Karakter</h3>
        <p>Membangun pondasi iman dan karakter yang kuat pada setiap anak. Kegiatan rohani dan pembentukan moral dilakukan secara rutin dan menyenangkan.</p>
        <ul class="program-list">
            <li><span class="dot"></span>Ibadah dan doa bersama harian</li>
            <li><span class="dot"></span>Pendalaman Alkitab mingguan</li>
            <li><span class="dot"></span>Retret rohani tahunan</li>
            <li><span class="dot"></span>Pelatihan kepemimpinan berbasis nilai</li>
        </ul>
        <a href="{{ route('donasi.index') }}" class="btn btn-primary" style="align-self: flex-start;">Dukung Program Ini</a>
    </div>
</div>

<!-- Program Tambahan -->
<div style="margin-bottom: 1rem;">
    <div class="section-label"><i class="fas fa-plus-circle"></i> Program Tambahan</div>
    <h2 class="section-head">Kegiatan Lainnya</h2>
    <div class="mini-program-grid">
        <div class="mini-card">
            <div class="mini-icon">⚽</div>
            <h4>Olahraga & Seni</h4>
            <p>Kegiatan olahraga dan seni budaya untuk mengembangkan bakat dan menjaga kesehatan jiwa raga anak.</p>
        </div>
        <div class="mini-card" style="border-color: #10b981;">
            <div class="mini-icon">🌿</div>
            <h4>Pertanian Mini</h4>
            <p>Anak-anak belajar berkebun dan bertanam sayuran untuk kebutuhan pangan sehari-hari di panti.</p>
        </div>
        <div class="mini-card" style="border-color: #f59e0b;">
            <div class="mini-icon">🎤</div>
            <h4>Paduan Suara</h4>
            <p>Kelompok paduan suara yang aktif tampil di berbagai acara gereja dan kegiatan sosial setempat.</p>
        </div>
        <div class="mini-card" style="border-color: #8b5cf6;">
            <div class="mini-icon">📸</div>
            <h4>Dokumentasi & Kreativitas</h4>
            <p>Anak-anak dilatih mendokumentasikan aktivitas dan mengembangkan kreativitas digital.</p>
        </div>
    </div>
</div>

<!-- Cara Terlibat -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-handshake"></i> Terlibat</div>
    <h2 class="section-head">Cara Anda Bisa Terlibat</h2>
    <div class="involvement-grid">
        <div class="involvement-item"><div class="step">1</div><h4>Pilih Program</h4><p>Pilih program yang ingin Anda dukung</p></div>
        <div class="involvement-item"><div class="step">2</div><h4>Donasikan</h4><p>Kirim donasi melalui form donasi kami</p></div>
        <div class="involvement-item"><div class="step">3</div><h4>Kunjungi</h4><p>Ajukan kunjungan dan temui anak-anak</p></div>
        <div class="involvement-item"><div class="step">4</div><h4>Dampak</h4><p>Lihat dampak nyata dari kontribusi Anda</p></div>
    </div>
</div>

<!-- CTA -->
<div style="background: linear-gradient(135deg, #0f4c75, var(--biru-tua)); border-radius: 24px; padding: 3rem 2rem; text-align: center; color: white;">
    <h2 style="font-size: 1.75rem; margin-bottom: 0.75rem;">Mulai Berkontribusi Hari Ini</h2>
    <p style="opacity: 0.9; margin-bottom: 2rem;">Setiap kontribusi, sekecil apapun, sangat berarti bagi anak-anak kami</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('donasi.index') }}" class="btn btn-white">💝 Donasi Sekarang</a>
        <a href="{{ route('kunjungan.create') }}" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4);">🏠 Ajukan Kunjungan</a>
    </div>
</div>
@endsection
