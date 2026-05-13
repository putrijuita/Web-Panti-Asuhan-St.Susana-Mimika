@extends('admin.layouts.app')

@section('title', 'Detail Jadwal Kegiatan Anak')
@section('page-title', 'Detail Jadwal Kegiatan Anak')
@section('page-subtitle', 'Tampilan lengkap jadwal kegiatan anak')

@section('content')
<div style="display:flex;gap:20px;flex-wrap:wrap;">
    <div style="flex:2;min-width:280px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-eye" style="color:var(--primary);margin-right:8px;"></i>
                    Detail Jadwal
                </span>
                <a href="{{ route('admin.jadwal-anak.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Judul</label>
                    <div style="font-weight:800;font-size:16px;color:var(--gray-900);">{{ $jadwal->judul }}</div>
                </div>
                <div class="admin-grid-2">
                    <div class="form-group">
                        <label class="form-label">Hari</label>
                        <div style="font-size:14px;color:#0f172a;">
                            {{ $hariOptions[$jadwal->hari] ?? ucfirst($jadwal->hari) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan</label>
                        <div style="font-size:14px;color:#0f172a;">{{ $jadwal->urutan }}</div>
                    </div>
                </div>
                <div class="admin-grid-2">
                    <div class="form-group">
                        <label class="form-label">Jam</label>
                        <div style="font-size:14px;color:#0f172a;">
                            @if($jadwal->jam_mulai && $jadwal->jam_selesai)
                                {{ substr($jadwal->jam_mulai, 0, 5) }}–{{ substr($jadwal->jam_selesai, 0, 5) }}
                            @elseif($jadwal->jam_mulai)
                                {{ substr($jadwal->jam_mulai, 0, 5) }}
                            @else
                                —
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <div style="font-size:14px;color:#0f172a;">{{ $jadwal->kategori ?: '—' }}</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <div style="font-size:14px;color:#0f172a;">{{ $jadwal->lokasi ?: '—' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status tampil</label>
                    <div>
                        @if($jadwal->aktif)
                            <span class="badge badge-success">Aktif (dipublikasikan)</span>
                        @else
                            <span class="badge badge-gray">Nonaktif</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <div style="font-size:13.5px;color:#0f172a;white-space:pre-wrap;line-height:1.6;">
                        {{ $jadwal->deskripsi ?: '—' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="flex:1;min-width:240px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-edit" style="color:#8b5cf6;margin-right:8px;"></i>
                    Aksi
                </span>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.jadwal-anak.edit', $jadwal) }}" class="btn btn-secondary" style="width:100%;justify-content:center;">
                    <i class="fas fa-pen"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.jadwal-anak.destroy', $jadwal) }}" onsubmit="return confirm('Hapus jadwal ini?')" style="margin-top:14px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
                <div style="margin-top:16px;padding-top:14px;border-top:1px solid var(--gray-100);color:var(--gray-500);font-size:12.5px;">
                    Dibuat: {{ $jadwal->created_at?->format('d M Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

