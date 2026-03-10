@extends('admin.layouts.app')

@section('title', 'Kategori Program')
@section('page-title', 'Kelola Kategori Program')
@section('page-subtitle', 'Atur kategori program seperti Program Unggulan dan Program Lainnya')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-tags" style="color:#f97316;margin-right:8px;"></i>
            {{ isset($editing) && $editing ? 'Edit Kategori Kegiatan' : 'Tambah Kategori Kegiatan & Galeri' }}
        </span>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($editing) && $editing ? route('admin.kegiatan.categories.update', $editing) : route('admin.kegiatan.categories.store') }}">
            @csrf
            @if(isset($editing) && $editing)
                @method('PUT')
            @endif

            <div class="form-group">
                <label class="form-label">Nama Kategori Program</label>
                <input type="text" name="nama" class="form-control"
                       value="{{ old('nama', $editing->nama ?? '') }}" required>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Program
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-table" style="color:#1e40af;margin-right:8px;"></i>
            Tabel Kategori Kegiatan
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Dibuat</th>
                    <th>Diupdate</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td style="color:#94a3b8;font-size:12px;">{{ $categories->firstItem() + $loop->index }}</td>
                    <td style="font-weight:600;font-size:13.5px;">{{ $cat->nama }}</td>
                    <td style="font-size:12.5px;color:#64748b;">{{ $cat->created_at?->format('d M Y H:i') }}</td>
                    <td style="font-size:12.5px;color:#64748b;">{{ $cat->updated_at?->format('d M Y H:i') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.kegiatan.categories.edit', $cat) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.kegiatan.categories.destroy', $cat) }}" onsubmit="return confirm('Hapus kategori ini? Kegiatan yang menggunakan kategori ini akan menjadi tanpa kategori.')">
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
                    <td colspan="5" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                        Belum ada kategori kegiatan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $categories->firstItem() }}–{{ $categories->lastItem() }} dari {{ $categories->total() }} kategori</span>
        {{ $categories->links('admin.partials.pagination') }}
    </div>
    @endif
</div>

@endsection

