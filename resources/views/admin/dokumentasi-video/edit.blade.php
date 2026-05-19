@extends('admin.layouts.app')

@section('title', 'Edit Dokumentasi Video')
@section('page-title', 'Edit Dokumentasi Video')
@section('page-subtitle', 'Perbarui dokumentasi video kegiatan panti')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-pen" style="margin-right:8px;color:#0ea5e9;"></i>
            Form Edit Dokumentasi Video
        </span>
        <a href="{{ route('admin.galeri.index') }}?tab=video" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.dokumentasi-video.update', $video) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @php
                $videoCurrentUrl = $video->file_path ? Storage::disk('public')->url($video->file_path) : null;
                $videoIsVideo = $video->file_path && \Illuminate\Support\Str::endsWith(strtolower($video->file_path), ['.mp4', '.mov', '.avi', '.mkv', '.webm']);
            @endphp
            @include('admin.partials.cms-current-file', [
                'url' => $videoCurrentUrl,
                'path' => $video->file_path,
                'type' => $videoIsVideo ? 'video' : 'image',
                'maxWidth' => '260px',
            ])

            <div class="form-group">
                <label for="video" class="form-label">Ganti File (opsional)</label>
                <input type="file" name="video" id="video" class="form-control" accept="video/*,image/*">
                <small style="font-size:12px;color:#64748b;display:block;margin-top:4px;">
                    Biarkan kosong jika tidak ingin mengubah file. Maksimal 100 MB.
                </small>
                @error('video')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama" class="form-label">Nama Video <span style="color:#ef4444;">*</span></label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $video->nama) }}" required>
                @error('nama')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="4">{{ old('keterangan', $video->keterangan) }}</textarea>
                @error('keterangan')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection

