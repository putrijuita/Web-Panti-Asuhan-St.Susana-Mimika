@extends('admin.layouts.app')

@section('title', 'Program')
@section('page-title', 'Dashboard Program')
@section('page-subtitle', 'Kelola daftar program yang tampil di halaman user')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-body" style="padding:16px 20px;display:flex;flex-wrap:wrap;gap:12px;justify-content:space-between;align-items:center;">
        <div>
            <div style="font-size:14px;font-weight:600;color:#0f172a;margin-bottom:4px;">Program</div>
            <div style="font-size:12px;color:#64748b;">Tambahkan program baru yang akan tampil di halaman program pengunjung.</div>
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Program
            </a>
            <a href="{{ route('admin.kegiatan.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-tags"></i> Kelola Kategori
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-list-check" style="color:#1e40af;margin-right:8px;"></i>
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
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" style="height:60px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
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

