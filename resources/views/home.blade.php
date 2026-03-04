@extends('layouts.app')

@section('title', 'Beranda - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
    .hero {
        position: relative;
        padding: 4rem 2rem;
        text-align: center;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(135,206,235,0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(91,163,198,0.2) 0%, transparent 50%);
        pointer-events: none;
    }
    .hero-content {
        position: relative;
        z-index: 1;
    }
    .hero-badge {
        display: inline-block;
        background: rgba(46,134,171,0.15);
        color: var(--biru-tua);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        animation: fadeInDown 0.8s ease;
    }
    .hero h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        color: var(--biru-gelap);
        line-height: 1.2;
        margin-bottom: 1rem;
        animation: fadeInUp 0.8s ease 0.2s both;
    }
    .hero h1 span {
        background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-desc {
        font-size: 1.2rem;
        color: #64748B;
        max-width: 600px;
        margin: 0 auto 2rem;
        line-height: 1.7;
        animation: fadeInUp 0.8s ease 0.4s both;
    }
    .hero-btns {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 0.8s ease 0.6s both;
    }
    .hero-btns .btn {
        padding: 0.9rem 2rem;
        font-size: 1rem;
    }

    .section {
        padding: 3rem 0;
    }
    .section-title {
        text-align: center;
        margin-bottom: 2rem;
    }
    .section-title h2 {
        font-size: 1.75rem;
        color: var(--biru-gelap);
        margin-bottom: 0.5rem;
    }
    .section-title p {
        color: #64748B;
    }

    .about-card {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        align-items: center;
    }
    .about-visual {
        background: linear-gradient(135deg, var(--biru-muda) 0%, var(--biru-tua) 100%);
        border-radius: 24px;
        padding: 3rem;
        text-align: center;
        color: white;
    }
    .about-visual .icon-wrap {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }
    .about-visual h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .about-content p {
        color: #64748B;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }
    .stat-item {
        text-align: center;
        padding: 1.5rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(46,134,171,0.08);
    }
    .stat-item .number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--biru-tua);
        line-height: 1;
    }
    .stat-item .label {
        font-size: 0.9rem;
        color: #64748B;
        margin-top: 0.25rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        box-shadow: 0 4px 30px rgba(46,134,171,0.1);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--biru-muda), var(--biru-tua));
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }
    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(46,134,171,0.2);
    }
    .feature-card:hover::before {
        transform: scaleX(1);
    }
    .feature-card .icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #E0F4FF, var(--biru-muda));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }
    .feature-card h3 {
        font-size: 1.25rem;
        color: var(--biru-gelap);
        margin-bottom: 0.75rem;
    }
    .feature-card p {
        color: #64748B;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .quote-section {
        background: linear-gradient(135deg, var(--biru-gelap) 0%, var(--biru-tua) 100%);
        border-radius: 24px;
        padding: 3rem;
        text-align: center;
        color: white;
        margin: 3rem 0;
    }
    .quote-section .quote-icon {
        font-size: 3rem;
        opacity: 0.5;
        margin-bottom: 1rem;
    }
    .quote-section blockquote {
        font-size: 1.35rem;
        font-style: italic;
        line-height: 1.7;
        max-width: 700px;
        margin: 0 auto 1rem;
    }
    .quote-section cite {
        font-size: 1rem;
        opacity: 0.9;
    }

    .cta-section {
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 30px rgba(46,134,171,0.1);
    }
    .cta-section h2 {
        font-size: 1.75rem;
        color: var(--biru-gelap);
        margin-bottom: 0.75rem;
    }
    .cta-section p {
        color: #64748B;
        margin-bottom: 2rem;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <span class="hero-badge">💝 Yayasan Peduli Kasih Mimika</span>
        <h1>Berbagi Kasih untuk <span>Masa Depan</span> Mereka</h1>
        <p class="hero-desc">
            Panti Asuhan Santa Susana Timika hadir untuk merawat, mendidik, dan memberdayakan anak-anak dengan penuh kasih. 
            Setiap donasi dan kunjungan Anda membawa harapan bagi mereka.
        </p>
        <div class="hero-btns">
            <a href="{{ route('donasi.index') }}" class="btn btn-primary">Donasi Sekarang</a>
            <a href="{{ route('kunjungan.create') }}" class="btn btn-outline">Ajukan Kunjungan</a>
        </div>
    </div>
</section>

<!-- Tentang Kami -->
<section class="section" id="tentang">
    <div class="section-title">
        <h2>Tentang Kami</h2>
        <p>Mengenal Lebih Dekat Panti Asuhan Santa Susana</p>
    </div>
    <div class="card about-card">
        <div class="about-visual">
            <div class="icon-wrap">🏠</div>
            <h3>Rumah Penuh Kasih</h3>
            <p>Timika, Papua</p>
        </div>
        <div class="about-content">
            <p>
                <strong>Yayasan Peduli Kasih Mimika - Panti Asuhan Santa Susana Timika</strong> adalah 
                lembaga yang berkomitmen memberikan pendidikan, pengasuhan, dan kasih sayang kepada 
                anak-anak yang membutuhkan di wilayah Mimika, Papua.
            </p>
            <p>
                Kami percaya setiap anak berhak untuk bermimpi, belajar, dan tumbuh dalam lingkungan 
                yang penuh perhatian. Dengan dukungan dari donatur dan relawan, kami terus berupaya 
                membuka pintu bagi masa depan yang lebih cerah.
            </p>
        </div>
    </div>
</section>

<!-- Angka yang Berbicara -->
<section class="section">
    <div class="section-title">
        <h2>Dampak Kita Bersama</h2>
        <p>Setiap kontribusi membawa perubahan nyata</p>
    </div>
    <div class="stats-grid">
        <div class="stat-item">
            <div class="number">💝</div>
            <div class="label">Donasi</div>
        </div>
        <div class="stat-item">
            <div class="number">🤝</div>
            <div class="label">Relawan</div>
        </div>
        <div class="stat-item">
            <div class="number">🌟</div>
            <div class="label">Anak Terbantu</div>
        </div>
        <div class="stat-item">
            <div class="number">❤️</div>
            <div class="label">Kasih</div>
        </div>
    </div>
</section>

<!-- Cara Berkontribusi -->
<section class="section">
    <div class="section-title">
        <h2>Cara Berkontribusi</h2>
        <p>Mari bantu kami wujudkan harapan mereka</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="icon">💝</div>
            <h3>Donasi</h3>
            <p>Bantu kebutuhan anak-anak dengan donasi. Setiap rupiah akan digunakan untuk pendidikan, makanan, dan kebutuhan sehari-hari.</p>
            <a href="{{ route('donasi.index') }}" class="btn btn-primary">Donasi Sekarang</a>
        </div>
        <div class="feature-card">
            <div class="icon">🏠</div>
            <h3>Kunjungan</h3>
            <p>Kunjungi panti asuhan, berbagi waktu, atau ajak kegiatan bersama. Kunjungan Anda bisa membawa kebahagiaan bagi mereka.</p>
            <a href="{{ route('kunjungan.create') }}" class="btn btn-outline">Ajukan Kunjungan</a>
        </div>
    </div>
</section>

<!-- Quote -->
<section class="quote-section">
    <div class="quote-icon">"</div>
    <blockquote>
        "Satu tangan yang memberi lebih berharga daripada seribu tangan yang menerima. 
        Bersama kita bisa membangun masa depan yang lebih baik bagi anak-anak."
    </blockquote>
    <cite>— Panti Asuhan Santa Susana Timika</cite>
</section>

<!-- Kontak Section -->
<section class="section" id="kontak">
    <div class="section-title">
        <h2>Hubungi Kami</h2>
        <p>Kami siap melayani Anda</p>
    </div>
    <div class="card" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
        <div style="display: flex; align-items: flex-start; gap: 1rem;">
            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--biru-muda), var(--biru-tua)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fas fa-phone"></i>
            </div>
            <div>
                <h4 style="margin-bottom: 0.25rem;">Telepon / WhatsApp</h4>
                <a href="tel:082198595245" style="color: var(--biru-tua); text-decoration: none; font-weight: 600;">0821-9859-5245</a><br>
                <a href="https://wa.me/6282198595245" target="_blank" rel="noopener" style="color: var(--biru-muda-gelap); font-size: 0.9rem;">Chat WhatsApp</a>
            </div>
        </div>
        <div style="display: flex; align-items: flex-start; gap: 1rem;">
            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--biru-muda), var(--biru-tua)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fab fa-facebook-f"></i>
            </div>
            <div>
                <h4 style="margin-bottom: 0.25rem;">Facebook</h4>
                <a href="https://facebook.com/YayasanPeduliKasihMimika" target="_blank" rel="noopener" style="color: var(--biru-tua); text-decoration: none;">Yayasan Peduli Kasih Mimika</a>
            </div>
        </div>
        <div style="display: flex; align-items: flex-start; gap: 1rem;">
            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--biru-muda), var(--biru-tua)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>
                <h4 style="margin-bottom: 0.25rem;">Alamat</h4>
                <p style="margin: 0; color: #64748B;">Timika, Kabupaten Mimika, Papua</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <h2>Sudah Siap untuk Berbagi?</h2>
    <p>Pilih cara yang paling sesuai dengan Anda</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('donasi.index') }}" class="btn btn-primary">Donasi</a>
        <a href="{{ route('kunjungan.create') }}" class="btn btn-outline">Kunjungan</a>
        <a href="#kontak" class="btn btn-outline">Hubungi Kami</a>
    </div>
</section>
@endsection
