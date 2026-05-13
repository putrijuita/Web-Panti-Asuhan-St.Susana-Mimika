@extends('layouts.app')

@section('title', 'Jadwal Kegiatan Anak')
@section('page-title', 'Jadwal Kegiatan Anak')
@section('page-subtitle', 'Jadwal kegiatan harian anak asuh')

@push('styles')
<style>
    .schedule-hero {
        background: linear-gradient(135deg, var(--aksen-gelap) 0%, var(--biru-gelap) 40%, #0ea5e9 100%);
        border-radius: 24px;
        padding: 3rem 2rem;
        color: #fff;
        text-align: center;
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    .schedule-hero::before {
        content: '';
        position: absolute;
        inset: -40px;
        background:
            radial-gradient(circle at 30% 30%, rgba(56,189,248,0.25) 0%, transparent 55%),
            radial-gradient(circle at 80% 70%, rgba(14,165,233,0.20) 0%, transparent 60%);
        pointer-events: none;
    }
    .schedule-hero h1 { font-size: clamp(1.75rem, 4.5vw, 2.4rem); font-weight: 800; position: relative; }
    .schedule-hero p  { font-size: 1.05rem; opacity: 0.95; margin-top: .75rem; max-width: 700px; margin-left:auto; margin-right:auto; position: relative; line-height: 1.7;}

    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 18px;
        margin-bottom: 3rem;
    }

    .schedule-day {
        background: rgba(255,255,255,0.96);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 14px;
        box-shadow: 0 10px 26px rgba(8,47,73,0.05);
    }

    .schedule-day-title {
        font-family: 'Literata', Georgia, serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--biru-gelap);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .schedule-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 10px;
    }

    .schedule-item {
        border-top: 1px solid rgba(186,230,253,0.7);
        padding-top: 10px;
    }
    .schedule-item:first-child { border-top: 0; padding-top: 0; }

    .schedule-time {
        font-size: 0.86rem;
        color: #64748b;
        margin-bottom: 6px;
    }

    .schedule-title {
        font-weight: 800;
        color: var(--biru-gelap);
        line-height: 1.35;
    }

    .schedule-meta {
        margin-top: 6px;
        font-size: 0.9rem;
        color: var(--teks-muted);
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .schedule-desc {
        margin-top: 8px;
        font-size: 0.92rem;
        color: var(--teks-muted);
        line-height: 1.65;
    }

    @media (max-width: 480px) {
        .schedule-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="schedule-hero">
    <h1>Jadwal Kegiatan Anak</h1>
    <p>
        Berikut jadwal kegiatan harian yang dipublikasikan untuk keluarga.
        Informasi lengkap dikelola di panel admin.
    </p>
</div>

@php
    $hariUrut = array_keys($hariOptions);
    // Pastikan urutan konsisten jika keys berubah
    $hariUrut = ['setiap_hari','senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
@endphp

<div class="schedule-grid">
    @foreach($hariUrut as $kunciHari)
        @php
            $items = $jadwalByHari[$kunciHari] ?? collect();
        @endphp
        @if($items->isEmpty())
            @continue
        @endif

        <section class="schedule-day">
            <div class="schedule-day-title">
                <i class="fas fa-calendar-days" style="color:var(--aksen);"></i>
                {{ $hariOptions[$kunciHari] ?? ucfirst(str_replace('_',' ', $kunciHari)) }}
            </div>

            <ul class="schedule-list">
                @foreach($items as $row)
                    <li class="schedule-item">
                        @php
                            $timeText = '—';
                            if($row->jam_mulai && $row->jam_selesai) {
                                $timeText = substr($row->jam_mulai, 0, 5).'–'.substr($row->jam_selesai, 0, 5);
                            } elseif($row->jam_mulai) {
                                $timeText = substr($row->jam_mulai, 0, 5);
                            }
                        @endphp
                        <div class="schedule-time">{{ $timeText }}</div>
                        <div class="schedule-title">{{ $row->judul }}</div>
                        <div class="schedule-meta">
                            @if(!empty($row->kategori))
                                <span><i class="fas fa-tag" style="color:var(--aksen);margin-right:6px;"></i>{{ $row->kategori }}</span>
                            @endif
                            @if(!empty($row->lokasi))
                                <span><i class="fas fa-location-dot" style="color:var(--aksen);margin-right:6px;"></i>{{ $row->lokasi }}</span>
                            @endif
                        </div>
                        @if(!empty($row->deskripsi))
                            <div class="schedule-desc">{{ $row->deskripsi }}</div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </section>
    @endforeach
</div>
@endsection

