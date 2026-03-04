@extends('layouts.app')

@section('title', 'Donasi Keuangan - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.keuangan-hero {
    background: linear-gradient(135deg, #7f1d1d 0%, #DC2626 50%, #f97316 100%);
    border-radius: 24px;
    padding: 3.5rem 2.5rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.keuangan-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
}
.back-link {
    display: inline-flex; align-items: center; gap: 0.4rem;
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    font-size: 0.88rem;
    margin-bottom: 1.5rem;
    transition: opacity 0.2s;
    position: relative;
}
.back-link:hover { opacity: 1; color: white; }
.keuangan-hero h1 { font-size: clamp(1.8rem,4.5vw,2.8rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.keuangan-hero p  { font-size: 1.05rem; opacity: 0.9; max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative; }

.donasi-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    align-items: start;
}
.form-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 8px 40px rgba(220,38,38,0.08);
    position: sticky;
    top: 88px;
}
.info-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(46,134,171,0.07);
    margin-bottom: 1.5rem;
}
.info-card h3 { font-size: 1.05rem; color: var(--biru-gelap); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; }

.amount-grid {
    display: grid; grid-template-columns: repeat(3,1fr); gap: 0.6rem; margin-bottom: 0.75rem;
}
.amount-btn {
    padding: 0.65rem 0.5rem;
    border: 2px solid #E2E8F0;
    border-radius: 12px;
    background: white;
    font-weight: 700; font-size: 0.82rem;
    cursor: pointer; font-family: inherit;
    color: var(--teks-gelap); text-align: center;
    transition: all 0.2s;
}
.amount-btn:hover { border-color: #DC2626; color: #DC2626; background: #FFF5F5; }
.amount-btn.selected { border-color: #DC2626; background: #DC2626; color: white; }

.impact-item {
    display: flex; align-items: center; gap: 1rem;
    padding: 0.9rem; border-radius: 12px;
    background: #FFF5F5; margin-bottom: 0.6rem;
}
.impact-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; flex-shrink: 0;
}
.impact-item h4 { font-weight: 700; font-size: 0.88rem; color: var(--teks-gelap); margin-bottom: 0.15rem; }
.impact-item p  { font-size: 0.8rem; color: #64748B; }

.trust-badges { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
.trust-badge {
    display: flex; align-items: center; gap: 0.35rem;
    background: #F0FDF4; color: #166534;
    padding: 0.4rem 0.75rem; border-radius: 50px;
    font-size: 0.78rem; font-weight: 600;
}

.submit-btn {
    width: 100%; padding: 1rem;
    background: linear-gradient(135deg, #DC2626, #EF4444);
    color: white; border: none; border-radius: 14px;
    font-size: 1.1rem; font-weight: 700;
    cursor: pointer; font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(220,38,38,0.3);
    display: flex; align-items: center; justify-content: center; gap: 0.5rem;
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(220,38,38,0.4); }

@media (max-width: 860px) {
    .donasi-layout { grid-template-columns: 1fr; }
    .form-card { position: static; }
}
</style>
@endpush

@section('content')
<div class="keuangan-hero">
    <a href="{{ route('donasi.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Pilihan Donasi
    </a>
    <h1>💰 Donasi Keuangan</h1>
    <p>Setiap rupiah yang Anda berikan digunakan 100% untuk kebutuhan, pendidikan, dan kesehatan anak-anak kami di Timika.</p>
</div>

<div class="donasi-layout">
    <!-- Info Kiri -->
    <div>
        <div class="info-card">
            <h3><i class="fas fa-heart" style="color:#DC2626;"></i> Dampak Nyata Donasi Anda</h3>
            <div class="impact-item"><div class="impact-icon" style="background:#FEE2E2;">🍽️</div><div><h4>Rp 50.000</h4><p>Makan bergizi 1 anak selama 3 hari</p></div></div>
            <div class="impact-item"><div class="impact-icon" style="background:#DBEAFE;">📚</div><div><h4>Rp 150.000</h4><p>Paket buku pelajaran 1 anak</p></div></div>
            <div class="impact-item"><div class="impact-icon" style="background:#D1FAE5;">👕</div><div><h4>Rp 250.000</h4><p>Seragam sekolah lengkap 1 anak</p></div></div>
            <div class="impact-item"><div class="impact-icon" style="background:#EDE9FE;">💊</div><div><h4>Rp 500.000</h4><p>Biaya kesehatan 1 anak selama sebulan</p></div></div>
            <div class="impact-item"><div class="impact-icon" style="background:#FEF3C7;">🎒</div><div><h4>Rp 1.000.000</h4><p>Biaya sekolah + perlengkapan 1 semester</p></div></div>
        </div>
        <div class="info-card">
            <h3><i class="fas fa-shield-halved" style="color:var(--biru-tua);"></i> Jaminan Transparansi</h3>
            <div class="trust-badges">
                <span class="trust-badge"><i class="fas fa-check"></i> Dana Terkelola</span>
                <span class="trust-badge"><i class="fas fa-check"></i> Laporan Berkala</span>
                <span class="trust-badge"><i class="fas fa-check"></i> Terpercaya</span>
            </div>
            <p style="color: #64748B; font-size: 0.88rem; line-height: 1.6;">
                Setiap donasi dicatat dan dikelola secara transparan. Laporan penggunaan dana tersedia dan kami siap memberikan konfirmasi kepada setiap donatur.
            </p>
        </div>
        <div class="info-card" style="background: linear-gradient(135deg, #FFF7ED, #FFEDD5); border: 1px solid #FED7AA;">
            <h3><i class="fas fa-quote-left" style="color:#f97316;"></i> Pesan dari Panti</h3>
            <p style="color: #92400E; font-style: italic; line-height: 1.7; font-size: 0.95rem;">
                "Donasi Anda bukan sekadar angka — ia adalah senyum di pagi hari, buku yang dibuka dengan semangat, dan mimpi yang berani diperjuangkan."
            </p>
            <p style="color: #B45309; font-weight: 600; font-size: 0.85rem; margin-top: 0.75rem;">— Panti Asuhan Santa Susana</p>
        </div>
        <div class="info-card" style="text-align:center; background: #F8FAFC; border: 1px dashed #CBD5E1;">
            <p style="font-size: 0.9rem; color:#64748B; margin-bottom: 0.75rem;">Ingin donasi dalam bentuk barang atau jasa?</p>
            <a href="{{ route('donasi.jasa') }}" class="btn btn-outline">🤲 Lihat Donasi Jasa</a>
        </div>
    </div>

    <!-- Form Kanan -->
    <div class="form-card">
        <h2 style="font-size:1.4rem; color:var(--biru-gelap); margin-bottom:0.4rem;">Form Donasi Keuangan</h2>
        <p style="color:#64748B; font-size:0.9rem; margin-bottom:2rem;">Isi data Anda untuk melanjutkan donasi</p>

        <form action="{{ route('donasi.keuangan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Pilih Nominal Cepat</label>
                <div class="amount-grid">
                    <button type="button" class="amount-btn" onclick="setAmount(10000,this)">Rp 10.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(50000,this)">Rp 50.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(100000,this)">Rp 100.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(250000,this)">Rp 250.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(500000,this)">Rp 500.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(1000000,this)">Rp 1 Juta</button>
                </div>
                <input type="number" id="nominal" name="nominal" value="{{ old('nominal') }}"
                    min="1000" step="1000" required placeholder="Atau masukkan nominal lainnya..."
                    style="margin-top:0.5rem;">
                @error('nominal')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Nama Anda">
                @error('nama')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com">
                @error('email')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Nomor Telepon (opsional)</label>
                <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
                <label>Pesan / Doa untuk Anak-Anak (opsional)</label>
                <textarea name="catatan" placeholder="Tuliskan pesan atau doa tulus Anda...">{{ old('catatan') }}</textarea>
            </div>
            <button type="submit" class="submit-btn">
                <i class="fas fa-heart"></i> Kirim Donasi Keuangan
            </button>
        </form>
        <p style="text-align:center; margin-top:1rem; font-size:0.8rem; color:#94A3B8;">
            <i class="fas fa-lock"></i> Data Anda aman &amp; terlindungi
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
function setAmount(val, btn) {
    document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('nominal').value = val;
}
</script>
@endpush
