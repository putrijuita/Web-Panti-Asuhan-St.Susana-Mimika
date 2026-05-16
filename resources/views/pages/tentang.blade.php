@extends('layouts.app')

@section('title')
{{ $tentangContent->page_meta_title }}
@endsection

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
    background: rgba(14,165,233,0.1);
    color: var(--biru-tua);
    padding: 0.35rem 1rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}
.section-head { font-size: 1.65rem; font-weight: 800; color: var(--biru-gelap); margin-bottom: 0.5rem; }
.section-sub  { color: var(--teks-muted); font-size: 1rem; margin-bottom: 2rem; }

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
    box-shadow: 0 4px 30px rgba(14,165,233,0.08);
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
.vm-card p  { color: var(--teks-muted); line-height: 1.7; }

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
    box-shadow: 0 4px 20px rgba(14,165,233,0.06);
    transition: transform 0.3s;
}
.nilai-item:hover { transform: translateY(-5px); }
.nilai-item .emoji { font-size: 2.5rem; margin-bottom: 0.75rem; }
.nilai-item h4    { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.nilai-item p     { font-size: 0.85rem; color: var(--teks-muted); line-height: 1.5; }

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
.timeline-desc  { color: var(--teks-muted); font-size: 0.95rem; line-height: 1.6; }

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
    box-shadow: 0 4px 24px rgba(14,165,233,0.08);
    border: 1px solid rgba(14,165,233,0.12);
    transition: all 0.3s;
    /* Kotak jelas per pengurus */
    min-height: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
}
.team-card:hover { transform: translateY(-6px); box-shadow: 0 12px 36px rgba(14,165,233,0.15); }
.team-avatar {
    width: 180px; height: 180px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--biru-muda), var(--biru-tua));
    display: flex; align-items: center; justify-content: center;
    font-size: 3rem;
    margin: 0 auto 1rem;
    box-shadow: 0 4px 16px rgba(14,165,233,0.25);
    flex-shrink: 0;
}
.team-card h4   { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.25rem; }
.team-card span { font-size: 0.85rem; color: var(--biru-tua); font-weight: 600; }

@media (max-width: 640px) {
    .visi-misi-grid { grid-template-columns: 1fr; }
    .about-hero { padding: 2.5rem 1.5rem; }
}

/* Cuplikan menuju halaman publik /anak-asuh */
.tentang-anak-teaser {
    background: #fff;
    border: 1px solid rgba(14,165,233,0.15);
    border-radius: 20px;
    padding: 1.75rem 2rem;
    box-shadow: 0 4px 24px rgba(14,165,233,0.07);
}
.tentang-anak-peek {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    margin-top: 14px;
}
.tentang-anak-peek-av {
    width: 68px;
    height: 68px;
    border-radius: 11px;
    overflow: hidden;
    border: 2px solid rgba(14,165,233,0.25);
    flex-shrink: 0;
    background: var(--latar-panel);
}
.tentang-anak-peek-av img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
@media (max-width: 640px) {
    .tentang-anak-teaser {
        padding: 1.35rem 1.15rem;
        border-radius: 16px;
    }
    .tentang-anak-peek {
        gap: 8px;
        margin-top: 12px;
    }
    .tentang-anak-peek-av {
        width: 64px;
        height: 64px;
        border-radius: 10px;
    }
}
.tentang-anak-teaser-cta {
    margin-top: 1.1rem;
    font-size: 0.95rem;
}
.tentang-anak-teaser-cta a {
    color: var(--biru-tua);
    font-weight: 600;
    text-decoration: none;
}
.tentang-anak-teaser-cta a:hover {
    text-decoration: underline;
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
    z-index: 10050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    min-height: 100dvh;
    background: rgba(0,0,0,.88);
    box-sizing: border-box;
    padding: 0;
}
.image-modal.show {
    display: flex;
    flex-direction: column;
    align-items: stretch;
}
.image-modal-close {
    position: absolute;
    top: max(18px, env(safe-area-inset-top, 0px));
    right: max(20px, env(safe-area-inset-right, 0px));
    color: #fff;
    font-size: 36px;
    font-weight: 300;
    cursor: pointer;
    line-height: 1;
    z-index: 2;
    text-shadow: 0 1px 4px rgba(0,0,0,.5);
}
.image-modal-close:hover { opacity: .9; }
.image-modal-body {
    flex: 1;
    min-height: 0;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: calc(72px + env(safe-area-inset-top, 0px)) clamp(16px, 4vw, 28px) calc(40px + env(safe-area-inset-bottom, 0px));
    box-sizing: border-box;
    pointer-events: none;
}
.image-modal-content {
    max-width: min(92vw, 1100px);
    max-height: calc(100dvh - 200px);
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 10px;
    box-shadow: 0 12px 48px rgba(0,0,0,.45);
    pointer-events: auto;
}
.image-modal-caption {
    color: #fff;
    text-align: center;
    padding: 14px 16px 0;
    font-size: 15px;
    font-weight: 600;
    text-shadow: 0 1px 3px rgba(0,0,0,.6);
    max-width: min(92vw, 560px);
    line-height: 1.4;
    pointer-events: auto;
}
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="about-hero">
    <h1>{{ $tentangContent->tentang_hero_title }}</h1>
    <p>{{ $tentangContent->tentang_hero_description }}</p>
</div>

<!-- Visi & Misi -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-star" aria-hidden="true"></i> {{ $tentangContent->vm_section_label }}</div>
    <div class="visi-misi-grid">
        <div class="vm-card">
            <div class="vm-icon"><i class="{{ $tentangContent->vm_visi_icon }}" aria-hidden="true"></i></div>
            <h3>{{ $tentangContent->vm_visi_heading }}</h3>
            <p>{{ $tentangContent->visi_text }}</p>
        </div>
        <div class="vm-card">
            <div class="vm-icon"><i class="{{ $tentangContent->vm_misi_icon }}" aria-hidden="true"></i></div>
            <h3>{{ $tentangContent->vm_misi_heading }}</h3>
            <ul style="padding-left: 1.2rem; color: var(--teks-muted); line-height: 2;">
                @foreach(($tentangContent->misi_items ?? []) as $misiItem)
                    <li>{{ $misiItem }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@if($anakAsuh->isNotEmpty())
<!-- Cuplikan data anak asuh — daftar lengkap di /anak-asuh -->
<div style="margin-bottom: 3rem;" class="tentang-anak-teaser">
    <div class="section-label"><i class="fas fa-children" aria-hidden="true"></i> {{ $anakAsuhPage->layout_page_title }}</div>
    <h2 class="section-head">{{ $anakAsuhPage->hero_title }}</h2>
    <p class="section-sub" style="margin-bottom: 0.5rem;">{{ $anakAsuhPage->layout_page_subtitle }}</p>
    <div class="tentang-anak-peek" aria-hidden="true">
        @foreach($anakAsuh->take(8) as $row)
            @if($row->fotoUrl())
                <div class="tentang-anak-peek-av"><img src="{{ $row->fotoUrl() }}" alt="" loading="lazy"></div>
            @endif
        @endforeach
    </div>
    <p class="tentang-anak-teaser-cta">
        <a href="{{ route('anak-asuh') }}">Lihat halaman anak asuh <i class="fas fa-arrow-right" style="font-size:0.85em;" aria-hidden="true"></i></a>
    </p>
</div>
@endif

<!-- Nilai -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-heart" aria-hidden="true"></i> {{ $tentangContent->nilai_section_label }}</div>
    <h2 class="section-head">{{ $tentangContent->nilai_section_title }}</h2>
    @if(filled($tentangContent->nilai_section_sub ?? null))
        <p class="section-sub">{{ $tentangContent->nilai_section_sub }}</p>
    @endif
    <div class="nilai-grid">
        @foreach(($tentangContent->nilai_items ?? []) as $nilai)
            <div class="nilai-item">
                <div class="emoji"><i class="{{ $nilai['icon'] ?? 'fas fa-circle' }}" aria-hidden="true"></i></div>
                <h4>{{ $nilai['title'] ?? '' }}</h4>
                <p>{{ $nilai['text'] ?? '' }}</p>
            </div>
        @endforeach
    </div>
</div>

<!-- Sejarah -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-clock-rotate-left" aria-hidden="true"></i> {{ $tentangContent->sejarah_section_label }}</div>
    <h2 class="section-head">{{ $tentangContent->sejarah_section_title }}</h2>
    <p class="section-sub">{{ $tentangContent->sejarah_section_sub }}</p>
    <div class="card" style="padding: 2.5rem;">
        <div class="sejarah-timeline">
            @foreach(($tentangContent->sejarah_items ?? []) as $item)
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">{{ $item['badge'] ?? '' }}</div>
                    <div class="timeline-title">{{ $item['title'] ?? '' }}</div>
                    <div class="timeline-desc">{{ $item['body'] ?? '' }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Pengurus -->
<div style="margin-bottom: 3rem;">
    <div class="section-label"><i class="fas fa-users" aria-hidden="true"></i> {{ $tentangContent->pengurus_section_label }}</div>
    <h2 class="section-head">{{ $tentangContent->pengurus_section_title }}</h2>
    <p class="section-sub">{{ $tentangContent->pengurus_section_sub }}</p>
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
    <h2 style="font-size: 1.75rem; margin-bottom: 0.75rem;">{{ $tentangContent->cta_title }}</h2>
    <p style="opacity: 0.9; margin-bottom: 2rem;">{{ $tentangContent->cta_subtitle }}</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('donasi.index') }}" class="btn btn-white"><i class="fas fa-heart" style="margin-right:6px;" aria-hidden="true"></i>{{ $tentangContent->cta_btn_donasi }}</a>
        <a href="{{ route('kunjungan.create') }}" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4);"><i class="fas fa-door-open" style="margin-right:6px;" aria-hidden="true"></i>{{ $tentangContent->cta_btn_kunjungan }}</a>
        <a href="{{ route('kontak') }}" class="btn" style="background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4);"><i class="fas fa-phone" style="margin-right:6px;" aria-hidden="true"></i>{{ $tentangContent->cta_btn_kontak }}</a>
    </div>
</div>

{{-- Modal foto pengurus timbul saat diklik --}}
<div id="imageModal" class="image-modal" onclick="closeImageModal(event)">
    <span class="image-modal-close" onclick="closeImageModal(event)" title="Tutup">&times;</span>
    <div class="image-modal-body">
        <img id="imageModalImg" class="image-modal-content" src="" alt="" onclick="event.stopPropagation()">
        <div id="imageModalCaption" class="image-modal-caption"></div>
    </div>
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
    if (!modal || !modal.classList.contains('show')) return;
    if (e && e.type === 'keydown') {
        if (e.key !== 'Escape') return;
    } else if (e && e.target !== modal && !(e.target.classList && e.target.classList.contains('image-modal-close'))) {
        return;
    }
    modal.classList.remove('show');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeImageModal(e);
});
</script>
@endpush
