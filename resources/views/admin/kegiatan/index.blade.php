@extends('admin.layouts.app')

@section('title', 'Program')
@section('page-title', 'Dashboard Program')
@section('page-subtitle', 'Kelola daftar program yang tampil di halaman user')

@section('content')

@if(session('success'))
    <div class="alert alert-success" style="margin-bottom:20px;">{{ session('success') }}</div>
@endif

{{-- Section Program Unggulan - Kartu --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-star" style="color:#eab308;margin-right:8px;"></i>
            Program Unggulan
        </span>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;">
            @forelse($programUnggulan as $p)
            <div style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #e2e8f0;">
                @if($p->gambar)
                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->nama }}" style="width:100%;height:140px;object-fit:cover;">
                @else
                    <div style="width:100%;height:140px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:12px;">Tanpa gambar</div>
                @endif
                <div style="padding:12px 14px;">
                    <div style="font-weight:600;font-size:14px;color:#0f172a;margin-bottom:6px;">{{ $p->nama }}</div>
                    <div style="font-size:12px;color:#64748b;line-height:1.5;">{{ \Illuminate\Support\Str::limit($p->deskripsi, 100) ?: '—' }}</div>
                </div>
            </div>
            @empty
            <p style="color:#94a3b8;font-size:13px;grid-column:1/-1;">Belum ada program unggulan.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Tombol Tambah Program --}}
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

{{-- Tabel Program: Nama, Gambar, Aksi --}}
<div class="card" style="margin-bottom:20px;">
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
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan as $item)
                <tr>
                    <td style="font-weight:600;font-size:13.5px;">{{ $item->nama }}</td>
                    <td style="font-size:12px;">
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama }}" style="height:50px;width:auto;border-radius:8px;object-fit:cover;border:1px solid #e2e8f0;">
                        @else
                            <span style="color:#cbd5e1;">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.kegiatan.show', $item) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.kegiatan.edit', $item) }}" class="btn btn-secondary btn-sm" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}" onsubmit="return confirm('Hapus program ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center;padding:40px;color:#94a3b8;">
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

{{-- Section Program Lainnya - Kartu --}}
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-list" style="color:#0ea5e9;margin-right:8px;"></i>
            Program Lainnya
        </span>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;">
            @forelse($programLainnya as $p)
            <div style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #e2e8f0;">
                @if($p->gambar)
                    <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->nama }}" style="width:100%;height:140px;object-fit:cover;">
                @else
                    <div style="width:100%;height:140px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:12px;">Tanpa gambar</div>
                @endif
                <div style="padding:12px 14px;">
                    <div style="font-weight:600;font-size:14px;color:#0f172a;margin-bottom:6px;">{{ $p->nama }}</div>
                    <div style="font-size:12px;color:#64748b;line-height:1.5;">{{ \Illuminate\Support\Str::limit($p->deskripsi, 100) ?: '—' }}</div>
                </div>
            </div>
            @empty
            <p style="color:#94a3b8;font-size:13px;grid-column:1/-1;">Belum ada program lainnya.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
