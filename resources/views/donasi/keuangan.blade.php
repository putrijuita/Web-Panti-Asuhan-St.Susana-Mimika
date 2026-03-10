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
.impact-item p  { font-size: 0.9rem; color: var(--teks-gelap); margin: 0; line-height: 1.4; }

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

/* ── Modal QRIS ───────────────────────────── */
.qris-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    align-items: center; justify-content: center;
    backdrop-filter: blur(4px);
}
.qris-overlay.active { display: flex; }
.qris-modal {
    background: white;
    border-radius: 24px;
    padding: 2rem 2rem 1.75rem;
    max-width: 400px; width: 92%;
    text-align: center;
    box-shadow: 0 24px 80px rgba(0,0,0,0.25);
    animation: modalIn .25s ease;
    position: relative;
}
@keyframes modalIn {
    from { opacity:0; transform:scale(.92) translateY(16px); }
    to   { opacity:1; transform:scale(1)  translateY(0); }
}
.qris-modal-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.25rem;
}
.qris-modal-header img { height: 32px; }
.qris-close {
    background: #F1F5F9; border: none; border-radius: 50%;
    width: 32px; height: 32px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; color: #64748B; transition: background .2s;
}
.qris-close:hover { background: #E2E8F0; }
.qris-nominal {
    font-size: 1.55rem; font-weight: 800; color: #DC2626;
    margin-bottom: 0.25rem;
}
.qris-name { font-size: 0.88rem; color: #64748B; margin-bottom: 1.25rem; }
.qris-image-wrap {
    background: #F8FAFC; border-radius: 16px;
    padding: 1rem; margin-bottom: 1rem; display: inline-block;
    border: 2px solid #E2E8F0;
}
.qris-image-wrap img {
    width: 220px; height: 220px; display: block;
    border-radius: 8px;
}
.qris-status {
    font-size: 0.83rem; padding: 0.5rem 1rem;
    border-radius: 50px; margin-bottom: 1rem;
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-weight: 600;
}
.qris-status.waiting { background: #FEF9C3; color: #854D0E; }
.qris-status.checking { background: #DBEAFE; color: #1E40AF; }
.qris-status.success  { background: #DCFCE7; color: #166534; }
.qris-expiry { font-size: 0.78rem; color: #94A3B8; margin-bottom: 0.5rem; }
.qris-info   { font-size: 0.8rem; color: #94A3B8; margin-top: 0.75rem; line-height: 1.5; }
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
            <div class="impact-item"><div class="impact-icon" style="background:#FEE2E2;">🍽️</div><div><p>Makan bergizi anak</p></div></div>
            <div class="impact-item"><div class="impact-icon" style="background:#DBEAFE;">📚</div><div><p>Buku dan alat tulis</p></div></div>
            <div class="impact-item"><div class="impact-icon" style="background:#D1FAE5;">👕</div><div><p>Pakaian sekolah</p></div></div>
            <div class="impact-item"><div class="impact-icon" style="background:#EDE9FE;">💊</div><div><p>Biaya kesehatan anak</p></div></div>
        </div>
        <div class="info-card" style="background: linear-gradient(135deg, #FFF7ED, #FFEDD5); border: 1px solid #FED7AA;">
            <h3><i class="fas fa-quote-left" style="color:#f97316;"></i> Pesan dari Panti</h3>
            <p style="color: #92400E; font-style: italic; line-height: 1.7; font-size: 0.95rem;">
                "Donasi Anda bukan sekadar angka — ia adalah senyum di pagi hari, buku yang dibuka dengan semangat, dan mimpi yang berani diperjuangkan."
            </p>
            <p style="color: #B45309; font-weight: 600; font-size: 0.85rem; margin-top: 0.75rem;">— Panti Asuhan Santa Susana</p>
        </div>
    </div>

    <!-- Form Kanan -->
    <div class="form-card">
        <h2 style="font-size:1.4rem; color:var(--biru-gelap); margin-bottom:0.4rem;">Form Donasi Keuangan</h2>
        <p style="color:#64748B; font-size:0.9rem; margin-bottom:2rem;">Isi data Anda untuk melanjutkan donasi</p>

        <div id="qris-badge" style="display:flex;align-items:center;gap:0.5rem;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:12px;padding:0.65rem 1rem;margin-bottom:1.5rem;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/QRIS_logo.svg" alt="QRIS" style="height:28px;">
            <span style="font-size:0.82rem;color:#166534;font-weight:600;">Pembayaran via QRIS — scan &amp; bayar instan</span>
        </div>

        <form id="donasi-form">
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
                <span id="error-nominal" class="error-msg" style="display:none;"></span>
            </div>
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Nama Anda">
                <span id="error-nama" class="error-msg" style="display:none;"></span>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com">
                <span id="error-email" class="error-msg" style="display:none;"></span>
            </div>
            <div class="form-group">
                <label>Nomor Telepon (opsional)</label>
                <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx">
            </div>
            <div class="form-group">
                <label>Pesan / Doa untuk Anak-Anak (opsional)</label>
                <textarea id="catatan" name="catatan" placeholder="Tuliskan pesan atau doa tulus Anda...">{{ old('catatan') }}</textarea>
            </div>
            <button type="button" id="btn-donasi" class="submit-btn" onclick="bayarQRIS()">
                <i class="fas fa-qrcode"></i> Bayar dengan QRIS
            </button>
        </form>
        <p style="text-align:center; margin-top:1rem; font-size:0.8rem; color:#94A3B8;">
            <i class="fas fa-lock"></i> Pembayaran aman diproses oleh Midtrans
        </p>
    </div>
</div>

<!-- Modal QRIS -->
<div class="qris-overlay" id="qris-overlay" onclick="tutupQRIS(event)">
    <div class="qris-modal" id="qris-modal">
        <div class="qris-modal-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/QRIS_logo.svg" alt="QRIS">
            <button class="qris-close" onclick="tutupModal()"><i class="fas fa-times"></i></button>
        </div>

        <div id="qris-loading" style="padding:2rem 0;">
            <i class="fas fa-spinner fa-spin" style="font-size:2rem;color:#DC2626;"></i>
            <p style="margin-top:0.75rem;color:#64748B;font-size:0.9rem;">Membuat kode QRIS...</p>
        </div>

        <div id="qris-content" style="display:none;">
            <div class="qris-nominal" id="qris-nominal-text"></div>
            <div class="qris-name" id="qris-nama-text"></div>
            <div class="qris-image-wrap">
                <img id="qris-img" src="" alt="QR Code QRIS">
            </div>
            <div class="qris-status waiting" id="qris-status-badge">
                <i class="fas fa-clock"></i> Menunggu pembayaran...
            </div>
            <div class="qris-expiry" id="qris-expiry-text"></div>
            <div class="qris-info">
                Buka aplikasi e-wallet atau m-banking Anda<br>
                pilih <strong>Scan QR / QRIS</strong> lalu scan kode di atas
            </div>
        </div>
    </div>
</div>

<!-- Hidden form redirect setelah bayar -->
<form id="redirect-form" action="{{ route('donasi.keuangan.store') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" id="redirect-order-id" name="order_id">
</form>
@endsection

@push('scripts')
<script>
let pollInterval = null;
let currentOrderId = null;

function setAmount(val, btn) {
    document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('nominal').value = val;
}

function formatRupiah(angka) {
    return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
}

function bayarQRIS() {
    const btn     = document.getElementById('btn-donasi');
    const nominal = document.getElementById('nominal').value;
    const nama    = document.getElementById('nama').value.trim();
    const email   = document.getElementById('email').value.trim();

    ['nominal','nama','email'].forEach(f => {
        document.getElementById('error-'+f).style.display = 'none';
    });

    let valid = true;
    if (!nominal || nominal < 1000) {
        document.getElementById('error-nominal').textContent = 'Nominal minimal Rp 1.000';
        document.getElementById('error-nominal').style.display = 'block';
        valid = false;
    }
    if (!nama) {
        document.getElementById('error-nama').textContent = 'Nama lengkap wajib diisi';
        document.getElementById('error-nama').style.display = 'block';
        valid = false;
    }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('error-email').textContent = 'Email tidak valid';
        document.getElementById('error-email').style.display = 'block';
        valid = false;
    }
    if (!valid) return;

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

    document.getElementById('qris-loading').style.display = 'block';
    document.getElementById('qris-content').style.display = 'none';
    document.getElementById('qris-overlay').classList.add('active');

    const csrfToken = document.querySelector('#donasi-form [name="_token"]').value;

    fetch('{{ route("donasi.midtrans.token") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({
            nama:    nama,
            email:   email,
            telepon: document.getElementById('telepon').value,
            nominal: nominal,
            catatan: document.getElementById('catatan').value,
        }),
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-qrcode"></i> Bayar dengan QRIS';

        if (data.error) {
            tutupModal();
            alert('Terjadi kesalahan: ' + data.error);
            return;
        }

        currentOrderId = data.order_id;

        document.getElementById('qris-nominal-text').textContent = formatRupiah(data.nominal);
        document.getElementById('qris-nama-text').textContent = 'Donasi atas nama: ' + nama;
        document.getElementById('qris-img').src = data.qr_url;

        if (data.expiry_time) {
            document.getElementById('qris-expiry-text').textContent = 'Berlaku hingga: ' + data.expiry_time;
        }

        document.getElementById('qris-loading').style.display = 'none';
        document.getElementById('qris-content').style.display = 'block';

        startPolling(data.order_id);
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-qrcode"></i> Bayar dengan QRIS';
        tutupModal();
        alert('Koneksi gagal. Silakan coba lagi.');
    });
}

function startPolling(orderId) {
    stopPolling();
    pollInterval = setInterval(() => {
        const badge = document.getElementById('qris-status-badge');
        badge.className = 'qris-status checking';
        badge.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memeriksa pembayaran...';

        fetch('{{ url("donasi/midtrans/status") }}/' + orderId)
        .then(r => r.json())
        .then(res => {
            if (res.paid) {
                stopPolling();
                badge.className = 'qris-status success';
                badge.innerHTML = '<i class="fas fa-check-circle"></i> Pembayaran berhasil! Mengalihkan...';
                setTimeout(() => {
                    document.getElementById('redirect-order-id').value = orderId;
                    document.getElementById('redirect-form').submit();
                }, 1500);
            } else {
                badge.className = 'qris-status waiting';
                badge.innerHTML = '<i class="fas fa-clock"></i> Menunggu pembayaran...';
            }
        })
        .catch(() => {
            badge.className = 'qris-status waiting';
            badge.innerHTML = '<i class="fas fa-clock"></i> Menunggu pembayaran...';
        });
    }, 3000);
}

function stopPolling() {
    if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
}

function tutupModal() {
    stopPolling();
    document.getElementById('qris-overlay').classList.remove('active');
    currentOrderId = null;
}

function tutupQRIS(e) {
    if (e.target === document.getElementById('qris-overlay')) tutupModal();
}
</script>
@endpush
