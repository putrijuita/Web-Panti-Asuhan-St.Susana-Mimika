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
        <form method="POST"
              action="{{ isset($editing) && $editing ? route('admin.kegiatan.update', $editing) : route('admin.kegiatan.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($editing) && $editing)
                @method('PUT')
            @endif

            <div class="form-group">
                <label class="form-label">Nama Program</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $editing->nama ?? '') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Waktu Program (opsional)</label>
                <input type="datetime-local" name="waktu_kegiatan" class="form-control"
                       value="{{ old('waktu_kegiatan', isset($editing) && $editing && $editing->waktu_kegiatan ? $editing->waktu_kegiatan->format('Y-m-d\TH:i') : '') }}">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">
                    Boleh dikosongkan jika tidak ingin menampilkan waktu khusus.
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Program</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">
                    Unggah gambar untuk kartu program. Format: JPG, JPEG, PNG, WEBP. Tanpa batasan ukuran file.
                </div>
                @if(isset($editing) && $editing && $editing->gambar)
                    <div style="margin-top:8px;">
                        <img src="{{ asset('storage/'.$editing->gambar) }}" alt="{{ $editing->nama }}" style="height:70px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Program</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $editing->deskripsi ?? '') }}</textarea>
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
                    Kategori yang digunakan: <strong>Program Unggulan</strong> dan <strong>Program Lainnya</strong>.
                    Jika ingin mengubah nama kategori, gunakan tombol <strong>Kelola Kategori</strong> di halaman program.
                </div>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Program
                </button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary" style="margin-left:4px;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Program
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-table" style="color:#1e40af;margin-right:8px;"></i>
            Tabel Program
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Program</th>
                    <th>Keterangan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan as $item)
                <tr>
                    <td style="color:#94a3b8;font-size:12px;">{{ $kegiatan->firstItem() + $loop->index }}</td>
                    <td style="font-weight:600;font-size:13.5px;">{{ $item->nama }}</td>
                    <td style="font-size:12.5px;color:#64748b;max-width:260px;">
                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}
                    </td>
                    <td style="font-size:12px;">
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}" style="height:60px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
                        @else
                            <span style="color:#cbd5e1;">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.kegiatan.show', $item) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.kegiatan.edit', $item) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}" onsubmit="return confirm('Hapus program ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                        Belum ada data program
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($kegiatan->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $kegiatan->firstItem() }}–{{ $kegiatan->lastItem() }} dari {{ $kegiatan->total() }} program</span>
        {{ $kegiatan->links('admin.partials.pagination') }}
    </div>
    @endif
</div>

@endsection

