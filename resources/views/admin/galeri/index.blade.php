@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')
@section('page-title', 'Galeri Foto & Dokumentasi Video')
@section('page-subtitle', 'Kelola foto galeri dan dokumentasi video dalam satu halaman')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <span class="card-title">
                <i class="fas fa-images" style="color:#1e40af;margin-right:8px;"></i>
                Galeri Foto & Dokumentasi Video
            </span>
            <div style="font-size:12px;color:#64748b;margin-top:2px;">
                Kelola foto galeri dan dokumentasi video dalam satu halaman.
            </div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('admin.galeri.categories.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-tags"></i> Tambah Kategori
            </a>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Galeri Foto
            </a>
            <a href="{{ route('admin.dokumentasi-video.create') }}" class="btn btn-primary btn-sm" style="background:#7c3aed;">
                <i class="fas fa-video"></i> Tambah Dokumentasi Video
            </a>
        </div>
    </div>
</div>

<ul class="galeri-tabs" role="tablist">
    <li><a href="#tab-foto" class="galeri-tab active" data-tab="foto" onclick="switchTab('foto', this)">Galeri Foto</a></li>
    <li><a href="#tab-video" class="galeri-tab" data-tab="video" onclick="switchTab('video', this)">Dokumentasi Video</a></li>
</ul>

<div id="tab-foto" class="galeri-tab-pane active">
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-photo-film" style="color:#1e40af;margin-right:8px;"></i>
            Daftar Foto Galeri
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>
                            @if($item->gambar)
                                @php $imgUrl = asset('storage/'.$item->gambar); @endphp
                                <button type="button" class="galeri-thumb-btn" data-lightbox-src="{{ $imgUrl }}" data-lightbox-caption="{{ $item->nama }}" title="Klik untuk memperbesar">
                                    <img src="{{ $imgUrl }}" alt="{{ $item->nama }}" style="height:60px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;display:block;">
                                </button>
                            @else
                                <span style="color:#cbd5e1;">Tidak ada</span>
                            @endif
                        </td>
                        <td style="font-weight:600;font-size:13.5px;">{{ $item->nama }}</td>
                        <td style="font-size:12.5px;color:#64748b;max-width:320px;">
                            {{ \Illuminate\Support\Str::limit($item->keterangan, 80) ?: '-' }}
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.galeri.edit', $item) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;padding:40px;color:#94a3b8;">
                            <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                            Belum ada foto galeri
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
        <div class="pagination-wrap">
            <span>Menampilkan {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }} foto</span>
            {{ $items->links('admin.partials.pagination') }}
        </div>
    @endif
</div>
</div>

<div id="tab-video" class="galeri-tab-pane">
<div class="card">
    <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
        <span class="card-title">
            <i class="fas fa-video" style="color:#7c3aed;margin-right:8px;"></i>
            Daftar Dokumentasi Video
        </span>
        <a href="{{ route('admin.dokumentasi-video.create') }}" class="btn btn-primary btn-sm" style="background:#7c3aed;">
            <i class="fas fa-plus"></i> Tambah Dokumentasi
        </a>
    </div>
    <div class="table-wrap">
        @if($videos->count() === 0)
            <p style="color:#94a3b8;font-size:13px;text-align:center;padding:40px 20px;">
                <i class="fas fa-video" style="font-size:32px;margin-bottom:10px;display:block;color:#cbd5e1;"></i>
                Belum ada dokumentasi video. Klik <strong>Tambah Dokumentasi</strong> untuk menambahkan.
            </p>
        @else
            <table>
                <thead>
                    <tr>
                        <th style="width: 220px;">File</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    @php
                        $fileUrl = asset('storage/' . $video->file_path);
                        $isVideo = \Illuminate\Support\Str::endsWith(strtolower($video->file_path), ['.mp4','.mov','.avi','.mkv','.webm']);
                        $ext = $isVideo ? strtolower(pathinfo($video->file_path, PATHINFO_EXTENSION)) : '';
                        $mimeMap = ['mp4' => 'video/mp4', 'webm' => 'video/webm', 'mov' => 'video/quicktime', 'avi' => 'video/x-msvideo', 'mkv' => 'video/x-matroska'];
                        $mimeType = $mimeMap[$ext] ?? 'video/mp4';
                        $videoUrl = route('admin.dokumentasi-video.stream', $video);
                    @endphp
                    <tr>
                        <td>
                            @if($isVideo)
                                <video controls preload="metadata" playsinline
                                    style="max-width: 200px; max-height: 160px; border-radius: 8px; border:1px solid #e2e8f0; background:#000;">
                                    <source src="{{ $videoUrl }}" type="{{ $mimeType }}">
                                </video>
                            @else
                                <img src="{{ $fileUrl }}"
                                     alt="{{ $video->nama }}"
                                     style="max-width: 200px; max-height: 120px; border-radius: 8px; border:1px solid #e2e8f0;object-fit:cover;">
                            @endif
                        </td>
                        <td>{{ $video->nama }}</td>
                        <td style="max-width: 320px;">{{ $video->keterangan }}</td>
                        <td>
                            <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                <button type="button" class="btn btn-secondary btn-sm btn-lihat-dokumentasi"
                                        data-url="{{ $isVideo ? $videoUrl : $fileUrl }}"
                                        data-nama="{{ $video->nama }}"
                                        data-is-video="{{ $isVideo ? '1' : '0' }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                                <a href="{{ route('admin.dokumentasi-video.edit', $video) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.dokumentasi-video.destroy', $video) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($videos->hasPages())
                <div class="pagination-wrap">
                    <span>Menampilkan {{ $videos->firstItem() }}–{{ $videos->lastItem() }} dari {{ $videos->total() }} video</span>
                    {{ $videos->links('admin.partials.pagination') }}
                </div>
            @endif
        @endif
    </div>
</div>
</div>

{{-- Modal Lihat Video/Foto --}}
<div id="modalLihatDokumentasi" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,.85); align-items:center; justify-content:center; padding:20px;">
    <div style="background:#1e293b; border-radius:12px; max-width:90vw; max-height:90vh; overflow:hidden; box-shadow:0 25px 50px -12px rgba(0,0,0,.5);">
        <div style="padding:12px 16px; border-bottom:1px solid #334155; display:flex; align-items:center; justify-content:space-between;">
            <strong id="modalLihatJudul" style="color:#f1f5f9; font-size:15px;"></strong>
            <button type="button" id="modalLihatTutup" style="background:none; border:none; color:#94a3b8; font-size:22px; cursor:pointer; padding:4px; line-height:1;">&times;</button>
        </div>
        <div style="padding:16px; max-height:calc(90vh - 56px); overflow:auto; display:flex; align-items:center; justify-content:center;">
            <div id="modalLihatKonten"></div>
        </div>
    </div>
</div>

<!-- Lightbox untuk preview gambar -->
<div id="galleryLightbox" class="gallery-lightbox" aria-hidden="true">
    <button type="button" class="gallery-lightbox-close" onclick="closeGalleryLightbox()" aria-label="Tutup">&times;</button>
    <div class="gallery-lightbox-backdrop" onclick="closeGalleryLightbox()"></div>
    <div class="gallery-lightbox-content">
        <img id="galleryLightboxImg" src="" alt="">
        <p id="galleryLightboxCaption" class="gallery-lightbox-caption"></p>
    </div>
</div>

@endsection

@push('styles')
<style>
.galeri-tabs { list-style: none; display: flex; gap: 4px; margin-bottom: 20px; padding: 0; border-bottom: 1px solid var(--gray-200); }
.galeri-tabs li { margin: 0; }
.galeri-tab {
    display: inline-block; padding: 10px 18px; border-radius: 8px 8px 0 0;
    color: var(--gray-600); text-decoration: none; font-size: 13.5px; font-weight: 500;
    transition: all .2s;
}
.galeri-tab:hover { color: var(--primary); background: var(--gray-50); }
.galeri-tab.active { color: var(--primary); background: #fff; border: 1px solid var(--gray-200); border-bottom: 1px solid #fff; margin-bottom: -1px; }
.galeri-tab-pane { display: none; }
.galeri-tab-pane.active { display: block; }
.galeri-thumb-btn { background: none; border: none; padding: 0; cursor: pointer; border-radius: 8px; }
.galeri-thumb-btn:hover { opacity: 0.9; }
.gallery-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.gallery-lightbox.show { display: flex; }
.gallery-lightbox-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.85);
    cursor: pointer;
}
.gallery-lightbox-content {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 1;
}
.gallery-lightbox-content img {
    max-width: 100%;
    max-height: 85vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}
.gallery-lightbox-caption {
    margin-top: 12px;
    color: #fff;
    font-size: 14px;
    text-align: center;
    max-width: 500px;
}
.gallery-lightbox-close {
    position: absolute;
    top: 16px;
    right: 20px;
    z-index: 2;
    width: 44px;
    height: 44px;
    border: none;
    background: rgba(255,255,255,0.15);
    color: #fff;
    font-size: 28px;
    line-height: 1;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}
.gallery-lightbox-close:hover {
    background: rgba(255,255,255,0.25);
}
</style>
@endpush

@push('scripts')
<script>
function switchTab(tabName, el) {
    document.querySelectorAll('.galeri-tab').forEach(function(t) { t.classList.remove('active'); });
    document.querySelectorAll('.galeri-tab-pane').forEach(function(p) { p.classList.remove('active'); });
    if (el) el.classList.add('active');
    var pane = document.getElementById('tab-' + tabName);
    if (pane) pane.classList.add('active');
    var url = new URL(window.location.href);
    url.searchParams.set('tab', tabName);
    window.history.replaceState({}, '', url);
}
(function() {
    var modal = document.getElementById('modalLihatDokumentasi');
    var judul = document.getElementById('modalLihatJudul');
    var konten = document.getElementById('modalLihatKonten');
    var btnTutup = document.getElementById('modalLihatTutup');
    function openModal(url, nama, isVideo) {
        judul.textContent = nama || 'Dokumentasi';
        konten.innerHTML = '';
        if (isVideo === '1') {
            var video = document.createElement('video');
            video.src = url;
            video.controls = true;
            video.autoplay = true;
            video.style.maxWidth = '100%';
            video.style.maxHeight = '75vh';
            video.style.display = 'block';
            konten.appendChild(video);
        } else {
            var img = document.createElement('img');
            img.src = url;
            img.alt = nama;
            img.style.maxWidth = '100%';
            img.style.maxHeight = '75vh';
            img.style.display = 'block';
            konten.appendChild(img);
        }
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        var v = konten.querySelector('video');
        if (v) { v.pause(); v.src = ''; }
        konten.innerHTML = '';
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-lihat-dokumentasi')) {
            var btn = e.target.closest('.btn-lihat-dokumentasi');
            openModal(btn.getAttribute('data-url'), btn.getAttribute('data-nama'), btn.getAttribute('data-is-video'));
        }
    });
    if (btnTutup) btnTutup.addEventListener('click', closeModal);
    if (modal) modal.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
})();
function openGalleryLightbox(src, caption) {
    var lb = document.getElementById('galleryLightbox');
    var img = document.getElementById('galleryLightboxImg');
    var cap = document.getElementById('galleryLightboxCaption');
    if (lb && img) {
        img.src = src;
        img.alt = caption || '';
        if (cap) cap.textContent = caption || '';
        lb.classList.add('show');
        lb.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }
}
function closeGalleryLightbox() {
    var lb = document.getElementById('galleryLightbox');
    if (lb) {
        lb.classList.remove('show');
        lb.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.galeri-thumb-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var src = this.getAttribute('data-lightbox-src');
            var caption = this.getAttribute('data-lightbox-caption') || '';
            if (src) openGalleryLightbox(src, caption);
        });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeGalleryLightbox();
    });
    var params = new URLSearchParams(window.location.search);
    if (params.get('tab') === 'video') {
        switchTab('video', document.querySelector('.galeri-tab[data-tab="video"]'));
    }
});
</script>
@endpush

