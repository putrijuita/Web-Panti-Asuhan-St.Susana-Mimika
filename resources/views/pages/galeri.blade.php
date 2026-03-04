@extends('layouts.app')

@section('title', 'Galeri - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.galeri-hero {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 100%);
    border-radius: 24px;
    padding: 4rem 3rem;
    color: white;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}
.galeri-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 30% 70%, rgba(135,206,235,0.12) 0%, transparent 55%),
                radial-gradient(circle at 70% 30%, rgba(46,134,171,0.1) 0%, transparent 50%);
}
.galeri-hero h1 { font-size: clamp(2rem,5vw,3rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.galeri-hero p  { font-size: 1.1rem; opacity: 0.85; max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative; }

.filter-bar {
    display: flex; flex-wrap: wrap; gap: 0.6rem;
    justify-content: center;
    margin-bottom: 2.5rem;
}
.filter-btn {
    padding: 0.5rem 1.2rem;
    border-radius: 50px;
    border: 2px solid #E2E8F0;
    background: white;
    color: #64748B;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s;
    font-family: inherit;
}
.filter-btn:hover, .filter-btn.active {
    border-color: var(--biru-tua);
    background: var(--biru-tua);
    color: white;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.gallery-item {
    border-radius: 20px;
    overflow: hidden;
    background: white;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
    transition: all 0.4s;
    cursor: pointer;
    position: relative;
}
.gallery-item:hover { transform: translateY(-6px) scale(1.01); box-shadow: 0 16px 48px rgba(46,134,171,0.18); }
.gallery-thumb {
    width: 100%;
    aspect-ratio: 4/3;
    display: flex; align-items: center; justify-content: center;
    font-size: 5rem;
    position: relative;
    overflow: hidden;
}
.gallery-thumb .overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0);
    transition: background 0.3s;
    display: flex; align-items: center; justify-content: center;
    color: white;
    font-size: 1.5rem;
    opacity: 0;
}
.gallery-item:hover .overlay {
    background: rgba(0,0,0,0.35);
    opacity: 1;
}
.gallery-info { padding: 1.25rem 1.5rem; }
.gallery-info h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.3rem; }
.gallery-info p  { font-size: 0.85rem; color: #64748B; }
.gallery-tag {
    display: inline-block;
    padding: 0.2rem 0.7rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

/* Mosaic Layout */
.gallery-mosaic {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: auto;
    gap: 1.25rem;
    margin-bottom: 3rem;
}
.mosaic-item {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(46,134,171,0.1);
    transition: all 0.4s;
    cursor: pointer;
    position: relative;
}
.mosaic-item:hover { transform: scale(1.02); box-shadow: 0 12px 40px rgba(46,134,171,0.2); z-index: 1; }
.mosaic-item.wide  { grid-column: span 2; }
.mosaic-item.tall  { grid-row: span 2; }
.mosaic-thumb {
    width: 100%; height: 100%;
    min-height: 180px;
    display: flex; align-items: center; justify-content: center;
    font-size: 4rem;
    position: relative;
}
.mosaic-label {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.65));
    color: white;
    padding: 2rem 1.25rem 1.25rem;
    font-weight: 700;
    font-size: 0.9rem;
    transform: translateY(100%);
    transition: transform 0.3s;
}
.mosaic-item:hover .mosaic-label { transform: translateY(0); }

.video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.video-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
    transition: all 0.3s;
}
.video-card:hover { transform: translateY(-4px); }
.video-thumb {
    aspect-ratio: 16/9;
    display: flex; align-items: center; justify-content: center;
    font-size: 3.5rem;
    position: relative;
    cursor: pointer;
}
.play-btn {
    position: absolute;
    width: 60px; height: 60px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--biru-tua);
    font-size: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    transition: transform 0.2s;
}
.video-thumb:hover .play-btn { transform: scale(1.1); }
.video-info { padding: 1.25rem 1.5rem; }
.video-info h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.3rem; }
.video-info span { font-size: 0.85rem; color: #94A3B8; }

@media (max-width: 700px) {
    .gallery-mosaic { grid-template-columns: 1fr 1fr; }
    .mosaic-item.wide  { grid-column: span 2; }
    .mosaic-item.tall  { grid-row: auto; }
}
@media (max-width: 480px) {
    .gallery-mosaic { grid-template-columns: 1fr; }
    .mosaic-item.wide { grid-column: span 1; }
}
</style>
@endpush

@section('content')
<div class="galeri-hero">
    <h1>📸 Galeri Kegiatan</h1>
    <p>Sekilas momen berharga dari kehidupan dan kegiatan anak-anak di Panti Asuhan Santa Susana Timika</p>
</div>

<!-- Filter -->
<div class="filter-bar">
    <button class="filter-btn active" onclick="filterGallery('semua', this)">Semua</button>
    <button class="filter-btn" onclick="filterGallery('kegiatan', this)">Kegiatan Harian</button>
    <button class="filter-btn" onclick="filterGallery('pendidikan', this)">Pendidikan</button>
    <button class="filter-btn" onclick="filterGallery('rohani', this)">Rohani</button>
    <button class="filter-btn" onclick="filterGallery('sosial', this)">Sosial</button>
    <button class="filter-btn" onclick="filterGallery('seni', this)">Seni & Budaya</button>
</div>

<!-- Mosaic Gallery -->
<div style="margin-bottom: 1rem;">
    <div class="section-label"><i class="fas fa-images"></i> Pilihan Foto</div>
    <h2 style="font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 2rem;">Momen Berharga Bersama</h2>
</div>

<div class="gallery-mosaic" id="galleryContainer">
    <div class="mosaic-item wide" data-cat="kegiatan">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #dbeafe, #93c5fd); min-height: 220px;">🏃</div>
        <div class="mosaic-label">Olahraga Pagi Bersama</div>
    </div>
    <div class="mosaic-item tall" data-cat="pendidikan">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #d1fae5, #6ee7b7);">📖</div>
        <div class="mosaic-label">Waktu Belajar Mandiri</div>
    </div>
    <div class="mosaic-item" data-cat="rohani">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #fef3c7, #fcd34d);">🙏</div>
        <div class="mosaic-label">Ibadah & Doa Bersama</div>
    </div>
    <div class="mosaic-item" data-cat="seni">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #ede9fe, #c4b5fd);">🎵</div>
        <div class="mosaic-label">Latihan Paduan Suara</div>
    </div>
    <div class="mosaic-item" data-cat="sosial">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #fee2e2, #fca5a5);">🤝</div>
        <div class="mosaic-label">Kunjungan Donatur</div>
    </div>
    <div class="mosaic-item wide" data-cat="kegiatan">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #e0f2fe, #7dd3fc); min-height: 200px;">🍽️</div>
        <div class="mosaic-label">Makan Bersama yang Penuh Kasih</div>
    </div>
    <div class="mosaic-item" data-cat="pendidikan">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #dcfce7, #86efac);">💻</div>
        <div class="mosaic-label">Pelatihan Komputer</div>
    </div>
    <div class="mosaic-item" data-cat="seni">
        <div class="mosaic-thumb" style="background: linear-gradient(135deg, #fdf2f8, #f0abfc);">🎨</div>
        <div class="mosaic-label">Workshop Seni & Kreasi</div>
    </div>
</div>

<!-- Grid Gallery -->
<div style="margin-bottom: 1rem;">
    <div class="section-label"><i class="fas fa-th"></i> Album Kegiatan</div>
    <h2 style="font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 2rem;">Kegiatan Rutin Kami</h2>
</div>

<div class="gallery-grid" id="albumContainer">
    <div class="gallery-item" data-cat="kegiatan">
        <div class="gallery-thumb" style="background: linear-gradient(135deg, #EFF6FF, #BFDBFE);">
            🌅<div class="overlay"><i class="fas fa-expand"></i></div>
        </div>
        <div class="gallery-info">
            <span class="gallery-tag" style="background:#DBEAFE; color:#1D4ED8;">Kegiatan</span>
            <h4>Aktivitas Pagi</h4>
            <p>Rutinitas pagi yang menyehatkan dan penuh semangat</p>
        </div>
    </div>
    <div class="gallery-item" data-cat="pendidikan">
        <div class="gallery-thumb" style="background: linear-gradient(135deg, #F0FDF4, #BBF7D0);">
            🎒<div class="overlay"><i class="fas fa-expand"></i></div>
        </div>
        <div class="gallery-info">
            <span class="gallery-tag" style="background:#DCFCE7; color:#166534;">Pendidikan</span>
            <h4>Berangkat Sekolah</h4>
            <p>Anak-anak berangkat sekolah penuh semangat</p>
        </div>
    </div>
    <div class="gallery-item" data-cat="rohani">
        <div class="gallery-thumb" style="background: linear-gradient(135deg, #FFFBEB, #FDE68A);">
            ✝️<div class="overlay"><i class="fas fa-expand"></i></div>
        </div>
        <div class="gallery-info">
            <span class="gallery-tag" style="background:#FEF3C7; color:#92400E;">Rohani</span>
            <h4>Misa & Doa Bersama</h4>
            <p>Kegiatan rohani yang membangun iman anak-anak</p>
        </div>
    </div>
    <div class="gallery-item" data-cat="sosial">
        <div class="gallery-thumb" style="background: linear-gradient(135deg, #FFF1F2, #FECDD3);">
            🎁<div class="overlay"><i class="fas fa-expand"></i></div>
        </div>
        <div class="gallery-info">
            <span class="gallery-tag" style="background:#FEE2E2; color:#991B1B;">Sosial</span>
            <h4>Penerimaan Donasi</h4>
            <p>Momen bahagia saat menerima bantuan dari donatur</p>
        </div>
    </div>
    <div class="gallery-item" data-cat="seni">
        <div class="gallery-thumb" style="background: linear-gradient(135deg, #F5F3FF, #DDD6FE);">
            🎭<div class="overlay"><i class="fas fa-expand"></i></div>
        </div>
        <div class="gallery-info">
            <span class="gallery-tag" style="background:#EDE9FE; color:#5B21B6;">Seni</span>
            <h4>Pentas Seni</h4>
            <p>Anak-anak tampil berbakat di pentas seni tahunan</p>
        </div>
    </div>
    <div class="gallery-item" data-cat="kegiatan">
        <div class="gallery-thumb" style="background: linear-gradient(135deg, #E0F2FE, #BAE6FD);">
            🧹<div class="overlay"><i class="fas fa-expand"></i></div>
        </div>
        <div class="gallery-info">
            <span class="gallery-tag" style="background:#E0F2FE; color:#075985;">Kegiatan</span>
            <h4>Kerja Bakti Panti</h4>
            <p>Bersama menjaga kebersihan dan kerapian panti</p>
        </div>
    </div>
</div>

<!-- Video Section -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-video"></i> Video</div>
    <h2 style="font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 2rem;">Dokumentasi Video</h2>
    <div class="video-grid">
        <div class="video-card">
            <div class="video-thumb" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
                🎬<div class="play-btn"><i class="fas fa-play"></i></div>
            </div>
            <div class="video-info">
                <h4>Profil Panti Asuhan Santa Susana</h4>
                <span><i class="fas fa-clock"></i> Dokumentasi Kegiatan</span>
            </div>
        </div>
        <div class="video-card">
            <div class="video-thumb" style="background: linear-gradient(135deg, #065f46, #10b981);">
                📽️<div class="play-btn"><i class="fas fa-play"></i></div>
            </div>
            <div class="video-info">
                <h4>Kisah Inspirasi Anak Panti</h4>
                <span><i class="fas fa-clock"></i> Cerita & Kesaksian</span>
            </div>
        </div>
        <div class="video-card">
            <div class="video-thumb" style="background: linear-gradient(135deg, #7c3aed, #a855f7);">
                🎥<div class="play-btn"><i class="fas fa-play"></i></div>
            </div>
            <div class="video-info">
                <h4>Kegiatan Pentas Seni Tahunan</h4>
                <span><i class="fas fa-clock"></i> Seni & Budaya</span>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div style="background: linear-gradient(135deg, #1a1a2e, #0f3460); border-radius: 24px; padding: 3rem 2rem; text-align: center; color: white;">
    <h2 style="font-size: 1.75rem; margin-bottom: 0.75rem;">Jadilah Bagian dari Cerita Ini</h2>
    <p style="opacity: 0.85; margin-bottom: 2rem;">Kunjungi kami dan ciptakan momen berharga bersama anak-anak</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('kunjungan.create') }}" class="btn btn-white">📸 Kunjungi Kami</a>
        <a href="{{ route('donasi.index') }}" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4);">💝 Donasi</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterGallery(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    ['galleryContainer', 'albumContainer'].forEach(id => {
        document.getElementById(id).querySelectorAll('[data-cat]').forEach(item => {
            if (cat === 'semua' || item.dataset.cat === cat) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
}
</script>
@endpush
