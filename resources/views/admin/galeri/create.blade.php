@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri')
@section('page-title', 'Tambah Foto Galeri')
@section('page-subtitle', 'Tambahkan foto baru ke halaman galeri user')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus" style="color:#1e40af;margin-right:8px;"></i>
            Form Tambah Foto Galeri
        </span>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="galeri_category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('galeri_category_id') == $category->id)>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Nama / Judul Foto</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Keterangan (opsional)</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Foto
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Galeri
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

