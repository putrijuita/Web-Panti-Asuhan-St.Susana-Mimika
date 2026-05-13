@extends('layouts.app')

@section('title', $dk['page_title'] ?? 'Donasi Keuangan - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.keuangan-hero {
    background: linear-gradient(135deg, var(--aksen-gelap) 0%, var(--aksen) 65%, var(--biru-muda-gelap) 100%);
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
    background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.12) 0%, transparent 52%);
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
.keuangan-hero h1 i { margin-right: 0.35em; opacity: 0.95; }
.keuangan-hero p  { font-size: 1.05rem; opacity: 0.9; max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative; }
/* Latar hero gelap → ikon putih */
.keuangan-hero i { color: #fff; }

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
    border: 1px solid var(--border);
    box-shadow: 0 10px 36px rgba(8, 47, 73, 0.09);
    position: sticky;
    top: 88px;
}
.info-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    border: 1px solid var(--border);
    box-shadow: 0 4px 20px rgba(8, 47, 73, 0.06);
    margin-bottom: 1.5rem;
}
.info-card h3 { font-size: 1.05rem; color: var(--biru-gelap); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; }
.info-card h3 > i { color: var(--biru-gelap); }

.amount-grid {
    display: grid; grid-template-columns: repeat(3,1fr); gap: 0.6rem; margin-bottom: 0.75rem;
}
.amount-btn {
    padding: 0.65rem 0.5rem;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: white;
    font-weight: 700; font-size: 0.82rem;
    cursor: pointer; font-family: inherit;
    color: var(--teks-gelap); text-align: center;
    transition: all 0.2s;
}
.amount-btn:hover { border-color: var(--aksen); color: var(--aksen); background: rgba(14, 165, 233, 0.08); }
.amount-btn.selected { border-color: var(--aksen); background: var(--aksen); color: white; }

.impact-item {
    display: flex; align-items: center; gap: 1rem;
    padding: 0.9rem; border-radius: 12px;
    background: rgba(14, 165, 233, 0.06); margin-bottom: 0.6rem;
}
.impact-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; flex-shrink: 0;
}
.impact-icon i { color: var(--biru-gelap); }
.impact-item h4 { font-weight: 700; font-size: 0.88rem; color: var(--teks-gelap); margin-bottom: 0.15rem; }
.impact-item p  { font-size: 0.9rem; color: var(--teks-gelap); margin: 0; line-height: 1.4; }

.trust-badges { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
.trust-badge {
    display: flex; align-items: center; gap: 0.35rem;
    background: #F0FDF4; color: #166534;
    padding: 0.4rem 0.75rem; border-radius: 50px;
    font-size: 0.78rem; font-weight: 600;
}
.trust-badge i { color: inherit; }

.submit-btn {
    width: 100%; padding: 1rem;
    background: linear-gradient(135deg, var(--aksen), var(--biru-muda-gelap));
    color: white; border: none; border-radius: 14px;
    font-size: 1.1rem; font-weight: 700;
    cursor: pointer; font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(14, 165, 233, 0.28);
    display: flex; align-items: center; justify-content: center; gap: 0.5rem;
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(14, 165, 233, 0.38); }
.submit-btn i { color: inherit; }

.required-star {
    color: #b91c1c;
    margin-left: 0.15rem;
}

.field-note {
    margin-top: 0.35rem;
    display: block;
    color: var(--teks-muted);
    font-size: 0.82rem;
}

.form-card > p i { color: var(--biru-gelap); margin-right: 0.3em; }

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
    background: var(--latar-panel); border: none; border-radius: 50%;
    width: 32px; height: 32px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; color: var(--aksen-gelap); transition: background .2s, color .2s;
}
.qris-close i { color: inherit; }
.qris-close:hover { background: #e0f2fe; color: var(--aksen); }
.qris-nominal {
    font-size: 1.55rem; font-weight: 800; color: var(--aksen);
    margin-bottom: 0.25rem;
}
.qris-name { font-size: 0.88rem; color: var(--teks-muted); margin-bottom: 1.25rem; }
.qris-image-wrap {
    background: var(--latar-panel); border-radius: 16px;
    padding: 1rem; margin-bottom: 1rem; display: inline-block;
    border: 1px solid var(--border);
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
.qris-status.checking { background: rgba(14, 165, 233, 0.12); color: var(--aksen-gelap); }
.qris-status.success  { background: rgba(61, 122, 82, 0.18); color: #14532d; }
.qris-status i { color: inherit; }
.qris-expiry { font-size: 0.78rem; color: var(--teks-muted); margin-bottom: 0.5rem; }
.qris-info   { font-size: 0.8rem; color: var(--teks-muted); margin-top: 0.75rem; line-height: 1.5; }
</style>
@endpush

@section('content')
@php
    $qrisBadgeSrc = \App\Models\SiteContent::donasiKeuanganQrisLogoUrl($dk['form']);
@endphp
<div class="keuangan-hero">
    <a href="{{ route('donasi.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> {{ $dk['back_link'] }}
    </a>
    <h1><i class="{{ $dk['hero']['icon'] }}" aria-hidden="true"></i>{{ $dk['hero']['title'] }}</h1>
    <p>{{ $dk['hero']['lead'] }}</p>
</div>

<div class="donasi-layout">
    <!-- Info Kiri -->
    <div>
        <div class="info-card">
            <h3><i class="{{ $dk['impact']['title_icon'] }}" aria-hidden="true"></i> {{ $dk['impact']['title'] }}</h3>
            @foreach ($dk['impact']['items'] as $item)
            <div class="impact-item">
                <div class="impact-icon" style="background:{{ e($item['bg'] ?? '#ede5dc') }};"><i class="{{ e($item['icon']) }}" aria-hidden="true"></i></div>
                <div><p>{{ e($item['text']) }}</p></div>
            </div>
            @endforeach
        </div>
        <div class="info-card" style="background: {{ $dk['quote']['card_bg'] ?? '#fffaf2' }};">
            <h3><i class="{{ $dk['quote']['title_icon'] }}" aria-hidden="true"></i> {{ $dk['quote']['title'] }}</h3>
            <p style="color: var(--teks-muted); font-style: italic; line-height: 1.7; font-size: 0.95rem;">
                {{ $dk['quote']['body'] }}
            </p>
            <p style="color: var(--aksen); font-weight: 600; font-size: 0.85rem; margin-top: 0.75rem;">{{ $dk['quote']['attribution'] }}</p>
        </div>
    </div>

    <!-- Form Kanan -->
    <div class="form-card">
        <h2 style="font-size:1.4rem; color:var(--biru-gelap); margin-bottom:0.4rem;">{{ $dk['form']['title'] }}</h2>
        <p style="color:var(--teks-muted); font-size:0.9rem; margin-bottom:2rem;">{{ $dk['form']['intro'] }}</p>

        <div id="qris-badge" style="display:flex;align-items:center;gap:0.5rem;background:#fffaf2;border:1px solid var(--border);border-radius:12px;padding:0.65rem 1rem;margin-bottom:1.5rem;">
            <img src="{{ $qrisBadgeSrc }}" alt="QRIS" style="height:28px;">
            <span style="font-size:0.82rem;color:var(--teks-gelap);font-weight:600;">{{ $dk['form']['qris_badge_text'] }}</span>
        </div>

        <form id="donasi-form">
            @csrf
            <div class="form-group">
                <label>{{ $dk['fields']['nominal_fast'] }} <span class="required-star">*</span></label>
                <div class="amount-grid">
                    @foreach ($dk['form']['amounts'] as $i => $amt)
                        @php
                            $amt = (int) $amt;
                            $label = $dk['form']['amount_labels'][$i] ?? ('Rp '.number_format($amt, 0, ',', '.'));
                        @endphp
                        <button type="button" class="amount-btn" onclick="setAmount({{ $amt }},this)">{{ $label }}</button>
                    @endforeach
                </div>
                <input type="number" id="nominal" name="nominal" value="{{ old('nominal') }}"
                    min="1000" step="1000" required placeholder="{{ $dk['fields']['nominal_ph'] }}"
                    style="margin-top:0.5rem;">
                <small class="field-note">{{ $dk['fields']['nominal_note'] }}</small>
                <span id="error-nominal" class="error-msg" style="display:none;"></span>
            </div>
            <div class="form-group">
                <label>{{ $dk['fields']['nama'] }} <span class="required-star">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="{{ $dk['fields']['nama_ph'] }}">
                <span id="error-nama" class="error-msg" style="display:none;"></span>
            </div>
            <div class="form-group">
                <label>{{ $dk['fields']['email'] }} <span class="required-star">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="{{ $dk['fields']['email_ph'] }}">
                <span id="error-email" class="error-msg" style="display:none;"></span>
            </div>
            <div class="form-group">
                <label>{{ $dk['fields']['telepon'] }}</label>
                <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="{{ $dk['fields']['telepon_ph'] }}">
            </div>
            <div class="form-group">
                <label>{{ $dk['fields']['catatan'] }}</label>
                <textarea id="catatan" name="catatan" placeholder="{{ $dk['fields']['catatan_ph'] }}">{{ old('catatan') }}</textarea>
                <small class="field-note">{{ $dk['fields']['catatan_note'] }}</small>
            </div>
            <button type="button" id="btn-donasi" class="submit-btn" onclick="bayarQRIS()">
                <i class="fas fa-qrcode"></i> {{ $dk['buttons']['submit'] }}
            </button>
        </form>
        <p style="text-align:center; margin-top:1rem; font-size:0.8rem; color:var(--teks-muted);">
            <i class="fas fa-lock"></i> {{ $dk['trust_note'] }}
        </p>
    </div>
</div>

<!-- Modal QRIS -->
<div class="qris-overlay" id="qris-overlay" onclick="tutupQRIS(event)">
    <div class="qris-modal" id="qris-modal">
        <div class="qris-modal-header">
            <img src="{{ $qrisBadgeSrc }}" alt="QRIS">
            <button type="button" class="qris-close" onclick="tutupModal()" aria-label="Tutup"><i class="fas fa-times"></i></button>
        </div>

        <div id="qris-loading" style="padding:2rem 0;">
            <i class="fas fa-spinner fa-spin" style="font-size:2rem;color:var(--aksen);"></i>
            <p style="margin-top:0.75rem;color:var(--teks-muted);font-size:0.9rem;">{{ $dk['modal']['loading'] }}</p>
        </div>

        <div id="qris-content" style="display:none;">
            <div class="qris-nominal" id="qris-nominal-text"></div>
            <div class="qris-name" id="qris-nama-text"></div>
            <div class="qris-image-wrap">
                <img id="qris-img" src="" alt="QR Code QRIS">
            </div>
            <div class="qris-status waiting" id="qris-status-badge">
                <i class="fas fa-clock"></i> {{ $dk['modal']['waiting'] }}
            </div>
            <div class="qris-expiry" id="qris-expiry-text"></div>
            <div class="qris-info">
                {{ $dk['modal']['instruction_before'] }}<br>
                pilih <strong>{{ $dk['modal']['instruction_strong'] }}</strong> {{ $dk['modal']['instruction_after'] }}
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
@php
    $dkUiPayload = [
        'buttons' => $dk['buttons'],
        'errors' => $dk['errors'],
        'modal' => $dk['modal'],
    ];
@endphp
<script>
const DK_UI = @json($dkUiPayload);
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

function submitBtnHtml() {
    return '<i class="fas fa-qrcode"></i> ' + DK_UI.buttons.submit;
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
        document.getElementById('error-nominal').textContent = DK_UI.errors.nominal_min;
        document.getElementById('error-nominal').style.display = 'block';
        valid = false;
    }
    if (!nama) {
        document.getElementById('error-nama').textContent = DK_UI.errors.nama_required;
        document.getElementById('error-nama').style.display = 'block';
        valid = false;
    }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('error-email').textContent = DK_UI.errors.email_invalid;
        document.getElementById('error-email').style.display = 'block';
        valid = false;
    }
    if (!valid) return;

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + DK_UI.buttons.processing;

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
        btn.innerHTML = submitBtnHtml();

        if (data.error) {
            tutupModal();
            alert(DK_UI.errors.api_prefix + data.error);
            return;
        }

        currentOrderId = data.order_id;

        document.getElementById('qris-nominal-text').textContent = formatRupiah(data.nominal);
        document.getElementById('qris-nama-text').textContent = DK_UI.modal.prefix_nama + nama;
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
        btn.innerHTML = submitBtnHtml();
        tutupModal();
        alert(DK_UI.errors.connection);
    });
}

function startPolling(orderId) {
    stopPolling();
    pollInterval = setInterval(() => {
        const badge = document.getElementById('qris-status-badge');
        badge.className = 'qris-status checking';
        badge.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> ' + DK_UI.modal.checking;

        fetch('{{ url("donasi/midtrans/status") }}/' + orderId)
        .then(r => r.json())
        .then(res => {
            if (res.paid) {
                stopPolling();
                badge.className = 'qris-status success';
                badge.innerHTML = '<i class="fas fa-check-circle"></i> ' + DK_UI.modal.success;
                setTimeout(() => {
                    document.getElementById('redirect-order-id').value = orderId;
                    document.getElementById('redirect-form').submit();
                }, 1500);
            } else {
                badge.className = 'qris-status waiting';
                badge.innerHTML = '<i class="fas fa-clock"></i> ' + DK_UI.modal.waiting;
            }
        })
        .catch(() => {
            badge.className = 'qris-status waiting';
            badge.innerHTML = '<i class="fas fa-clock"></i> ' + DK_UI.modal.waiting;
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
