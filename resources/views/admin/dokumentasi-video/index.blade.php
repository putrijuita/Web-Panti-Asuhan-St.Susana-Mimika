@extends('admin.layouts.app')

@section('title', 'Dokumentasi Video')
@section('page-title', 'Dokumentasi Video')
@section('page-subtitle', 'Kelola dokumentasi video kegiatan panti')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-photo-film" style="margin-right:8px;color:#1e40af;"></i>
            Daftar Dokumentasi Video / Foto
        </span>
        <a href="{{ route('admin.dokumentasi-video.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Dokumentasi
        </a>
    </div>
    <div class="card-body">
        @if($videos->count() === 0)
            <p style="color:#94a3b8;font-size:13px;text-align:center;padding:20px 0;">
                Belum ada dokumentasi. Klik tombol <strong>Tambah Dokumentasi</strong> untuk menambahkan.
            </p>
        @else
            <div class="table-wrap">
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
                        @endphp
                        <tr>
                            <td>
                                @php
                                    $ext = $isVideo ? strtolower(pathinfo($video->file_path, PATHINFO_EXTENSION)) : '';
                                    $mimeMap = ['mp4' => 'video/mp4', 'webm' => 'video/webm', 'mov' => 'video/quicktime', 'avi' => 'video/x-msvideo', 'mkv' => 'video/x-matroska'];
                                    $mimeType = $mimeMap[$ext] ?? 'video/mp4';
                                    $videoUrl = route('admin.dokumentasi-video.stream', $video);
                                @endphp
                                @if($isVideo)
                                    <video controls preload="metadata" playsinline
                                        style="max-width: 200px; max-height: 160px; border-radius: 8px; border:1px solid #e2e8f0; background:#000;">
                                        <source src="{{ $videoUrl }}" type="{{ $mimeType }}">
                                        Browser Anda tidak mendukung pemutaran video.
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
                                            data-url="{{ $fileUrl }}"
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
                                          onsubmit="return confirm('Yakin ingin menghapus video ini?');">
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
            </div>
            <div class="pagination-wrap">
                <div>Menampilkan {{ $videos->firstItem() }}–{{ $videos->lastItem() }} dari {{ $videos->total() }} data</div>
                <div>
                    @include('admin.partials.pagination', ['paginator' => $videos])
                </div>
            </div>
        @endif
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

@push('scripts')
<script>
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

    document.querySelectorAll('.btn-lihat-dokumentasi').forEach(function(btn) {
        btn.addEventListener('click', function() {
            openModal(this.getAttribute('data-url'), this.getAttribute('data-nama'), this.getAttribute('data-is-video'));
        });
    });
    btnTutup.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
})();
</script>
@endpush
@endsection

