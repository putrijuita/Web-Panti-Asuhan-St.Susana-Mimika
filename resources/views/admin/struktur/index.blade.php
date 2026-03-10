@extends('admin.layouts.app')

@section('title', 'Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')
@section('page-subtitle', 'Kelola struktur organisasi Panti Asuhan')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-sitemap" style="color:#1e40af;margin-right:8px;"></i>
            Struktur Organisasi
        </span>
        <a href="{{ route('admin.struktur.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle"></i>
            Tambah Struktur
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Jabatan / Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td style="color:#94a3b8;font-size:12px;">{{ $items->firstItem() + $loop->index }}</td>
                    <td>
                        @if($item->gambar_path)
                            <img src="{{ asset('storage/'.$item->gambar_path) }}" alt="{{ $item->nama }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                        @else
                            <span class="badge badge-gray">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td style="font-weight:600;font-size:13.5px;">
                        {{ $item->nama }}
                    </td>
                    <td style="font-size:13px;color:#64748b;">
                        {{ $item->jabatan }}
                    </td>
                    <td style="font-size:12px;color:#94a3b8;">
                        {{ $item->created_at?->format('d M Y') }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.struktur.show', $item) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.struktur.edit', $item) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.struktur.destroy', $item) }}" onsubmit="return confirm('Hapus data struktur ini?')">
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
                        Belum ada data struktur organisasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }} struktur</span>
        {{ $items->links('admin.partials.pagination') }}
    </div>
    @endif
</div>

@endsection

