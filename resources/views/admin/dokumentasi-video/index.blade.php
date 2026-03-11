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
                        <tr>
                            <td>
                                @php
                                    $isVideo = \Illuminate\Support\Str::endsWith(strtolower($video->file_path), ['.mp4','.mov','.avi','.mkv','.webm']);
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
                                    <img src="{{ Storage::disk('public')->url($video->file_path) }}"
                                         alt="{{ $video->nama }}"
                                         style="max-width: 200px; border-radius: 8px; border:1px solid #e2e8f0;object-fit:cover;">
                                @endif
                            </td>
                            <td>{{ $video->nama }}</td>
                            <td style="max-width: 320px;">{{ $video->keterangan }}</td>
                            <td>
                                <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                    <a href="{{ Storage::disk('public')->url($video->file_path) }}"
                                       class="btn btn-secondary btn-sm" target="_blank">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
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
@endsection

