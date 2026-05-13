@extends('admin.layouts.app')

@section('title', 'Data Anak Asuh')
@section('page-title', 'Data Anak Asuh')
@section('page-subtitle', 'Kelola identitas anak asuh (admin & super admin)')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-children" style="margin-right:8px;color:var(--primary)"></i>
            Data Anak Asuh
        </span>
        <a href="{{ route('admin.anak-asuh.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Anak Asuh
        </a>
    </div>

    <div class="card-body" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.anak-asuh.index') }}">
            <div class="filter-bar">
                <div class="form-group">
                    <label class="form-label">Cari</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama, panggilan, asal daerah..." value="{{ $search }}">
                </div>
                <div class="form-group" style="max-width:200px;">
                    <label class="form-label">Sekolah</label>
                    <select name="sekolah" class="form-control">
                        <option value="">Semua</option>
                        <option value="1" {{ (string)$sekolah === '1' ? 'selected' : '' }}>Sedang sekolah</option>
                        <option value="0" {{ (string)$sekolah === '0' ? 'selected' : '' }}>Tidak sekolah</option>
                    </select>
                </div>
                <div class="filter-bar-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.anak-asuh.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Tempat/Tanggal Lahir</th>
                    <th>Sekolah</th>
                    <th>Asal Daerah</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td>
                        @if($item->fotoUrl())
                            <img src="{{ $item->fotoUrl() }}" alt="{{ $item->nama_lengkap }}" style="width:52px;height:52px;border-radius:12px;object-fit:cover;border:1px solid #e2e8f0;">
                        @else
                            <span class="badge badge-gray">—</span>
                        @endif
                    </td>
                    <td style="font-weight:700;">
                        {{ $item->nama_lengkap }}
                        @if($item->nama_panggilan)
                            <div style="font-weight:600;color:#64748b;font-size:12.5px;margin-top:2px;">
                                Panggilan: {{ $item->nama_panggilan }}
                            </div>
                        @endif
                    </td>
                    <td style="color:#64748b;font-size:13px;">
                        {{ $item->tempat_lahir ?: '—' }}
                        <div style="margin-top:2px;">
                            {{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d M Y') : '—' }}
                        </div>
                    </td>
                    <td style="font-size:13px;">
                        @if($item->sekolah)
                            <span class="badge badge-success">Sekolah</span>
                            @if($item->nama_sekolah)
                                <div style="margin-top:4px;color:#065f46;font-weight:600;font-size:12.5px;">
                                    {{ $item->nama_sekolah }}
                                </div>
                            @endif
                        @else
                            <span class="badge badge-warning">Tidak sekolah</span>
                        @endif
                    </td>
                    <td style="color:#64748b;font-size:13px;">
                        {{ $item->asal_daerah ?: '—' }}
                    </td>
                    <td style="color:#64748b;font-size:12.5px;">
                        {{ $item->created_at?->format('d M Y') }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <a href="{{ route('admin.anak-asuh.show', $item) }}" class="btn btn-secondary btn-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.anak-asuh.edit', $item) }}" class="btn btn-secondary btn-sm" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.anak-asuh.destroy', $item) }}" onsubmit="return confirm('Hapus data {{ $item->nama_lengkap }}?')">
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
                    <td colspan="7" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-user-graduate" style="font-size:32px;margin-bottom:10px;display:block;opacity:.6;"></i>
                        Belum ada data anak asuh.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
        <div class="pagination-wrap">
            <span>Menampilkan {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }} anak</span>
            {{ $items->links('admin.partials.pagination') }}
        </div>
    @endif
</div>

@endsection

