@extends('layouts.app')

@section('title', 'Tentang Kami - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.about-hero {
    background: linear-gradient(135deg, var(--biru-gelap) 0%, var(--biru-tua) 60%, #3BA8D0 100%);
    border-radius: 24px;
    padding: 4rem 3rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.about-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 75% 25%, rgba(255,255,255,0.08) 0%, transparent 60%);
}
.about-hero h1 { font-size: clamp(2rem,5vw,3rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.about-hero p  { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; line-height: 1.7; position: relative; }

.section-label {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(46,134,171,0.1);
    color: var(--biru-tua);
    padding: 0.35rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}
.section-head { font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 0.5rem; }
.section-sub  { color: #64748B; font-size: 1rem; margin-bottom: 2rem; }

.visi-misi-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}
.vm-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 30px rgba(46,134,171,0.08);
    position: relative;
    overflow: hidden;
}
.vm-card::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--biru-tua), var(--biru-muda));
}
.vm-icon {
    width: 60px; height: 60px;
    background: linear-gradient(135deg, #E0F4FF, var(--biru-muda));
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.75rem;
    margin-bottom: 1.25rem;
}
.vm-card h3 { font-size: 1.25rem; color: var(--biru-gelap); margin-bottom: 1rem; }
.vm-card p  { color: #64748B; line-height: 1.7; }

.nilai-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.nilai-item {
    background: white;
    border-radius: 16px;
    padding: 1.75rem 1.25rem;
    text-align: center;
    box-shadow: 0 4px 20px rgba(46,134,171,0.06);
    transition: transform 0.3s;
}
.nilai-item:hover { transform: translateY(-5px); }
.nilai-item .emoji { font-size: 2.5rem; margin-bottom: 0.75rem; }
.nilai-item h4    { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.nilai-item p     { font-size: 0.85rem; color: #64748B; line-height: 1.5; }

.sejarah-timeline {
    position: relative;
    padding-left: 2.5rem;
    margin-bottom: 3rem;
}
.sejarah-timeline::before {
    content: '';
    position: absolute;
    left: 12px; top: 0; bottom: 0;
    width: 2px;
    background: linear-gradient(180deg, var(--biru-tua), var(--biru-muda));
}
.timeline-item {
    position: relative;
    margin-bottom: 2rem;
}
.timeline-dot {
    position: absolute;
    left: -2.05rem;
    top: 6px;
    width: 18px; height: 18px;
    background: var(--biru-tua);
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 0 0 2px var(--biru-tua);
}
.timeline-year {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--biru-tua);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.25rem;
}
.timeline-title { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.timeline-desc  { color: #64748B; font-size: 0.95rem; line-height: 1.6; }

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.team-card {
    background: white;
    border-radius: 20px;
    padding: 2rem 1.5rem;
    text-align: center;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
    border: 1px solid rgba(46,134,171,0.12);
    transition: all 0.3s;
    /* Kotak jelas per pengurus */
    min-height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
}
.team-card:hover { transform: translateY(-6px); box-shadow: 0 12px 36px rgba(46,134,171,0.15); }
.team-avatar {
    width: 80px; height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--biru-muda), var(--biru-tua));
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1rem;
    box-shadow: 0 4px 16px rgba(46,134,171,0.25);
    flex-shrink: 0;
}
.team-card h4   { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.25rem; }
.team-card span { font-size: 0.85rem; color: var(--biru-tua); font-weight: 600; }

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.stat-box {
    background: linear-gradient(135deg, var(--biru-gelap), var(--biru-tua));
    border-radius: 20px;
    padding: 2rem 1rem;
    text-align: center;
    color: white;
}
.stat-box .num  { font-size: 2.5rem; font-weight: 800; line-height: 1; }
.stat-box .desc { font-size: 0.85rem; opacity: 0.85; margin-top: 0.4rem; }

@media (max-width: 640px) {
    .visi-misi-grid { grid-template-columns: 1fr; }
    .about-hero { padding: 2.5rem 1.5rem; }
}
/* Foto pengurus bisa diklik untuk memperbesar */
.team-avatar-btn {
    width: 100%;
    height: 100%;
    border: none;
    padding: 0;
    border-radius: 50%;
    cursor: pointer;
    background: transparent;
    display: block;
}
.team-avatar-btn:hover { opacity: 0.9; }
.team-avatar-btn img { display: block; }
.image-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.85);
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.image-modal.show { display: flex; flex-direction: column; }
.image-modal-close {
    position: absolute;
    top: 16px;
    right: 24px;
    color: #fff;
    font-size: 36px;
    font-weight: 300;
    cursor: pointer;
    line-height: 1;
    z-index: 1;
}
.image-modal-close:hover { opacity: .9; }
.image-modal-content {
    max-width: 90%;
    max-height: 85vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 8px 32px rgba(0,0,0,.4);
}
.image-modal-caption {
    color: #fff;
    text-align: center;
    padding: 12px 0 0;
    font-size: 14px;
}
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="about-hero">
    <h1>Tentang Panti Asuhan Santa Susana</h1>
    <p>Mengenal lebih dekat perjalanan, visi, dan dedikasi kami dalam melayani anak-anak di Timika, Papua Tengah</p>
</div>

<!-- Visi & Misi -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-star"></i> Visi & Misi</div>
    <div class="visi-misi-grid">
        <div class="vm-card">
            <div class="vm-icon">🌟</div>
            <h3>Visi</h3>
            <p>Ada bersama mereka, mendampingi dan membimbing mereka serta membentuk karakter anak asuh agar menjadi pribadi yang menjunjung tinggi nilai-nilai moralitas secara Katolik, memiliki intelektual yang berkualitas dan disiplin yang tinggi serta menjadi pribadi yang takut akan Tuhan dan mengasihi sesama.</p>
        </div>
        <div class="vm-card">
            <div class="vm-icon">🎯</div>
            <h3>Misi</h3>
            <ul style="padding-left: 1.2rem; color: #64748B; line-height: 2;">
                <li>Memberikan kenyamanan dan kedamaian bagi anak asuh.</li>
                <li>Memberi kesempatan kepada anak asuh untuk mengembangkan bakat dan kemampuan secara jasmani maupun rohani.</li>
                <li>Mendidik, membina, mengayomi, memotivasi dan mengarahkan agar menjadi pribadi yang mandiri, menghargai hidup dan menjadi berkat bagi bangsa serta memberikan pengaruh yang positif bagi sesama, hidup menghayati dan menghormati Allah Tritunggal Maha Kudus serta menghormati Bunda Maria sebagai Ibu Kehidupan.</li>
                <li>Membentuk pola hidup kerohanian yang layak dan membentuk karakter hidup bersosial.</li>
                <li>Membina dan menanamkan hidup beriman secara Katolik dan mengamalkannya dalam hidup sehari-hari.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Nilai -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-heart"></i> Nilai Kami</div>
    <h2 class="section-head">Nilai-Nilai yang Kami Junjung</h2>
    <div class="nilai-grid">
        <div class="nilai-item"><div class="emoji">💗</div><h4>Kasih</h4><p>Setiap tindakan dilandasi cinta dan kepedulian tulus</p></div>
        <div class="nilai-item"><div class="emoji">🙏</div><h4>Iman</h4><p>Berpijak pada nilai-nilai rohani dan kepercayaan kepada Tuhan</p></div>
        <div class="nilai-item"><div class="emoji">🤝</div><h4>Kebersamaan</h4><p>Membangun komunitas yang solid dan saling mendukung</p></div>
        <div class="nilai-item"><div class="emoji">📚</div><h4>Pendidikan</h4><p>Pendidikan adalah kunci utama masa depan cerah</p></div>
        <div class="nilai-item"><div class="emoji">💪</div><h4>Kemandirian</h4><p>Membekali anak menjadi pribadi mandiri dan percaya diri</p></div>
        <div class="nilai-item"><div class="emoji">✨</div><h4>Integritas</h4><p>Transparansi dan kejujuran dalam setiap langkah pelayanan</p></div>
    </div>
</div>

<!-- Sejarah -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-clock-rotate-left"></i> Sejarah</div>
    <h2 class="section-head">Perjalanan Kami</h2>
    <p class="section-sub">Dari awal yang sederhana hingga tumbuh menjadi rumah bagi banyak anak</p>
    <div class="card" style="padding: 2.5rem;">
        <div class="sejarah-timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-year">Awal Berdiri</div>
                <div class="timeline-title">Pendirian Yayasan Peduli Kasih Mimika</div>
                <div class="timeline-desc">Didirikan atas dasar kepedulian terhadap anak-anak kurang mampu di wilayah Mimika, Papua Tengah. Bermula dari sekelompok kecil yang bersatu hati.</div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-year">Perkembangan</div>
                <div class="timeline-title">Pembukaan Panti Asuhan Santa Susana</div>
                <div class="timeline-desc">Rumah pengasuhan resmi mulai beroperasi, menerima anak-anak dari berbagai latar belakang untuk mendapat pendidikan dan kasih sayang.</div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-year">Pertumbuhan</div>
                <div class="timeline-title">Perluasan Program & Fasilitas</div>
                <div class="timeline-desc">Program pendidikan, kesehatan, dan keterampilan diperluas. Dukungan donatur dari berbagai penjuru semakin menguat.</div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-year">Kini</div>
                <div class="timeline-title">Melayani dengan Penuh Kasih</div>
                <div class="timeline-desc">Terus bertumbuh dan berbenah, memberikan pelayanan terbaik bagi anak-anak demi masa depan yang lebih cerah.</div>
            </div>
        </div>
    </div>
</div>

<!-- Angka -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-chart-bar"></i> Dampak</div>
    <h2 class="section-head">Dampak yang Kami Ciptakan</h2>
    <div class="stats-row">
        <div class="stat-box"><div class="num">💝</div><div class="desc">Donasi Diterima</div></div>
        <div class="stat-box"><div class="num">🎓</div><div class="desc">Anak Bersekolah</div></div>
        <div class="stat-box"><div class="num">🤝</div><div class="desc">Relawan Aktif</div></div>
        <div class="stat-box"><div class="num">❤️</div><div class="desc">Tahun Melayani</div></div>
    </div>
</div>

<!-- Pengurus -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-users"></i> Pengurus</div>
    <h2 class="section-head">Orang-Orang di Balik Pelayanan</h2>
    <p class="section-sub">Tim pengurus yang berdedikasi dan berkomitmen untuk anak-anak</p>
    <div class="team-grid">
        @forelse($pengurus as $p)
            <div class="team-card">
                <div class="team-avatar">
                    @if($p->gambar_path)
                        @php $imgUrl = asset('storage/'.$p->gambar_path); @endphp
                        <button type="button" class="team-avatar-btn" onclick="openImageModal('{{ $imgUrl }}', '{{ addslashes($p->nama) }} — {{ addslashes($p->jabatan) }}')" title="Klik untuk memperbesar">
                            <img src="{{ $imgUrl }}" alt="{{ $p->nama }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        </button>
                    @else
                        {{ mb_substr($p->nama, 0, 1) }}
                    @endif
                </div>
                <h4>{{ $p->nama }}</h4>
                <span>{{ $p->jabatan }}</span>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align:center; color:#94a3b8; font-size:0.95rem;">
                Data pengurus belum tersedia.
            </div>
        @endforelse
    </div>
</div>

<!-- CTA -->
<div style="background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap)); border-radius: 24px; padding: 3rem 2rem; text-align: center; color: white;">
    <h2 style="font-size: 1.75rem; margin-bottom: 0.75rem;">Ikut Berkontribusi Bersama Kami</h2>
    <p style="opacity: 0.9; margin-bottom: 2rem;">Donasi atau kunjungan Anda adalah bukti nyata kepedulian</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('donasi.index') }}" class="btn btn-white">💝 Donasi Sekarang</a>
        <a href="{{ route('kunjungan.create') }}" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4);">🏠 Ajukan Kunjungan</a>
        <a href="{{ route('kontak') }}" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4);">📞 Hubungi Kami</a>
    </div>
</div>

{{-- Modal foto pengurus timbul saat diklik --}}
<div id="imageModal" class="image-modal" onclick="closeImageModal(event)">
    <span class="image-modal-close" onclick="closeImageModal(event)" title="Tutup">&times;</span>
    <img id="imageModalImg" class="image-modal-content" src="" alt="" onclick="event.stopPropagation()">
    <div id="imageModalCaption" class="image-modal-caption"></div>
</div>
@endsection

@push('scripts')
<script>
function openImageModal(src, caption) {
    var modal = document.getElementById('imageModal');
    var img = document.getElementById('imageModalImg');
    var cap = document.getElementById('imageModalCaption');
    if (modal && img) {
        img.src = src;
        img.alt = caption || '';
        cap.textContent = caption || '';
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}
function closeImageModal(e) {
    var modal = document.getElementById('imageModal');
    if (!modal) return;
    if (e && e.target !== modal && !e.target.classList.contains('image-modal-close')) return;
    modal.classList.remove('show');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeImageModal(e);
});
</script>
@endpush
