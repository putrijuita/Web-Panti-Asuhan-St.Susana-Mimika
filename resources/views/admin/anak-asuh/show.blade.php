@extends('admin.layouts.app')

@section('title', 'Detail Anak Asuh')
@section('page-title', 'Detail Anak Asuh')
@section('page-subtitle', 'Tampilan lengkap data anak asuh (internal)')

@section('content')
<div style="display:flex;gap:20px;flex-wrap:wrap;">
    <div style="flex:2;min-width:280px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fas fa-eye" style="color:var(--primary);margin-right:8px;"></i>
                    Detail Anak Asuh
                </span>
                <a href="{{ route('admin.anak-asuh.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <div style="display:flex;gap:18px;flex-wrap:wrap;align-items:flex-start;">
                    <div>
                        @if($item->fotoUrl())
                            <img src="{{ $item->fotoUrl() }}" alt="{{ $item->nama_lengkap }}" style="width:160px;height:160px;object-fit:cover;border-radius:18px;border:1px solid #e2e8f0;">
                        @else
                            <div style="width:160px;height:160px;border-radius:18px;border:1px dashed #cbd5e1;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                                Tidak ada foto
                            </div>
                        @endif
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div class="form-group">
                            <label class="form-label">Nama lengkap</label>
                            <div style="font-weight:800;font-size:15px;color:var(--gray-900);">{{ $item->nama_lengkap }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama panggilan</label>
                            <div style="font-size:14px;color:#0f172a;">{{ $item->nama_panggilan ?: '—' }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tempat / tanggal lahir</label>
                            <div style="font-size:14px;color:#0f172a;">
                                {{ $item->tempat_lahir ?: '—' }}
                                @if($item->tanggal_lahir)
                                    <div style="margin-top:2px;color:#64748b;">
                                        {{ $item->tanggal_lahir->format('d M Y') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sekolah</label>
                            <div style="font-size:14px;color:#0f172a;">
                                @if($item->sekolah)
                                    <span class="badge badge-success">Sedang sekolah</span>
                                    @if($item->nama_sekolah)
                                        <div style="margin-top:6px;color:#065f46;font-weight:700;">
                                            {{ $item->nama_sekolah }}
                                        </div>
                                    @endif
                                @else
                                    <span class="badge badge-warning">Tidak sekolah</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat darimana</label>
                            <div style="font-size:14px;color:#0f172a;">{{ $item->asal_daerah ?: '—' }}</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:20px;">
                    <div class="form-group">
                        <label class="form-label">Alamat rincian (internal)</label>
                        <div style="font-size:13.5px;color:#0f172a;white-space:pre-wrap;line-height:1.6;">
                            {{ $item->alamat_detail ?: '—' }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Catatan (internal)</label>
                        <div style="font-size:13.5px;color:#0f172a;white-space:pre-wrap;line-height:1.6;">
                            {{ $item->catatan ?: '—' }}
                        </div>
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
                <a href="{{ route('admin.anak-asuh.edit', $item) }}" class="btn btn-secondary" style="width:100%;justify-content:center;">
                    <i class="fas fa-pen"></i> Edit Data
                </a>

                <form method="POST" action="{{ route('admin.anak-asuh.destroy', $item) }}" onsubmit="return confirm('Hapus data ini?')" style="margin-top:14px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>

                <div style="margin-top:16px;padding-top:14px;border-top:1px solid var(--gray-100);color:var(--gray-500);font-size:12.5px;">
                    Dibuat: {{ $item->created_at?->format('d M Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

