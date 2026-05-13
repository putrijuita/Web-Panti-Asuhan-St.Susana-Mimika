@extends('admin.layouts.app')

@section('title', 'Edit Jadwal Kegiatan Anak')
@section('page-title', 'Edit Jadwal Kegiatan Anak')
@section('page-subtitle', 'Perbarui jadwal kegiatan anak asuh')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-edit" style="margin-right:8px;color:var(--primary)"></i>
            Edit Jadwal Kegiatan Anak
        </span>
        <a href="{{ route('admin.jadwal-anak.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.jadwal-anak.update', $jadwal) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="judul">Judul kegiatan</label>
                <input id="judul" type="text" name="judul" class="form-control" value="{{ old('judul', $jadwal->judul) }}" required>
                @error('judul')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="kategori">Kategori (opsional)</label>
                    <input id="kategori" type="text" name="kategori" class="form-control" value="{{ old('kategori', $jadwal->kategori) }}">
                    @error('kategori')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="lokasi">Lokasi (opsional)</label>
                    <input id="lokasi" type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $jadwal->lokasi) }}">
                    @error('lokasi')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="hari">Hari</label>
                    <select id="hari" name="hari" class="form-control" required>
                        @foreach($hariOptions as $key => $label)
                            <option value="{{ $key }}" {{ old('hari', $jadwal->hari) === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('hari')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="urutan">Urutan</label>
                    <input id="urutan" type="number" name="urutan" class="form-control" min="0" value="{{ old('urutan', $jadwal->urutan) }}">
                    @error('urutan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="jam_mulai">Jam mulai</label>
                    <input id="jam_mulai" type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai', $jadwal->jam_mulai ? substr($jadwal->jam_mulai, 0, 5) : '') }}">
                    @error('jam_mulai')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="jam_selesai">Jam selesai</label>
                    <input id="jam_selesai" type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', $jadwal->jam_selesai ? substr($jadwal->jam_selesai, 0, 5) : '') }}">
                    @error('jam_selesai')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="aktif">Status tampil publik</label>
                    <select id="aktif" name="aktif" class="form-control" required>
                        <option value="1" {{ (int)old('aktif', $jadwal->aktif) === 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ (int)old('aktif', $jadwal->aktif) === 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('aktif')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $jadwal->deskripsi) }}</textarea>
                    @error('deskripsi')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Perbarui
                </button>
                <a href="{{ route('admin.jadwal-anak.show', $jadwal) }}" class="btn btn-secondary">
                    <i class="fas fa-eye"></i> Lihat Detail
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

