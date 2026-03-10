@extends('admin.layouts.app')

@section('title', isset($editing) && $editing ? 'Edit Pengelolaan Donasi' : 'Tambah Pengelolaan Donasi')
@section('page-title', 'Pengelolaan Donasi')
@section('page-subtitle', isset($editing) && $editing ? 'Edit data pengeluaran donasi' : 'Tambah data pengeluaran donasi')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus-circle" style="color:#16a34a;margin-right:8px;"></i>
            {{ isset($editing) && $editing ? 'Edit Pengelolaan Donasi' : 'Tambah Pengelolaan Donasi' }}
        </span>
    </div>
    <div class="card-body">
        <form method="POST"
              action="{{ isset($editing) && $editing ? route('admin.pengelolaan-donasi.update', $editing) : route('admin.pengelolaan-donasi.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($editing) && $editing)
                @method('PUT')
            @endif

            <div class="form-group">
                <label class="form-label">Nama Pengeluaran</label>
                <input type="text" name="nama" class="form-control"
                       value="{{ old('nama', $editing->nama_pengeluaran ?? '') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Pengeluaran (Rp)</label>
                <input type="number" name="jumlah" class="form-control" min="0" step="100"
                       value="{{ old('jumlah', $editing->jumlah_pengeluaran ?? '') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar Pengeluaran</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                @if(isset($editing) && $editing && $editing->gambar_path)
                    <div style="font-size:12px;color:#64748b;margin-top:6px;">
                        Gambar saat ini: <code>{{ $editing->gambar_path }}</code>
                    </div>
                @endif
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">
                    Opsional, format gambar (JPG/PNG) maksimal 2MB.
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal / Waktu Pengeluaran</label>
                <input type="datetime-local" name="waktu_pengeluaran" class="form-control"
                       value="{{ old('waktu_pengeluaran', isset($editing) && $editing && $editing->tanggal_pengeluaran ? $editing->tanggal_pengeluaran->format('Y-m-d\TH:i') : '') }}"
                       required>
            </div>

            <div style="display:flex;gap:10px;align-items:center;margin-top:8px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
                <a href="{{ route('admin.pengelolaan-donasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Pengelolaan Donasi
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-table" style="color:#1e40af;margin-right:8px;"></i>
            Tabel Pengelolaan Donasi
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengeluaran</th>
                    <th>Jumlah Pengeluaran</th>
                    <th>Gambar</th>
                    <th>Tanggal / Waktu Pengeluaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaran as $item)
                <tr>
                    <td style="color:#94a3b8;font-size:12px;">{{ $pengeluaran->firstItem() + $loop->index }}</td>
                    <td style="font-weight:600;font-size:13.5px;">{{ $item->nama_pengeluaran }}</td>
                    <td style="font-weight:700;color:#dc2626;">
                        Rp {{ number_format($item->jumlah_pengeluaran, 0, ',', '.') }}
                    </td>
                    <td style="font-size:12px;">
                        @if($item->gambar_path)
                            <span class="badge badge-info">Ada Gambar</span>
                        @else
                            <span style="color:#cbd5e1;">Tidak ada</span>
                        @endif
                    </td>
                    <td style="font-size:12.5px;color:#64748b;">
                        @if($item->tanggal_pengeluaran)
                            {{ $item->tanggal_pengeluaran->format('d M Y H:i') }}
                        @else
                            <span style="color:#cbd5e1;">-</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.pengelolaan-donasi.edit', $item) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.pengelolaan-donasi.destroy', $item) }}" onsubmit="return confirm('Hapus data pengelolaan donasi ini?')">
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
                    <td colspan="6" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                        Belum ada data pengelolaan donasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pengeluaran->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $pengeluaran->firstItem() }}–{{ $pengeluaran->lastItem() }} dari {{ $pengeluaran->total() }} data</span>
        {{ $pengeluaran->links('admin.partials.pagination') }}
    </div>
    @endif
</div>

@endsection

