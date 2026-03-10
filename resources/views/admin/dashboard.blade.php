@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data & aktivitas terkini')

@push('styles')
<style>
    .grid-2 { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
    @media (max-width: 1024px) { .grid-2 { grid-template-columns: 1fr; } }
    .recent-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .recent-item:last-child { border-bottom: none; }
    .recent-avatar {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }
    .recent-info { flex: 1; overflow: hidden; }
    .recent-info strong { display: block; font-size: 13px; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .recent-info span { font-size: 11.5px; color: #64748b; }
    .recent-amount { font-size: 13px; font-weight: 600; color: #059669; white-space: nowrap; }
</style>
@endpush

@section('content')

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-hand-holding-heart"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_donasi'] }}</div>
            <div class="stat-label">Total Donasi Uang</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-value">{{ $stats['donasi_lunas'] }}</div>
            <div class="stat-label">Donasi Berhasil</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-rupiah-sign"></i></div>
        <div>
            <div class="stat-value" style="font-size:18px;">
                Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}
            </div>
            <div class="stat-label">Total Dana Terkumpul</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon teal"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_kunjungan'] }}</div>
            <div class="stat-label">Total Kunjungan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fas fa-clock"></i></div>
        <div>
            <div class="stat-value">{{ $stats['kunjungan_pending'] }}</div>
            <div class="stat-label">Kunjungan Menunggu</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-hands-helping"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_donasi_jasa'] }}</div>
            <div class="stat-label">Donasi Jasa</div>
        </div>
    </div>
</div>

<!-- Charts & Recent -->
<div class="grid-2">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-chart-bar" style="color:#3b82f6;margin-right:8px;"></i>Donasi Uang 6 Bulan Terakhir</span>
        </div>
        <div class="card-body">
            <canvas id="donasiChart" height="90"></canvas>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-chart-pie" style="color:#8b5cf6;margin-right:8px;"></i>Status Kunjungan</span>
        </div>
        <div class="card-body">
            <canvas id="kunjunganChart" height="140"></canvas>
            <div style="margin-top:16px;display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                <div style="background:#fef3c7;border-radius:8px;padding:10px;text-align:center;">
                    <div style="font-size:22px;font-weight:700;color:#b45309;">{{ $stats['kunjungan_pending'] }}</div>
                    <div style="font-size:11px;color:#92400e;">Pending</div>
                </div>
                <div style="background:#d1fae5;border-radius:8px;padding:10px;text-align:center;">
                    <div style="font-size:22px;font-weight:700;color:#065f46;">{{ $stats['kunjungan_approved'] }}</div>
                    <div style="font-size:11px;color:#047857;">Disetujui</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Tables -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:20px;">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-hand-holding-heart" style="color:#3b82f6;margin-right:8px;"></i>Donasi Terbaru</span>
            <a href="{{ route('admin.donasi.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="card-body" style="padding:16px 20px;">
            @forelse($donasi_terbaru as $d)
            <div class="recent-item">
                <div class="recent-avatar" style="background:#dbeafe;color:#1d4ed8;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="recent-info">
                    <strong>{{ $d->nama }}</strong>
                    <span>{{ $d->created_at->diffForHumans() }}</span>
                </div>
                <div>
                    <div class="recent-amount">Rp {{ number_format($d->nominal, 0, ',', '.') }}</div>
                    @php
                        $statusClass = match($d->status) {
                            'settlement','completed' => 'badge-success',
                            'pending','capture' => 'badge-warning',
                            'cancel','expire','failure','deny' => 'badge-danger',
                            default => 'badge-gray'
                        };
                    @endphp
                    <span class="badge {{ $statusClass }}" style="margin-top:2px;">{{ $d->status }}</span>
                </div>
            </div>
            @empty
            <p style="color:#94a3b8;font-size:13px;text-align:center;padding:20px 0;">Belum ada donasi</p>
            @endforelse
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <span class="card-title"><i class="fas fa-calendar-check" style="color:#0d9488;margin-right:8px;"></i>Kunjungan Terbaru</span>
            <a href="{{ route('admin.kunjungan.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="card-body" style="padding:16px 20px;">
            @forelse($kunjungan_terbaru as $k)
            <div class="recent-item">
                <div class="recent-avatar" style="background:#ccfbf1;color:#0f766e;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="recent-info">
                    <strong>{{ $k->nama }}</strong>
                    <span>{{ $k->tanggal_kunjungan }} · {{ $k->instansi ?? 'Perorangan' }}</span>
                </div>
                <div>
                    @php
                        $kClass = match($k->status) {
                            'approved' => 'badge-success',
                            'pending' => 'badge-warning',
                            'rejected' => 'badge-danger',
                            'completed' => 'badge-info',
                            default => 'badge-gray'
                        };
                    @endphp
                    <span class="badge {{ $kClass }}">{{ ucfirst($k->status) }}</span>
                </div>
            </div>
            @empty
            <p style="color:#94a3b8;font-size:13px;text-align:center;padding:20px 0;">Belum ada kunjungan</p>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const donasiData = @json($donasi_per_bulan);
const labels = donasiData.map(d => {
    const [y, m] = d.bulan.split('-');
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    return months[parseInt(m) - 1] + ' ' + y;
});
const values = donasiData.map(d => parseFloat(d.total));

new Chart(document.getElementById('donasiChart'), {
    type: 'bar',
    data: {
        labels: labels.length ? labels : ['Belum ada data'],
        datasets: [{
            label: 'Total Donasi (Rp)',
            data: values.length ? values : [0],
            backgroundColor: 'rgba(37,99,235,.8)',
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                }
            }
        },
        scales: {
            y: {
                grid: { color: '#f1f5f9' },
                ticks: {
                    callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'jt',
                    font: { size: 11 }
                }
            },
            x: {
                grid: { display: false },
                ticks: { font: { size: 11 } }
            }
        }
    }
});

new Chart(document.getElementById('kunjunganChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Disetujui', 'Selesai', 'Ditolak'],
        datasets: [{
            data: [
                {{ $stats['kunjungan_pending'] }},
                {{ $stats['kunjungan_approved'] }},
                {{ $stats['kunjungan_completed'] }},
                {{ $stats['kunjungan_rejected'] }},
            ],
            backgroundColor: ['#fbbf24','#10b981','#3b82f6','#ef4444'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: { font: { size: 11 }, padding: 10 }
            }
        }
    }
});
</script>
@endpush

@endsection
