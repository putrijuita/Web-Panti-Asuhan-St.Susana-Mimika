@extends('admin.layouts.app')

@section('title', 'Tambah Pengelolaan Donasi')
@section('page-title', 'Tambah Pengelolaan Donasi')
@section('page-subtitle', 'Catat nama pengelolaan, jumlah pengeluaran, bukti gambar, dan tanggal/waktu')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus" style="color:#059669;margin-right:8px;"></i>
            Form Tambah Pengelolaan Donasi
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
        <form method="POST" action="{{ route('admin.pengelolaan-donasi.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Pengelolaan</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Contoh: Pembelian kebutuhan bulanan" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Pengeluaran (Rp)</label>
                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" min="0" step="1" placeholder="Contoh: 500000" required>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Pengeluaran / Bukti (opsional)</label>
                <input type="file" name="gambar" class="form-control" accept="image/jpeg,image/png,image/webp">
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal / Waktu Pengelolaan</label>
                <input type="datetime-local" name="tanggal_waktu" class="form-control" value="{{ old('tanggal_waktu', now()->format('Y-m-d\TH:i')) }}" required>
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
