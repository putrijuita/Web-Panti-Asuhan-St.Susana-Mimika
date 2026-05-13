@extends('admin.layouts.app')

@section('title', 'Tambah Jadwal Kegiatan Anak')
@section('page-title', 'Tambah Jadwal Kegiatan Anak')
@section('page-subtitle', 'Buat jadwal kegiatan harian untuk publik')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus-circle" style="margin-right:8px;color:var(--primary)"></i>
            Tambah Jadwal Kegiatan Anak
        </span>
        <a href="{{ route('admin.jadwal-anak.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:16px;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.jadwal-anak.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="judul">Judul kegiatan</label>
                <input id="judul" type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                @error('judul')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="kategori">Kategori (opsional)</label>
                    <input id="kategori" type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" placeholder="Ibadah / Belajar / Istirahat...">
                    @error('kategori')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="lokasi">Lokasi (opsional)</label>
                    <input id="lokasi" type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" placeholder="Aula / Ruang Belajar / Kelas...">
                    @error('lokasi')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="hari">Hari</label>
                    <select id="hari" name="hari" class="form-control" required>
                        @foreach($hariOptions as $key => $label)
                            <option value="{{ $key }}" {{ old('hari', 'setiap_hari') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('hari')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="urutan">Urutan (urutan di dalam hari)</label>
                    <input id="urutan" type="number" name="urutan" class="form-control" min="0" value="{{ old('urutan', 0) }}">
                    @error('urutan')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="jam_mulai">Jam mulai</label>
                    <input id="jam_mulai" type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}">
                    @error('jam_mulai')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="jam_selesai">Jam selesai</label>
                    <input id="jam_selesai" type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}">
                    @error('jam_selesai')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="admin-grid-2">
                <div class="form-group">
                    <label class="form-label" for="aktif">Status tampil publik</label>
                    <select id="aktif" name="aktif" class="form-control" required>
                        <option value="1" {{ old('aktif', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('aktif') === '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('aktif')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="deskripsi">Deskripsi (opsional)</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Keterangan detail untuk admin & publik">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<small style="color:#b91c1c;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.jadwal-anak.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

