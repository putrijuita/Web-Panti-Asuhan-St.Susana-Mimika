@extends('admin.layouts.app')

@section('title', 'Edit Pengelolaan Donasi')
@section('page-title', 'Edit Pengelolaan Donasi')
@section('page-subtitle', 'Perbarui data pengeluaran donasi')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-pen" style="color:#059669;margin-right:8px;"></i>
            Edit Pengelolaan Donasi
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
        <form method="POST" action="{{ route('admin.pengelolaan-donasi.update', $item) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Nama Pengelolaan</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Pengeluaran (Rp)</label>
                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $item->jumlah) }}" min="0" step="1" required>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Pengeluaran / Bukti (kosongkan jika tidak diganti)</label>
                <input type="file" name="gambar" class="form-control" accept="image/jpeg,image/png,image/webp">
                @if($item->gambar)
                    <div style="margin-top:8px;">
                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}" style="height:80px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal / Waktu Pengelolaan</label>
                <input type="datetime-local" name="tanggal_waktu" class="form-control" value="{{ old('tanggal_waktu', $item->tanggal_waktu->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save
                </button>
                <a href="{{ route('admin.pengelolaan-donasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
