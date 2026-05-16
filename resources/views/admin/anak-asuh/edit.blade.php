@extends('admin.layouts.app')

@section('title', 'Edit Anak Asuh')
@section('page-title', 'Edit Anak Asuh')
@section('page-subtitle', 'Perbarui data anak asuh (admin & super admin)')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-edit" style="margin-right:8px;color:var(--primary)"></i>
            Edit Data Anak Asuh
        </span>
        <a href="{{ route('admin.anak-asuh.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.anak-asuh.update', $item) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="nama_lengkap">Nama lengkap</label>
                    <input id="nama_lengkap" type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $item->nama_lengkap) }}" required>
                    @error('nama_lengkap')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="nama_panggilan">Nama panggilan (opsional)</label>
                    <input id="nama_panggilan" type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan', $item->nama_panggilan) }}">
                    @error('nama_panggilan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="tempat_lahir">Tempat lahir</label>
                    <input id="tempat_lahir" type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $item->tempat_lahir) }}">
                    @error('tempat_lahir')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="tanggal_lahir">Tanggal lahir</label>
                    <input id="tanggal_lahir" type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $item->tanggal_lahir?->format('Y-m-d')) }}">
                    @error('tanggal_lahir')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="sekolah">Sedang sekolah?</label>
                    <select id="sekolah" name="sekolah" class="form-control" required>
                        <option value="1" {{ old('sekolah', (int)$item->sekolah) == 1 ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('sekolah', (int)$item->sekolah) == 0 ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('sekolah')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="nama_sekolah">Nama sekolah (jika ada)</label>
                    <input id="nama_sekolah" type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $item->nama_sekolah) }}">
                    @error('nama_sekolah')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="asal_daerah">Alamat darimana (asal daerah)</label>
                    <input id="asal_daerah" type="text" name="asal_daerah" class="form-control" value="{{ old('asal_daerah', $item->asal_daerah) }}">
                    @error('asal_daerah')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="foto">Ganti foto anak (publik)</label>
                    <input id="foto" type="file" name="foto" class="form-control" accept="image/*">
                    <small style="display:block;margin-top:6px;color:var(--gray-500);font-size:12px;">
                        Maks. 1 GB. JPG/PNG/WebP/GIF.
                    </small>
                    @error('foto')<small style="color:#b91c1c;">{{ $message }}</small>@enderror

                    @if($item->fotoUrl())
                        <div style="margin-top:10px;">
                            <img src="{{ $item->fotoUrl() }}" alt="{{ $item->nama_lengkap }}" style="width:88px;height:88px;border-radius:18px;object-fit:cover;border:1px solid #e2e8f0;display:block;">
                        </div>
                        <label style="display:flex;align-items:center;gap:8px;margin-top:8px;font-size:13px;color:var(--gray-600);cursor:pointer;">
                            <input type="hidden" name="hapus_foto" value="0">
                            <input type="checkbox" name="hapus_foto" value="1">
                            Hapus foto
                        </label>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="alamat_detail">Alamat rincian (internal/opsional)</label>
                <textarea id="alamat_detail" name="alamat_detail" class="form-control" rows="3">{{ old('alamat_detail', $item->alamat_detail) }}</textarea>
                @error('alamat_detail')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="catatan">Keterangan tambahan (internal/opsional)</label>
                <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan', $item->catatan) }}</textarea>
                @error('catatan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Perbarui
                </button>
                <a href="{{ route('admin.anak-asuh.show', $item) }}" class="btn btn-secondary">
                    <i class="fas fa-eye"></i> Lihat Detail
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

