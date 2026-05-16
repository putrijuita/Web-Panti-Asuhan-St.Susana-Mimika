@php
    $hariUrut = ['setiap_hari', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
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
                <i class="fas fa-calendar-days" style="color:var(--aksen);" aria-hidden="true"></i>
                {{ $hariOptions[$kunciHari] ?? ucfirst(str_replace('_', ' ', $kunciHari)) }}
            </div>

            <ul class="schedule-list">
                @foreach($items as $row)
                    <li class="schedule-item">
                        @php
                            $timeText = '—';
                            if ($row->jam_mulai && $row->jam_selesai) {
                                $timeText = substr($row->jam_mulai, 0, 5).'–'.substr($row->jam_selesai, 0, 5);
                            } elseif ($row->jam_mulai) {
                                $timeText = substr($row->jam_mulai, 0, 5);
                            }
                        @endphp
                        <div class="schedule-time">{{ $timeText }}</div>
                        <div class="schedule-title">{{ $row->judul }}</div>
                        <div class="schedule-meta">
                            @if(!empty($row->kategori))
                                <span><i class="fas fa-tag" style="color:var(--aksen);margin-right:6px;" aria-hidden="true"></i>{{ $row->kategori }}</span>
                            @endif
                            @if(!empty($row->lokasi))
                                <span><i class="fas fa-location-dot" style="color:var(--aksen);margin-right:6px;" aria-hidden="true"></i>{{ $row->lokasi }}</span>
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
