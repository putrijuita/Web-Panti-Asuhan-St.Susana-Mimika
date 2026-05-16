@extends('layouts.app')

@section('title', $page->page_meta_title)
@section('page-title', $page->layout_page_title)
@section('page-subtitle', $page->layout_page_subtitle)

@push('styles')
<style>
    .pub-anak-wrap {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 2rem 1.75rem 2.25rem;
        box-shadow: 0 4px 28px rgba(14, 165, 233, 0.07);
        margin-bottom: 2rem;
    }
    .pub-anak-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(14, 165, 233, 0.1);
        color: var(--biru-tua);
        padding: 0.35rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }
    .pub-anak-title {
        font-family: 'Literata', Georgia, serif;
        font-size: clamp(1.45rem, 3.5vw, 1.85rem);
        font-weight: 800;
        color: var(--biru-gelap);
        margin-bottom: 0.45rem;
        line-height: 1.2;
    }
    .pub-anak-sub {
        color: var(--teks-muted);
        font-size: 1rem;
        line-height: 1.55;
        margin-bottom: 0;
        font-family: 'Source Sans 3', sans-serif;
    }
    .pub-anak-intro {
        color: var(--teks-muted);
        font-size: 0.92rem;
        line-height: 1.6;
        margin-top: 0.85rem;
        max-width: 62ch;
    }

    .child-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 260px), 1fr));
        gap: 22px;
        margin-bottom: 2rem;
    }
    .child-card {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 20px 18px;
        box-shadow: 0 10px 26px rgba(8, 47, 73, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        text-align: center;
        overflow: hidden;
    }
    .child-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(8, 47, 73, 0.09);
    }
    .child-avatar {
        width: clamp(156px, 48vmin, 280px);
        height: clamp(156px, 48vmin, 280px);
        border-radius: 16px;
        margin: 6px auto 14px;
        overflow: hidden;
        border: 2px solid rgba(56, 189, 248, 0.35);
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(61, 122, 82, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(36px, 10vmin, 52px);
        color: var(--biru-gelap);
    }
    .child-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .child-avatar-btn {
        width: 100%;
        height: 100%;
        border: none;
        padding: 0;
        border-radius: 14px;
        cursor: pointer;
        background: transparent;
        display: block;
    }
    .child-avatar-btn:hover { opacity: 0.92; }
    .child-avatar-btn img { display: block; }
    .child-name-btn {
        border: none;
        background: transparent;
        padding: 0;
        margin: 0;
        width: 100%;
        cursor: pointer;
        text-align: center;
        font: inherit;
    }
    .child-name-btn:hover {
        color: var(--biru-tua);
        text-decoration: underline;
    }
    .child-name {
        font-family: 'Source Sans 3', system-ui, sans-serif;
        font-size: 1.08rem;
        font-weight: 700;
        margin-top: 8px;
        color: var(--biru-gelap);
    }
    .child-empty {
        text-align: center;
        color: var(--teks-muted);
        padding: 28px 12px;
        border: 1px dashed rgba(148, 163, 184, 0.5);
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.65);
    }
    .image-modal {
        display: none;
        position: fixed;
        z-index: 10050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        min-height: 100dvh;
        background: rgba(0, 0, 0, 0.88);
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
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
    }
    .image-modal-close:hover { opacity: 0.9; }
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
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.45);
        pointer-events: auto;
    }
    .image-modal-caption {
        color: #fff;
        text-align: center;
        padding: 14px 16px 0;
        font-size: 15px;
        font-weight: 600;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
        max-width: min(92vw, 560px);
        line-height: 1.4;
        pointer-events: auto;
    }

    /* Tablet: sedikit rapat agar 2 kolom tetap nyaman */
    @media (max-width: 900px) {
        .child-grid {
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
            gap: 18px;
        }
    }

    /* Mobile: satu kolom, foto memakai lebar layar (aman untuk safe area) */
    @media (max-width: 640px) {
        .pub-anak-wrap {
            padding: 1.35rem 1rem 1.65rem;
            border-radius: 16px;
            margin-bottom: 1.25rem;
        }
        .pub-anak-badge {
            font-size: 0.8rem;
            padding: 0.3rem 0.85rem;
        }
        .pub-anak-title {
            font-size: clamp(1.28rem, 5.8vw, 1.62rem);
        }
        .pub-anak-sub {
            font-size: 0.94rem;
            line-height: 1.5;
        }
        .pub-anak-intro {
            font-size: 0.87rem;
            margin-top: 0.65rem;
        }
        .child-grid {
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 1.5rem;
        }
        .child-card {
            padding: 22px 14px 20px;
            border-radius: 16px;
        }
        .child-avatar {
            width: min(300px, 88vw);
            height: min(300px, 88vw);
            max-width: 100%;
            border-radius: 18px;
            margin: 4px auto 12px;
            font-size: min(52px, 15vw);
        }
        .child-avatar-btn {
            border-radius: 16px;
        }
        .child-name,
        .child-name-btn {
            font-size: 1.14rem;
            margin-top: 4px;
            padding: 6px 10px;
            min-height: 44px;
            box-sizing: border-box;
        }
        .child-name-btn {
            display: inline-flex;
            width: 100%;
            max-width: 100%;
            align-items: center;
            justify-content: center;
        }
        .child-card:hover {
            transform: none;
            box-shadow: 0 10px 26px rgba(8, 47, 73, 0.05);
        }
        @media (hover: hover) and (pointer: fine) {
            .child-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 18px 40px rgba(8, 47, 73, 0.09);
            }
        }
        .image-modal-close {
            min-width: 44px;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 8px;
            font-size: 2.25rem;
        }
        .image-modal-body {
            padding-left: max(12px, env(safe-area-inset-left, 0px));
            padding-right: max(12px, env(safe-area-inset-right, 0px));
            padding-bottom: max(28px, env(safe-area-inset-bottom, 0px));
        }
        .image-modal-content {
            max-height: calc(100dvh - 140px);
        }
    }

    /* Layar sangat sempit */
    @media (max-width: 380px) {
        .child-avatar {
            width: min(280px, 88vw);
            height: min(280px, 88vw);
        }
    }
</style>
@endpush

@section('content')
<div class="pub-anak-wrap">
    <div class="pub-anak-badge"><i class="fas fa-children" aria-hidden="true"></i> {{ $page->layout_page_title }}</div>
    <h1 class="pub-anak-title">{{ $page->hero_title }}</h1>
    <p class="pub-anak-sub">{{ $page->layout_page_subtitle }}</p>
    @if(filled(trim((string) $page->hero_subtitle)))
        <p class="pub-anak-intro">{{ $page->hero_subtitle }}</p>
    @endif
</div>

<div class="child-grid">
    @forelse($anak as $row)
        @php
            $nm = trim($row->nama_panggilan);
            $imgUrl = $row->fotoUrl();
        @endphp
        <article class="child-card">
            <div class="child-avatar">
                @if($imgUrl)
                    <button type="button" class="child-avatar-btn js-lightbox-open" data-img="{{ e($imgUrl) }}" data-caption="{{ e($nm) }}" title="Klik untuk memperbesar" aria-label="Perbesar foto {{ $nm }}">
                        <img src="{{ $imgUrl }}" alt="{{ $nm }}">
                    </button>
                @else
                    <i class="fas fa-child" aria-hidden="true"></i>
                @endif
            </div>
            @if($imgUrl)
                <button type="button" class="child-name child-name-btn js-lightbox-open" data-img="{{ e($imgUrl) }}" data-caption="{{ e($nm) }}" title="Klik untuk memperbesar foto">{{ $nm }}</button>
            @else
                <div class="child-name">{{ $nm }}</div>
            @endif
        </article>
    @empty
        <div class="child-empty" style="grid-column: 1 / -1;">
            <i class="fas fa-children" style="font-size:34px;margin-bottom:10px;display:block;opacity:.65;"></i>
            {{ $page->empty_text }}
        </div>
    @endforelse
</div>

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
document.addEventListener('click', function(e) {
    var btn = e.target.closest('.js-lightbox-open');
    if (!btn || !btn.dataset.img) return;
    e.preventDefault();
    openImageModal(btn.dataset.img, btn.dataset.caption || '');
});
</script>
@endpush
