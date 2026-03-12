@extends('layouts.app')

@section('title', 'Donasi - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
/* ── Hero ── */
.donasi-hero {
    position: relative;
    text-align: center;
    padding: 4.5rem 2rem 3rem;
    overflow: hidden;
    margin-bottom: 3rem;
}
.donasi-hero::before {
    content: '';
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse at 15% 50%, rgba(220,38,38,0.12) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 50%, rgba(16,185,129,0.12) 0%, transparent 55%);
    pointer-events: none;
}
.hero-badge-wrap { display: flex; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
.hero-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    padding: 0.4rem 1rem; border-radius: 50px;
    font-size: 0.82rem; font-weight: 700;
}
.badge-red   { background: #FEE2E2; color: #DC2626; }
.badge-green { background: #D1FAE5; color: #059669; }
.donasi-hero h1 {
    font-size: clamp(2.2rem, 5.5vw, 3.5rem);
    font-weight: 800;
    color: var(--biru-gelap);
    line-height: 1.15;
    margin-bottom: 1.25rem;
}
.donasi-hero h1 .highlight-red   { color: #DC2626; }
.donasi-hero h1 .highlight-green { color: #059669; }
.donasi-hero p {
    font-size: 1.15rem; color: #64748B;
    max-width: 580px; margin: 0 auto 2.5rem;
    line-height: 1.7;
}

/* ── Divider Animated ── */
.divider-or {
    display: flex; align-items: center; gap: 1rem;
    margin: 2.5rem 0;
    color: #94A3B8; font-weight: 700; font-size: 0.9rem;
}
.divider-or::before, .divider-or::after {
    content: ''; flex: 1;
    height: 1px; background: linear-gradient(90deg, transparent, #CBD5E1, transparent);
}

/* ── Split Cards ── */
.split-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}
.split-card {
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 8px 48px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    position: relative;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
}
.split-card:hover {
    transform: translateY(-10px) scale(1.01);
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}
.split-card-top {
    padding: 3rem 2.5rem 2.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    min-height: 260px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.split-card-top::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 30% 70%, rgba(255,255,255,0.12) 0%, transparent 60%);
}
.card-emoji {
    font-size: 5rem;
    margin-bottom: 1rem;
    position: relative;
    display: block;
    filter: drop-shadow(0 8px 16px rgba(0,0,0,0.15));
    transition: transform 0.4s;
}
.split-card:hover .card-emoji { transform: scale(1.15) rotate(-5deg); }
.card-type-label {
    display: inline-block;
    background: rgba(255,255,255,0.25);
    color: white;
    padding: 0.3rem 1rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 1rem;
}
.split-card-top h2 {
    font-size: 1.85rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
    position: relative;
}
.split-card-top p {
    color: rgba(255,255,255,0.85);
    font-size: 0.95rem;
    line-height: 1.6;
    position: relative;
}
.split-card-bottom {
    background: white;
    padding: 2rem 2.5rem 2.5rem;
    flex: 1;
}
.feature-list { list-style: none; margin-bottom: 2rem; }
.feature-list li {
    display: flex; align-items: flex-start; gap: 0.75rem;
    margin-bottom: 0.85rem;
    font-size: 0.9rem; color: #475569;
    line-height: 1.5;
}
.feature-list .check {
    width: 22px; height: 22px; min-width: 22px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem;
    color: white;
    font-weight: 900;
    margin-top: 1px;
}
.cta-btn {
    display: block;
    width: 100%;
    padding: 1rem;
    border-radius: 16px;
    text-align: center;
    font-weight: 700;
    font-size: 1.05rem;
    text-decoration: none;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
}
.cta-btn:hover { transform: translateY(-2px); }

/* ── Info Strip ── */
.info-strip {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.25rem;
    margin-bottom: 3rem;
}
.info-strip-item {
    background: white;
    border-radius: 18px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 4px 24px rgba(46,134,171,0.07);
    border-top: 3px solid transparent;
    transition: transform 0.3s;
}
.info-strip-item:hover { transform: translateY(-4px); }
.info-strip-item .icon { font-size: 2rem; margin-bottom: 0.75rem; }
.info-strip-item h4 { font-weight: 700; color: var(--biru-gelap); margin-bottom: 0.3rem; font-size: 0.95rem; }
.info-strip-item p  { font-size: 0.82rem; color: #64748B; line-height: 1.5; }

/* ── Comparison Table ── */
.compare-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 30px rgba(46,134,171,0.08);
    margin-bottom: 3rem;
}
.compare-table th {
    padding: 1.25rem 1.5rem;
    font-size: 1rem;
    font-weight: 700;
    color: white;
}
.compare-table th:first-child { background: #F8FAFC; color: #64748B; }
.compare-table th:nth-child(2) { background: linear-gradient(135deg, #DC2626, #EF4444); }
.compare-table th:nth-child(3) { background: linear-gradient(135deg, #059669, #10B981); }
.compare-table td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #F1F5F9;
    font-size: 0.9rem;
    color: #475569;
}
.compare-table tr:last-child td { border-bottom: none; }
.compare-table td:first-child { font-weight: 600; color: var(--teks-gelap); }
.compare-table td:nth-child(2) { background: #FFF5F5; text-align: center; }
.compare-table td:nth-child(3) { background: #F0FDF4; text-align: center; }
.compare-table .yes { color: #059669; font-size: 1.1rem; }
.compare-table .no  { color: #DC2626; font-size: 1.1rem; }

/* ── Transparansi Donasi ── */
.transparansi-section { margin-bottom: 3rem; }
.transparansi-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 30px rgba(46,134,171,0.08);
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.transparansi-card h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--biru-gelap);
    padding: 1.25rem 1.5rem;
    margin: 0;
    border-bottom: 1px solid #F1F5F9;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.transparansi-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}
.transparansi-table th {
    text-align: left;
    padding: 0.85rem 1.5rem;
    background: #F8FAFC;
    color: #64748B;
    font-weight: 700;
}
.transparansi-table td {
    padding: 0.85rem 1.5rem;
    border-bottom: 1px solid #F1F5F9;
    color: #475569;
}
.transparansi-table tr:last-child td { border-bottom: none; }
.transparansi-table .nominal { font-weight: 700; color: #DC2626; }
.download-card {
    background: linear-gradient(135deg, #F0FDF4, #DCFCE7);
    border: 1px solid #BBF7D0;
    border-radius: 20px;
    padding: 1.5rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}
.download-card p { margin: 0; color: #166534; font-weight: 600; font-size: 1rem; }
.download-card a {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1.25rem;
    background: #059669;
    color: white;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    transition: transform 0.2s, box-shadow 0.2s;
}
.download-card a:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(5,150,105,0.35); color: white; }

@media (max-width: 700px) {
    .split-grid { grid-template-columns: 1fr; }
    .split-card-top { min-height: 200px; padding: 2.5rem 2rem 2rem; }
    .compare-table { display: none; }
    .transparansi-table { font-size: 0.8rem; }
    .transparansi-table th, .transparansi-table td { padding: 0.6rem 0.75rem; }
    .grafik-donasi-cards { grid-template-columns: 1fr; }
}
.grafik-donasi-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.grafik-donasi-card {
    border-radius: 16px;
    padding: 1.25rem;
    text-align: center;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
}
.grafik-donasi-card h4 { font-size: 0.8rem; font-weight: 700; margin: 0 0 0.5rem 0; }
.grafik-donasi-card .nilai { font-size: 1.1rem; font-weight: 800; }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="donasi-hero">
    <div class="hero-badge-wrap">
        <span class="hero-badge badge-red">💰 Donasi Keuangan</span>
        <span style="color:#94A3B8; font-weight:700; font-size:1.1rem; align-self:center;">✦</span>
        <span class="hero-badge badge-green">🤲 Donasi Jasa</span>
    </div>
    <h1>
        Setiap Bentuk Kebaikan<br>
        <span class="highlight-red">Bernilai</span> &amp;
        <span class="highlight-green">Bermakna</span>
    </h1>
    <p>Anda bisa berdonasi dalam dua cara — melalui <strong>uang</strong> untuk memenuhi kebutuhan, atau melalui <strong>jasa dan keahlian</strong> untuk memperkaya kehidupan anak-anak kami.</p>
</section>

<!-- Split Cards Pilihan -->
<div class="split-grid">
    <!-- Donasi Keuangan -->
    <a href="{{ route('donasi.keuangan') }}" class="split-card">
        <div class="split-card-top" style="background: linear-gradient(135deg, #7f1d1d, #DC2626 50%, #f97316);">
            <span class="card-emoji">💰</span>
            <span class="card-type-label">Donasi Uang</span>
            <h2>Donasi Keuangan</h2>
            <p>Bantu kebutuhan sehari-hari, pendidikan, dan kesehatan anak-anak dengan donasi finansial.</p>
        </div>
        <div class="split-card-bottom">
            <ul class="feature-list">
                <li>
                    <span class="check" style="background:#DC2626;">✓</span>
                    Pilih nominal bebas, mulai dari Rp 10.000
                </li>
                <li>
                    <span class="check" style="background:#DC2626;">✓</span>
                    Dana untuk makan, sekolah, kesehatan & fasilitas
                </li>
                <li>
                    <span class="check" style="background:#DC2626;">✓</span>
                    Laporan penggunaan dana secara transparan
                </li>
                <li>
                    <span class="check" style="background:#DC2626;">✓</span>
                    Cepat, mudah, dan langsung berdampak
                </li>
            </ul>
            <span class="cta-btn" style="background: linear-gradient(135deg, #DC2626, #EF4444); color: white; box-shadow: 0 6px 24px rgba(220,38,38,0.3);">
                Donasi Keuangan Sekarang →
            </span>
        </div>
    </a>

    <!-- Donasi Jasa -->
    <a href="{{ route('donasi.jasa') }}" class="split-card">
        <div class="split-card-top" style="background: linear-gradient(135deg, #064e3b, #059669 50%, #34d399);">
            <span class="card-emoji">🤲</span>
            <span class="card-type-label">Donasi Jasa</span>
            <h2>Donasi Jasa</h2>
            <p>Gunakan keahlian dan waktu Anda untuk langsung melayani dan memberdayakan anak-anak.</p>
        </div>
        <div class="split-card-bottom">
            <ul class="feature-list">
                <li>
                    <span class="check" style="background:#059669;">✓</span>
                    Mengajar, melatih, membimbing langsung
                </li>
                <li>
                    <span class="check" style="background:#059669;">✓</span>
                    Berbagai bidang: medis, IT, seni, olahraga, dll
                </li>
                <li>
                    <span class="check" style="background:#059669;">✓</span>
                    Jadwal fleksibel sesuai ketersediaan Anda
                </li>
                <li>
                    <span class="check" style="background:#059669;">✓</span>
                    Dampak langsung terasa oleh anak-anak
                </li>
            </ul>
            <span class="cta-btn" style="background: linear-gradient(135deg, #059669, #10B981); color: white; box-shadow: 0 6px 24px rgba(5,150,105,0.3);">
                Daftarkan Donasi Jasa →
            </span>
        </div>
    </a>
</div>

<!-- Transparansi Donasi -->
<section class="transparansi-section">
    {{-- Grafik Pemasukan, Pengeluaran & Sisa Saldo --}}
    <div class="transparansi-card">
        <h3><i class="fas fa-chart-line" style="color:#059669;"></i> Pemasukan, Pengeluaran & Sisa Saldo Donasi (6 Bulan Terakhir)</h3>
        <div style="padding: 1rem 1.5rem;">
            <div class="grafik-donasi-cards">
                <div class="grafik-donasi-card" style="background: linear-gradient(135deg,#d1fae5 0%,#a7f3d0 100%);">
                    <h4 style="color:#065f46;">Total Pemasukan</h4>
                    <div class="nilai" style="color:#047857;">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</div>
                </div>
                <div class="grafik-donasi-card" style="background: linear-gradient(135deg,#fee2e2 0%,#fecaca 100%);">
                    <h4 style="color:#991b1b;">Total Pengeluaran</h4>
                    <div class="nilai" style="color:#b91c1c;">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</div>
                </div>
                <div class="grafik-donasi-card" style="background: linear-gradient(135deg,#dbeafe 0%,#bfdbfe 100%);">
                    <h4 style="color:#1e40af;">Sisa Saldo Donasi</h4>
                    <div class="nilai" style="color:#1d4ed8;">Rp {{ number_format($sisa_saldo, 0, ',', '.') }}</div>
                </div>
            </div>
            <canvas id="grafikPemasukanPengeluaranSaldo" height="120" style="max-height: 280px;"></canvas>
        </div>
    </div>

    <div class="transparansi-card">
        <h3><i class="fas fa-list-alt" style="color:#DC2626;"></i> Transparansi Donasi</h3>
        <div style="overflow-x: auto;">
            <table class="transparansi-table">
                <thead>
                    <tr>
                        <th>Nama Donatur</th>
                        <th>Email</th>
                        <th>Nominal Donasi</th>
                        <th>Tanggal / Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donasiList as $d)
                    <tr>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->email }}</td>
                        <td class="nominal">Rp {{ number_format($d->nominal, 0, ',', '.') }}</td>
                        <td>{{ $d->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 2rem; color: #94A3B8;">Belum ada data donasi yang tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="download-card">
        <p><i class="fas fa-file-download"></i> Unduh laporan donasi keuangan dalam bentuk PDF (data selesai dibayar)</p>
        <a href="{{ route('donasi.laporan') }}"><i class="fas fa-download"></i> Download Laporan Donasi</a>
    </div>
    <div class="download-card" style="margin-top: 1rem;">
        <p><i class="fas fa-file-pdf"></i> Unduh laporan pengelolaan donasi (pengeluaran & bukti) dalam bentuk PDF</p>
        <a href="{{ route('donasi.laporan-pengelolaan') }}"><i class="fas fa-download"></i> Download Laporan Pengelolaan Donasi</a>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function() {
    const grafikDonasi = @json($grafik_donasi);
    const labelBulan = grafikDonasi.map(d => {
        const [y, m] = d.bulan.split('-');
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        return months[parseInt(m) - 1] + ' ' + y;
    });
    const ctx = document.getElementById('grafikPemasukanPengeluaranSaldo');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelBulan,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: grafikDonasi.map(d => d.pemasukan),
                    backgroundColor: 'rgba(16,185,129,.85)',
                    borderRadius: 6,
                    yAxisID: 'y',
                },
                {
                    label: 'Pengeluaran',
                    data: grafikDonasi.map(d => d.pengeluaran),
                    backgroundColor: 'rgba(239,68,68,.85)',
                    borderRadius: 6,
                    yAxisID: 'y',
                },
                {
                    label: 'Sisa Saldo',
                    data: grafikDonasi.map(d => d.sisa_saldo),
                    type: 'line',
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,.1)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { position: 'top', labels: { font: { size: 11 }, padding: 12 } },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            return ctx.dataset.label + ': Rp ' + ctx.raw.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    position: 'left',
                    grid: { color: '#f1f5f9' },
                    ticks: {
                        callback: v => 'Rp ' + (v >= 1e6 ? (v/1e6).toFixed(1) + 'jt' : (v/1e3).toFixed(0) + 'rb'),
                        font: { size: 10 }
                    }
                },
                y1: {
                    type: 'linear',
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: {
                        callback: v => 'Rp ' + (v >= 1e6 ? (v/1e6).toFixed(1) + 'jt' : (v/1e3).toFixed(0) + 'rb'),
                        font: { size: 10 }
                    }
                },
                x: { grid: { display: false }, ticks: { font: { size: 11 } } }
            }
        }
    });
})();
</script>
@endpush

@endsection
