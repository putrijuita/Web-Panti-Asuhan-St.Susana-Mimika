@extends('admin.layouts.app')

@section('title', 'Pengelolaan Donasi')
@section('page-title', 'Dashboard Pengelolaan Donasi')
@section('page-subtitle', 'Kelola pengeluaran dari donasi')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 20px;display:flex;flex-wrap:wrap;gap:12px;justify-content:space-between;align-items:center;">
        <div>
            <div style="font-size:14px;font-weight:600;color:#0f172a;margin-bottom:4px;">Pengelolaan Donasi</div>
            <div style="font-size:12px;color:#64748b;">Catat setiap pengeluaran donasi agar laporan tetap transparan.</div>
        </div>
        <div>
            <a href="{{ route('admin.pengelolaan-donasi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pengelolaan Donasi
            </a>
        </div>
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

