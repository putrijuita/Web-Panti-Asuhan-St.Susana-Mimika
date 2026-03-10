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
                <input type="file" name="gambar" class="form-control" accept="image/*">
                @if($struktur->gambar_path)
                    <div style="margin-top:8px;">
                        <span style="font-size:12px;color:#64748b;">Gambar saat ini:</span><br>
                        <img src="{{ asset('storage/'.$struktur->gambar_path) }}" alt="{{ $struktur->nama }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;margin-top:4px;">
                    </div>
                @endif
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

