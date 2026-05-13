@extends('admin.layouts.app')

@section('title', 'Jadwal Kegiatan Anak')
@section('page-title', 'Jadwal Kegiatan Anak')
@section('page-subtitle', 'Kelola jadwal harian kegiatan anak asuh (publik & admin)')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-clock" style="margin-right:8px;color:var(--primary)"></i>
            Jadwal Kegiatan Anak
        </span>
        <a href="{{ route('admin.jadwal-anak.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>

    <div class="card-body" style="padding:16px 20px;">
        <form method="GET" action="{{ route('admin.jadwal-anak.index') }}">
            <div class="filter-bar">
                <div class="form-group">
                    <label class="form-label">Cari</label>
                    <input type="text" name="search" class="form-control" placeholder="Judul, kategori, lokasi..." value="{{ $search }}">
                </div>
                <div class="form-group" style="max-width:200px;">
                    <label class="form-label">Hari</label>
                    <select name="hari" class="form-control">
                        <option value="">Semua</option>
                        @foreach($hariOptions as $key => $label)
                            <option value="{{ $key }}" {{ $hari === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="max-width:180px;">
                    <label class="form-label">Status</label>
                    <select name="aktif" class="form-control">
                        <option value="">Semua</option>
                        <option value="1" {{ (string)$aktif === '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ (string)$aktif === '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="filter-bar-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.jadwal-anak.index') }}" class="btn btn-secondary">
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
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($items as $row)
                <tr>
                    <td style="font-size:13px;color:#0f172a;font-weight:700;">
                        {{ $hariOptions[$row->hari] ?? ucfirst($row->hari) }}
                    </td>
                    <td style="font-size:13px;color:#64748b;">
                        @php
                            $timeText = '—';
                            if($row->jam_mulai && $row->jam_selesai) {
                                $timeText = substr($row->jam_mulai, 0, 5).'–'.substr($row->jam_selesai, 0, 5);
                            } elseif($row->jam_mulai) {
                                $timeText = substr($row->jam_mulai, 0, 5);
                            }
                        @endphp
                        {{ $timeText }}
                    </td>
                    <td style="font-weight:700;font-size:13.5px;">
                        {{ $row->judul }}
                    </td>
                    <td style="font-size:13px;color:#64748b;">
                        {{ $row->kategori ?: '—' }}
                    </td>
                    <td style="font-size:13px;color:#64748b;">
                        {{ $row->lokasi ?: '—' }}
                    </td>
                    <td>
                        @if($row->aktif)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-gray">Nonaktif</span>
                        @endif
                    </td>
                    <td style="font-size:13px;color:#64748b;">
                        {{ $row->urutan }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            <a href="{{ route('admin.jadwal-anak.show', $row) }}" class="btn btn-secondary btn-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.jadwal-anak.edit', $row) }}" class="btn btn-secondary btn-sm" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.jadwal-anak.destroy', $row) }}" onsubmit="return confirm('Hapus jadwal ini?')" style="display:inline;">
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
                    <td colspan="8" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-clock" style="font-size:32px;margin-bottom:10px;display:block;opacity:.6;"></i>
                        Belum ada jadwal kegiatan.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
        <div class="pagination-wrap">
            <span>Menampilkan {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }} jadwal</span>
            {{ $items->links('admin.partials.pagination') }}
        </div>
    @endif
</div>

@endsection

