@extends('admin.layouts.app')

@section('title', 'Detail Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')
@section('page-subtitle', 'Detail data struktur organisasi')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-eye" style="color:#1e40af;margin-right:8px;"></i>
            Detail Struktur Organisasi
        </span>
    </div>
    <div class="card-body">
        <div style="display:flex;gap:24px;flex-wrap:wrap;align-items:flex-start;">
            <div>
                @if($struktur->gambar_path)
                    <img src="{{ asset('storage/'.$struktur->gambar_path) }}" alt="{{ $struktur->nama }}" style="width:160px;height:160px;object-fit:cover;border-radius:16px;border:1px solid #e2e8f0;">
                @else
                    <div style="width:160px;height:160px;border-radius:16px;border:1px dashed #cbd5e1;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                        Tidak ada gambar
                    </div>
                @endif
            </div>
            <div style="flex:1;min-width:220px;">
                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <div style="font-weight:600;font-size:14px;">{{ $struktur->nama }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status / Jabatan</label>
                    <div style="font-size:14px;color:#0f172a;">{{ $struktur->jabatan }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Dibuat</label>
                    <div style="font-size:13px;color:#64748b;">{{ $struktur->created_at?->format('d M Y H:i') }}</div>
                </div>
            </div>
        </div>

        <div style="margin-top:20px;display:flex;gap:10px;flex-wrap:wrap;">
            <a href="{{ route('admin.struktur.edit', $struktur) }}" class="btn btn-secondary">
                <i class="fas fa-pen"></i> Edit
            </a>
            <form method="POST" action="{{ route('admin.struktur.destroy', $struktur) }}" onsubmit="return confirm('Hapus data struktur ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
            <a href="{{ route('admin.struktur.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

@endsection

