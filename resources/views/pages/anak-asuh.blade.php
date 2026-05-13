@extends('layouts.app')

@section('title', 'Anak Asuh')
@section('page-title', 'Anak Asuh')
@section('page-subtitle', 'Daftar anak asuh yang sedang dibina')

@push('styles')
<style>
    .child-hero {
        background: linear-gradient(135deg, var(--biru-gelap) 0%, var(--biru-tua) 60%, #0ea5e9 100%);
        border-radius: 24px;
        padding: 3rem 2rem;
        color: #fff;
        text-align: center;
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    .child-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 20% 30%, rgba(255,255,255,0.12) 0%, transparent 55%),
            radial-gradient(circle at 90% 70%, rgba(56,189,248,0.18) 0%, transparent 55%);
        pointer-events: none;
    }
    .child-hero h1 { font-size: clamp(1.75rem, 4.5vw, 2.4rem); font-weight: 800; position: relative; }
    .child-hero p  { font-size: 1.05rem; opacity: 0.95; margin-top: .75rem; max-width: 640px; margin-left:auto; margin-right:auto; position: relative; line-height: 1.7;}

    .child-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
        gap: 18px;
        margin-bottom: 2.5rem;
    }
    .child-card {
        background: rgba(255,255,255,0.96);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 14px;
        box-shadow: 0 10px 26px rgba(8, 47, 73, 0.05);
        transition: transform .2s ease, box-shadow .2s ease;
        text-align: center;
        overflow: hidden;
    }
    .child-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(8, 47, 73, 0.09);
    }
    .child-avatar {
        width: 88px;
        height: 88px;
        border-radius: 999px;
        margin: 2px auto 10px;
        overflow: hidden;
        border: 2px solid rgba(56,189,248,0.35);
        background: linear-gradient(135deg, rgba(14,165,233,0.12), rgba(61,122,82,0.10));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        color: var(--biru-gelap);
    }
    .child-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .child-name {
        font-family: 'Literata', Georgia, serif;
        font-size: 1.05rem;
        font-weight: 800;
        margin-top: 6px;
        color: var(--biru-gelap);
    }
    .child-sub {
        margin-top: 6px;
        color: var(--teks-muted);
        font-size: 0.92rem;
        line-height: 1.45;
    }
    .child-empty {
        text-align: center;
        color: var(--teks-muted);
        padding: 28px 12px;
        border: 1px dashed rgba(148,163,184,0.5);
        border-radius: 18px;
        background: rgba(255,255,255,0.65);
    }
</style>
@endpush

@section('content')
<div class="child-hero">
    <h1>Data Anak Asuh</h1>
    <p>Berikut foto dan nama panggilan anak asuh. Data detail internal disimpan di panel admin.</p>
</div>

<div class="child-grid">
    @forelse($anak as $row)
        @php
            $displayName = $row->nama_panggilan ?: $row->nama_lengkap;
        @endphp
        <article class="child-card">
            <div class="child-avatar">
                @if($row->fotoUrl())
                    <img src="{{ $row->fotoUrl() }}" alt="{{ $displayName }}">
                @else
                    <i class="fas fa-child" aria-hidden="true"></i>
                @endif
            </div>
            <div class="child-name">{{ $displayName }}</div>
            @if(!empty($row->asal_daerah))
                <div class="child-sub">Asal: {{ $row->asal_daerah }}</div>
            @endif
        </article>
    @empty
        <div class="child-empty" style="grid-column: 1 / -1;">
            <i class="fas fa-children" style="font-size:34px;margin-bottom:10px;display:block;opacity:.65;"></i>
            Data anak asuh belum tersedia.
        </div>
    @endforelse
</div>
@endsection

