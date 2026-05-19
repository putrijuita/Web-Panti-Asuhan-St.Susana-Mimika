@extends('admin.layouts.app')

@section('title', 'Edit Foto Galeri')
@section('page-title', 'Edit Foto Galeri')
@section('page-subtitle', 'Perbarui informasi foto yang tampil di halaman galeri user')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-pen" style="color:#1e40af;margin-right:8px;"></i>
            Edit Foto Galeri
        </span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.galeri.update', $item) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Kategori (opsional)</label>
                <select name="galeri_category_id" class="form-control">
                    <option value="">-- Tanpa kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('galeri_category_id', $item->galeri_category_id) == $category->id)>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Nama / Judul Foto</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar (biarkan kosong jika tidak diganti)</label>
                @include('admin.partials.cms-current-file', [
                    'url' => $item->gambar ? asset('storage/'.$item->gambar) : null,
                    'path' => $item->gambar,
                    'maxHeight' => '120px',
                    'emptyText' => 'Belum ada gambar.',
                ])
                <input type="file" name="gambar" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-label">Keterangan (opsional)</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $item->keterangan) }}</textarea>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Galeri
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

