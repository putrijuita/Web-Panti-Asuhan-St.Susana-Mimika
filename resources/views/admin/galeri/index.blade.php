@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')
@section('page-title', 'Dashboard Galeri Foto')
@section('page-subtitle', 'Kelola foto-foto yang tampil di halaman galeri user')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <span class="card-title">
                <i class="fas fa-images" style="color:#1e40af;margin-right:8px;"></i>
                Dashboard Galeri Foto
            </span>
            <div style="font-size:12px;color:#64748b;margin-top:2px;">
                Kelola kategori dan foto yang tampil di halaman galeri user.
            </div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('admin.galeri.categories.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-tags"></i> Tambah Kategori
            </a>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Galeri
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-photo-film" style="color:#1e40af;margin-right:8px;"></i>
            Daftar Foto Galeri
        </span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Keterangan</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td style="color:#94a3b8;font-size:12px;">{{ $items->firstItem() + $loop->index }}</td>
                        <td style="font-weight:600;font-size:13.5px;">{{ $item->nama }}</td>
                        <td style="font-size:12.5px;color:#0f172a;">
                            {{ $item->kategori?->nama ?? '-' }}
                        </td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}" style="height:60px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
                            @else
                                <span style="color:#cbd5e1;">Tidak ada</span>
                            @endif
                        </td>
                        <td style="font-size:12.5px;color:#64748b;max-width:260px;">
                            {{ \Illuminate\Support\Str::limit($item->keterangan, 80) ?: '-' }}
                        </td>
                        <td style="font-size:12px;color:#64748b;">
                            {{ $item->created_at?->format('d M Y') ?? '-' }}
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.galeri.edit', $item) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini dari galeri?')">
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
                            Belum ada foto galeri
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
        <div class="pagination-wrap">
            <span>Menampilkan {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }} foto</span>
            {{ $items->links('admin.partials.pagination') }}
        </div>
    @endif
</div>

@endsection

