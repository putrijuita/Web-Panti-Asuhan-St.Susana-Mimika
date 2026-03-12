@extends('admin.layouts.app')

@section('title', 'Detail Program')
@section('page-title', 'Detail Program')
@section('page-subtitle', 'Informasi lengkap program')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-info-circle" style="color:#2563eb;margin-right:8px;"></i>
            Detail Program
        </span>
    </div>
    <div class="card-body" style="display:grid;grid-template-columns:1.2fr 2fr;gap:24px;align-items:flex-start;">
        <div>
            @if($kegiatan->gambar)
                <img src="{{ asset('storage/'.$kegiatan->gambar) }}" alt="{{ $kegiatan->nama }}"
                     style="width:100%;max-height:260px;object-fit:cover;border-radius:14px;border:1px solid #e2e8f0;">
            @else
                <div style="width:100%;height:220px;border-radius:14px;border:1px dashed #cbd5f5;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:13px;">
                    Tidak ada gambar
                </div>
            @endif
        </div>
        <div>
            <h2 style="font-size:20px;font-weight:700;color:#0f172a;margin-bottom:6px;">
                {{ $kegiatan->nama }}
            </h2>
            <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;">
                @if($kegiatan->kategori)
                    <span class="badge badge-purple">{{ $kegiatan->kategori->nama }}</span>
                @else
                    <span class="badge badge-gray">Tanpa Kategori</span>
                @endif
                @if($kegiatan->waktu_kegiatan)
                    <span class="badge badge-info">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $kegiatan->waktu_kegiatan->format('d M Y H:i') }}
                    </span>
                @endif
            </div>

            <div style="font-size:13px;color:#64748b;line-height:1.7;white-space:pre-line;">
                {{ $kegiatan->deskripsi ?: 'Belum ada deskripsi program.' }}
            </div>

            <div style="margin-top:18px;display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-pen"></i> Edit
                </a>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali ke Program
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

