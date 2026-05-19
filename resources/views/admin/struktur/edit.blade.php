@extends('admin.layouts.app')

@section('title', 'Edit Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')
@section('page-subtitle', 'Perbarui data struktur organisasi')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-pen" style="color:#1e40af;margin-right:8px;"></i>
            Edit Struktur Organisasi
        </span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.struktur.update', $struktur) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Gambar (opsional, isi jika ingin ganti)</label>
                @include('admin.partials.cms-current-file', [
                    'url' => $struktur->gambar_path ? asset('storage/'.$struktur->gambar_path) : null,
                    'path' => $struktur->gambar_path,
                    'maxHeight' => '96px',
                    'maxWidth' => '96px',
                    'emptyText' => 'Belum ada gambar.',
                ])
                <input type="file" name="gambar" class="form-control" accept="image/*">
                @error('gambar')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $struktur->nama) }}" required>
                @error('nama')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status / Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $struktur->jabatan) }}" required>
                @error('jabatan')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

