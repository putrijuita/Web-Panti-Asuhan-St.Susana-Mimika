@extends('admin.layouts.app')

@section('title', 'Tambah Anak Asuh')
@section('page-title', 'Tambah Anak Asuh')
@section('page-subtitle', 'Lengkapi identitas anak asuh dan foto')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus-circle" style="margin-right:8px;color:var(--primary)"></i>
            Tambah Data Anak Asuh
        </span>
        <a href="{{ route('admin.anak-asuh.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:16px;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.anak-asuh.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="nama_lengkap">Nama lengkap</label>
                    <input id="nama_lengkap" type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                    @error('nama_lengkap')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="nama_panggilan">Nama panggilan (opsional)</label>
                    <input id="nama_panggilan" type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan') }}">
                    @error('nama_panggilan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="tempat_lahir">Tempat lahir</label>
                    <input id="tempat_lahir" type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="tanggal_lahir">Tanggal lahir</label>
                    <input id="tanggal_lahir" type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="sekolah">Sedang sekolah?</label>
                    <select id="sekolah" name="sekolah" class="form-control" required>
                        <option value="1" {{ old('sekolah', 1) == 1 ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('sekolah') === '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('sekolah')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                    <small style="display:block;margin-top:6px;color:var(--gray-500);font-size:12px;">
                        Jika “Tidak”, nama sekolah akan disimpan kosong.
                    </small>
                </div>
                <div class="form-group">
                    <label class="form-label" for="nama_sekolah">Nama sekolah (jika ada)</label>
                    <input id="nama_sekolah" type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah') }}">
                    @error('nama_sekolah')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="asal_daerah">Alamat darimana (asal daerah)</label>
                    <input id="asal_daerah" type="text" name="asal_daerah" class="form-control" value="{{ old('asal_daerah') }}">
                    @error('asal_daerah')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="foto">Foto anak (publik)</label>
                    <input id="foto" type="file" name="foto" class="form-control" accept="image/*">
                    <small style="display:block;margin-top:6px;color:var(--gray-500);font-size:12px;">
                        Maks. 2 MB. JPG/PNG/WebP/GIF.
                    </small>
                    @error('foto')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="alamat_detail">Alamat rincian (internal/opsional)</label>
                <textarea id="alamat_detail" name="alamat_detail" class="form-control" rows="3">{{ old('alamat_detail') }}</textarea>
                @error('alamat_detail')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="catatan">Keterangan tambahan (internal/opsional)</label>
                <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                @error('catatan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.anak-asuh.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

