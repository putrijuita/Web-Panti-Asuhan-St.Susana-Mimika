@extends('layouts.app')

@section('title', 'Program Unggulan - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.program-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}
.program-card-simple {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    display: flex;
    flex-direction: column;
}
.program-card-simple:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.10);
}
.program-card-simple img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
.program-card-body {
    padding: 1.25rem 1.5rem 1.5rem;
}
.program-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}
.program-card-desc {
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.6;
}
</style>
@endpush

@section('content')
<div class="program-hero">
    <h1>Program Unggulan</h1>
    <p>Kumpulan program utama yang menjadi fokus pelayanan dan pengembangan anak-anak di Panti Asuhan Santa Susana Timika.</p>
</div>

<div class="section-label"><i class="fas fa-star"></i> Program Unggulan</div>
<h2 class="section-head">Daftar Program Unggulan</h2>

<div class="program-grid">
    @forelse($programs as $program)
        <div class="program-card-simple">
            @if($program->gambar)
                <img src="{{ asset('storage/'.$program->gambar) }}" alt="{{ $program->nama }}">
            @endif
            <div class="program-card-body">
                <div class="program-card-title">{{ $program->nama }}</div>
                <div class="program-card-desc">
                    {{ \Illuminate\Support\Str::limit($program->deskripsi, 160) ?: 'Belum ada deskripsi.' }}
                </div>
            </div>
        </div>
    @empty
        <p style="color:#94a3b8;font-size:0.95rem;">Belum ada program unggulan yang ditambahkan.</p>
    @endforelse
</div>
@endsection

