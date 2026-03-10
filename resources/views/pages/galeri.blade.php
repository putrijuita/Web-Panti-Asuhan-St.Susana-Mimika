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
    background: linear-gradient(to top, rgba(0,0,0,0.75), rgba(15,23,42,0.2), transparent);
    transition: opacity 0.25s;
    display: flex;
    align-items: flex-end;
    justify-content: flex-start;
    color: white;
    opacity: 0;
    padding: 1.2rem;
}
.gallery-item:hover .overlay {
    opacity: 1;
}
.gallery-overlay-content {
    max-width: 100%;
}
.gallery-overlay-tag {
    display: inline-block;
    padding: 0.15rem 0.65rem;
    border-radius: 999px;
    background: rgba(59,130,246,0.95);
    font-size: 0.7rem;
    font-weight: 700;
    margin-bottom: 0.4rem;
}
.gallery-overlay-title {
    font-weight: 700;
    font-size: 0.98rem;
    margin: 0 0 0.1rem;
}
.gallery-overlay-desc {
    font-size: 0.78rem;
    opacity: 0.9;
    margin: 0;
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
    @if(isset($categories) && $categories->count())
        @foreach($categories as $category)
            <button
                class="filter-btn"
                onclick="filterGallery('cat-{{ $category->id }}', this)"
            >
                {{ $category->nama }}
            </button>
        @endforeach
    @endif
</div>

@if($items->isNotEmpty())
    <!-- Grid Gallery dari database -->
    <div style="margin-bottom: 1rem;">
        <div class="section-label"><i class="fas fa-th"></i> Album Kegiatan</div>
        <h2 style="font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 2rem;">Foto Kegiatan di Panti</h2>
    </div>

    <div class="gallery-grid" id="albumContainer">
        @foreach($items as $foto)
            <div
                class="gallery-item"
                data-cat="{{ $foto->kategori ? 'cat-'.$foto->kategori->id : 'semua' }}"
            >
                <div class="gallery-thumb">
                    @if($foto->gambar)
                        <img src="{{ asset('storage/'.$foto->gambar) }}" alt="{{ $foto->nama }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        📸
                    @endif
                    <div class="overlay">
                        <div class="gallery-overlay-content">
                            <span class="gallery-overlay-tag">Kegiatan</span>
                            <h4 class="gallery-overlay-title">{{ $foto->nama }}</h4>
                            <p class="gallery-overlay-desc">
                                {{ $foto->keterangan ?: 'Dokumentasi kegiatan di Panti Asuhan Santa Susana.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div style="margin-bottom: 3rem;">
        <div class="section-label"><i class="fas fa-th"></i> Album Kegiatan</div>
        <h2 style="font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 0.75rem;">Belum Ada Foto Galeri</h2>
        <p style="color:#64748B;font-size:0.95rem;">Tim kami akan segera menambahkan foto-foto kegiatan anak-anak di panti.</p>
    </div>
@endif

<!-- Video Section -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-photo-film"></i> Dokumentasi</div>
    <h2 style="font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 2rem;">Dokumentasi Video & Foto</h2>
    @if(isset($videos) && $videos->count())
        <div class="video-grid">
            @foreach($videos as $video)
                @php
                    $fileUrl = asset('storage/'.$video->file_path);
                    $isVideo = \Illuminate\Support\Str::endsWith(strtolower($video->file_path), ['.mp4','.mov','.avi','.mkv','.webm']);
                @endphp
                <div class="video-card">
                    @if($isVideo)
                        <video src="{{ $fileUrl }}"
                               style="width:100%;height:auto;display:block;"
                               controls
                               preload="metadata">
                        </video>
                    @else
                        <img src="{{ $fileUrl }}"
                             alt="{{ $video->nama }}"
                             style="width:100%;height:auto;display:block;object-fit:cover;">
                    @endif
                    <div class="video-info">
                        <h4>{{ $video->nama }}</h4>
                        @if($video->keterangan)
                            <span>{{ $video->keterangan }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p style="color:#64748B;font-size:0.95rem;">
            Belum ada dokumentasi video yang ditambahkan. Nantikan update dokumentasi kegiatan terbaru kami.
        </p>
    @endif
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
        const container = document.getElementById(id);
        if (!container) return;

        container.querySelectorAll('[data-cat]').forEach(item => {
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
