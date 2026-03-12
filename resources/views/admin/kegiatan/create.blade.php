@extends('admin.layouts.app')

@section('title', isset($editing) && $editing ? 'Edit Program' : 'Tambah Program')
@section('page-title', 'Dashboard Program')
@section('page-subtitle', isset($editing) && $editing ? 'Edit program yang sudah ada' : 'Tambahkan program baru')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus-circle" style="color:#16a34a;margin-right:8px;"></i>
            {{ isset($editing) && $editing ? 'Edit Program' : 'Tambah Program' }}
        </span>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:16px;">{{ session('success') }}</div>
        @endif
        <form method="POST"
              action="{{ isset($editing) && $editing ? route('admin.kegiatan.update', $editing) : route('admin.kegiatan.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($editing) && $editing)
                @method('PUT')
            @endif

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">
                    Unggah gambar untuk kartu program. Format: JPG, JPEG, PNG, WEBP.
                </div>
                @if(isset($editing) && $editing && $editing->gambar)
                    <div style="margin-top:8px;">
                        <img src="{{ asset('storage/'.$editing->gambar) }}" alt="{{ $editing->nama }}" style="height:70px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label">Nama Program</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $editing->nama ?? '') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Kategori Program</label>
                <select name="kegiatan_category_id" class="form-control" required>
                    <option value="">Pilih Kategori Program</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('kegiatan_category_id', $editing->kegiatan_category_id ?? null) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">
                    Pilih <strong>Kegiatan Unggulan</strong> atau <strong>Kegiatan Lainnya</strong>.
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Keterangan</label>
                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi program">{{ old('deskripsi', $editing->deskripsi ?? '') }}</textarea>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary" style="margin-left:4px;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Program
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
