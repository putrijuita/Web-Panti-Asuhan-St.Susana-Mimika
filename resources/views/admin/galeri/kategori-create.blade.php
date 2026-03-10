@extends('admin.layouts.app')

@section('title', 'Tambah Kategori Galeri')
@section('page-title', 'Tambah Kategori Galeri')
@section('page-subtitle', 'Buat kategori untuk mengelompokkan foto galeri')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-tags" style="color:#1e40af;margin-right:8px;"></i>
            Form Tambah Kategori Galeri
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

        <form method="POST" action="{{ route('admin.galeri.categories.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Kategori
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Galeri
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

