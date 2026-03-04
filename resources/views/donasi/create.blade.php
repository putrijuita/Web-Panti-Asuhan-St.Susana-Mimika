@extends('layouts.app')

@section('title', 'Donasi - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.donasi-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    align-items: start;
}
.donasi-hero {
    background: linear-gradient(135deg, #dc2626, #ef4444 40%, #f97316 100%);
    border-radius: 24px;
    padding: 3.5rem 2.5rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.donasi-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
}
.donasi-hero h1 { font-size: clamp(2rem,5vw,2.8rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.donasi-hero p  { font-size: 1.05rem; opacity: 0.9; max-width: 580px; margin: 0 auto; line-height: 1.7; position: relative; }

.form-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 8px 40px rgba(46,134,171,0.1);
    position: sticky;
    top: 88px;
}
.form-card h2 { font-size: 1.4rem; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.form-card .subtitle { color: #64748B; font-size: 0.9rem; margin-bottom: 2rem; }

.amount-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.6rem;
    margin-bottom: 0.75rem;
}
.amount-btn {
    padding: 0.7rem 0.5rem;
    border: 2px solid #E2E8F0;
    border-radius: 12px;
    background: white;
    font-weight: 700;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s;
    font-family: inherit;
    color: var(--teks-gelap);
    text-align: center;
}
.amount-btn:hover { border-color: var(--biru-tua); color: var(--biru-tua); background: rgba(46,134,171,0.05); }
.amount-btn.selected { border-color: var(--biru-tua); background: var(--biru-tua); color: white; }

.info-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
    margin-bottom: 1.5rem;
}
.info-card h3 { font-size: 1.1rem; color: var(--biru-gelap); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
.impact-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 12px;
    background: #F8FAFC;
    margin-bottom: 0.75rem;
}
.impact-icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.impact-item h4 { font-weight: 700; font-size: 0.9rem; color: var(--teks-gelap); margin-bottom: 0.2rem; }
.impact-item p  { font-size: 0.8rem; color: #64748B; }

.trust-badges {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}
.trust-badge {
    display: flex; align-items: center; gap: 0.35rem;
    background: #F0FDF4;
    color: #166534;
    padding: 0.4rem 0.75rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
}

.submit-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #dc2626, #ef4444);
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(220,38,38,0.3);
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(220,38,38,0.4); }

@media (max-width: 860px) {
    .donasi-layout { grid-template-columns: 1fr; }
    .form-card { position: static; }
}
</style>
@endpush

@section('content')
<div class="donasi-hero">
    <h1>💝 Donasi untuk Anak-Anak</h1>
    <p>Setiap rupiah yang Anda donasikan membawa senyum, harapan, dan masa depan yang lebih cerah bagi anak-anak kami</p>
</div>

<div class="donasi-layout">
    <!-- Kiri: Info -->
    <div>
        <div class="info-card">
            <h3><i class="fas fa-heart" style="color:#ef4444;"></i> Dampak Donasi Anda</h3>
            <div class="impact-item">
                <div class="impact-icon" style="background:#FEE2E2;">🍽️</div>
                <div><h4>Rp 50.000</h4><p>Biaya makan 1 anak selama 3 hari</p></div>
            </div>
            <div class="impact-item">
                <div class="impact-icon" style="background:#DBEAFE;">📚</div>
                <div><h4>Rp 150.000</h4><p>Paket buku pelajaran 1 anak</p></div>
            </div>
            <div class="impact-item">
                <div class="impact-icon" style="background:#D1FAE5;">👕</div>
                <div><h4>Rp 250.000</h4><p>Seragam sekolah lengkap 1 anak</p></div>
            </div>
            <div class="impact-item">
                <div class="impact-icon" style="background:#EDE9FE;">💊</div>
                <div><h4>Rp 500.000</h4><p>Biaya kesehatan 1 anak selama 1 bulan</p></div>
            </div>
        </div>
        <div class="info-card">
            <h3><i class="fas fa-shield-halved" style="color:var(--biru-tua);"></i> Jaminan Transparansi</h3>
            <div class="trust-badges">
                <span class="trust-badge"><i class="fas fa-check"></i> Dana Terkelola</span>
                <span class="trust-badge"><i class="fas fa-check"></i> Laporan Berkala</span>
                <span class="trust-badge"><i class="fas fa-check"></i> Terpercaya</span>
            </div>
            <p style="color: #64748B; font-size: 0.9rem; line-height: 1.6;">
                Setiap donasi dikelola secara transparan dan digunakan 100% untuk kebutuhan anak-anak. Laporan penggunaan dana tersedia bagi donatur.
            </p>
        </div>
        <div class="info-card" style="background: linear-gradient(135deg, #FFF7ED, #FFEDD5); border: 1px solid #FED7AA;">
            <h3><i class="fas fa-quote-left" style="color:#f97316;"></i> Pesan dari Panti</h3>
            <p style="color: #92400E; font-style: italic; line-height: 1.7;">"Donasi Anda bukan sekadar uang. Ia adalah harapan, kasih sayang, dan kepercayaan bahwa setiap anak berhak mendapat yang terbaik. Terima kasih."</p>
            <p style="color: #B45309; font-weight: 600; font-size: 0.9rem; margin-top: 0.75rem;">— Pengurus Panti Asuhan Santa Susana</p>
        </div>
    </div>

    <!-- Kanan: Form -->
    <div class="form-card">
        <h2>Form Donasi</h2>
        <p class="subtitle">Isi data Anda untuk berdonasi</p>

        <form action="{{ route('donasi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Pilih Nominal Donasi</label>
                <div class="amount-grid">
                    <button type="button" class="amount-btn" onclick="setAmount(50000, this)">Rp 50.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(100000, this)">Rp 100.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(200000, this)">Rp 200.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(500000, this)">Rp 500.000</button>
                    <button type="button" class="amount-btn" onclick="setAmount(1000000, this)">Rp 1 Juta</button>
                    <button type="button" class="amount-btn" onclick="setAmount(0, this)">Lainnya</button>
                </div>
                <input type="number" id="nominal" name="nominal" value="{{ old('nominal') }}"
                    min="1000" step="1000" required placeholder="Masukkan nominal (min Rp 1.000)"
                    style="margin-top: 0.5rem;">
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
                <label>Nomor Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx">
                @error('telepon')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Pesan / Doa (Opsional)</label>
                <textarea name="catatan" placeholder="Tuliskan pesan atau doa untuk anak-anak...">{{ old('catatan') }}</textarea>
                @error('catatan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="submit-btn">💝 Kirim Donasi Sekarang</button>
        </form>

        <div style="text-align: center; margin-top: 1.25rem; font-size: 0.82rem; color: #94A3B8;">
            <i class="fas fa-lock"></i> Informasi Anda aman dan terlindungi
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function setAmount(val, btn) {
    document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    const input = document.getElementById('nominal');
    if (val > 0) {
        input.value = val;
    } else {
        input.value = '';
        input.focus();
    }
}
</script>
@endpush
