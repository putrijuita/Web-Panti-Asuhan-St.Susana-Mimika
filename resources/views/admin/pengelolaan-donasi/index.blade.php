@extends('admin.layouts.app')

@section('title', 'Pengelolaan Donasi')
@section('page-title', 'Pengelolaan Donasi')
@section('page-subtitle', 'Kelola data pengeluaran donasi dan bukti penggunaan dana')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <span class="card-title">
                <i class="fas fa-wallet" style="color:#059669;margin-right:8px;"></i>
                Dashboard Pengelolaan Donasi
            </span>
            <div style="font-size:12px;color:#64748b;margin-top:2px;">
                Tambah dan kelola catatan pengeluaran donasi beserta bukti.
            </div>
        </div>
        <a href="{{ route('admin.pengelolaan-donasi.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Pengelolaan Donasi
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-table" style="color:#059669;margin-right:8px;"></i>
            Tabel Pengelolaan Donasi
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Gambar</th>
                    <th>Tanggal / Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td style="font-weight:600;">{{ $item->nama }}</td>
                        <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            @if($item->gambar)
                                <a href="{{ asset('storage/'.$item->gambar) }}" target="_blank" rel="noopener" style="display:inline-block;">
                                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}" style="height:50px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
                                </a>
                            @else
                                <span style="color:#94a3b8;">—</span>
                            @endif
                        </td>
                        <td>{{ $item->tanggal_waktu->format('d/m/Y H:i') }}</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.pengelolaan-donasi.edit', $item) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.pengelolaan-donasi.destroy', $item) }}" onsubmit="return confirm('Hapus data pengelolaan donasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:40px;color:#94a3b8;">
                            <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                            Belum ada data pengelolaan donasi. Klik <strong>Tambah Pengelolaan Donasi</strong> untuk menambah.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
        <div class="pagination-wrap">
            <span>Menampilkan {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }}</span>
            {{ $items->links('admin.partials.pagination') }}
        </div>
    @endif
</div>

@endsection
