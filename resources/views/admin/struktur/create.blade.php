@extends('admin.layouts.app')

@section('title', 'Tambah Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')
@section('page-subtitle', 'Tambahkan data struktur organisasi baru')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus-circle" style="color:#16a34a;margin-right:8px;"></i>
            Tambah Struktur Organisasi
        </span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.struktur.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">
                    Unggah foto pengurus. Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.
                </div>
                @error('gambar')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                @error('nama')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status / Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}" required>
                @error('jabatan')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

