@extends('layouts.app')

@section('title', 'Terima Kasih - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.thanks-wrap {
    min-height: 60vh;
    display: flex; align-items: center; justify-content: center;
    padding: 3rem 1rem;
}
.thanks-card {
    background: white;
    border-radius: 28px;
    padding: 3.5rem 3rem;
    text-align: center;
    max-width: 600px;
    width: 100%;
    box-shadow: 0 16px 60px rgba(46,134,171,0.1);
    position: relative;
    overflow: hidden;
}
.thanks-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 6px;
    background: var(--gradient, linear-gradient(135deg, #DC2626, #f97316));
}
.thanks-card-blue {
    background: linear-gradient(160deg, #f0f9ff 0%, #e0f2fe 50%, #f0f9ff 100%);
    box-shadow: 0 16px 60px rgba(14, 165, 233, 0.12);
}
.confetti-emoji {
    font-size: 4.5rem;
    display: block;
    margin-bottom: 1.5rem;
    animation: bounce 1s ease infinite alternate;
}
@keyframes bounce { from { transform: translateY(0); } to { transform: translateY(-12px); } }
.thanks-card h1 {
    font-size: 2rem; font-weight: 800;
    margin-bottom: 0.75rem; line-height: 1.2;
}
.thanks-card .sub {
    font-size: 1.05rem; color: #64748B;
    line-height: 1.7; margin-bottom: 2rem;
}
.info-box {
    border-radius: 16px;
    padding: 1.25rem 1.5rem;
    margin-bottom: 2rem;
    font-size: 0.9rem;
    line-height: 1.6;
}
.thanks-actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
.thanks-actions .btn { min-width: 160px; text-align: center; }

/* Kotak Ringkasan Donasi — unik & estetis */
.donor-summary-card {
    position: relative;
    margin: 0 auto 2rem;
    max-width: 420px;
    background: linear-gradient(145deg, #fff8f8 0%, #fff5f5 50%, #fef2f2 100%);
    border-radius: 20px;
    padding: 0;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(220, 38, 38, 0.08), 0 0 0 1px rgba(254, 202, 202, 0.5);
    text-align: left;
}
.donor-summary-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #DC2626, #ea580c);
    border-radius: 4px 0 0 4px;
}
.donor-summary-card::after {
    content: '♥';
    position: absolute;
    top: 1rem; right: 1.25rem;
    font-size: 1.25rem;
    color: rgba(220, 38, 38, 0.2);
    font-family: Georgia, serif;
}
.donor-summary-header {
    padding: 1.25rem 1.5rem 0.75rem 1.75rem;
    border-bottom: 1px dashed rgba(220, 38, 38, 0.2);
}
.donor-summary-header span {
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #b91c1c;
    opacity: 0.9;
}
.donor-summary-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem 1rem 1.75rem;
    border-bottom: 1px solid rgba(254, 202, 202, 0.6);
}
.donor-summary-row:last-of-type {
    border-bottom: none;
    padding-bottom: 1.25rem;
}
.donor-summary-row .icon-wrap {
    width: 40px; height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1rem;
}
.donor-summary-row.name .icon-wrap { background: rgba(220, 38, 38, 0.12); color: #b91c1c; }
.donor-summary-row.email .icon-wrap { background: rgba(234, 88, 12, 0.12); color: #c2410c; }
.donor-summary-row.amount .icon-wrap { background: linear-gradient(135deg, rgba(220, 38, 38, 0.15), rgba(234, 88, 12, 0.15)); color: #991b1b; }
.donor-summary-row .label {
    font-size: 0.8rem;
    color: #9f1239;
    font-weight: 600;
    margin-bottom: 0.15rem;
}
.donor-summary-row .value {
    font-size: 1rem;
    color: #7f1d1d;
    font-weight: 600;
}
.donor-summary-row.amount .value {
    font-size: 1.35rem;
    color: #991b1b;
    letter-spacing: 0.02em;
}

/* Tema biru untuk kotak donasi keuangan */
.donor-summary-card-blue {
    background: linear-gradient(145deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%) !important;
    box-shadow: 0 4px 24px rgba(14, 165, 233, 0.12), 0 0 0 1px rgba(56, 189, 248, 0.35) !important;
}
.donor-summary-card-blue::before {
    background: linear-gradient(180deg, #0ea5e9, #0284c7) !important;
}
.donor-summary-card-blue::after {
    color: rgba(14, 165, 233, 0.25) !important;
}
.donor-summary-card-blue .donor-summary-header {
    border-bottom-color: rgba(14, 165, 233, 0.25) !important;
}
.donor-summary-card-blue .donor-summary-header span {
    color: #0369a1 !important;
}
.donor-summary-card-blue .donor-summary-row {
    border-bottom-color: rgba(186, 230, 253, 0.8) !important;
}
.donor-summary-card-blue .donor-summary-row.name .icon-wrap {
    background: rgba(14, 165, 233, 0.15); color: #0369a1;
}
.donor-summary-card-blue .donor-summary-row.email .icon-wrap {
    background: rgba(2, 132, 199, 0.15); color: #0284c7;
}
.donor-summary-card-blue .donor-summary-row.amount .icon-wrap {
    background: linear-gradient(135deg, rgba(14, 165, 233, 0.2), rgba(2, 132, 199, 0.2)); color: #0c4a6e;
}
.donor-summary-card-blue .donor-summary-row .label {
    color: #0369a1;
}
.donor-summary-card-blue .donor-summary-row .value {
    color: #0c4a6e;
}
.donor-summary-card-blue .donor-summary-row.amount .value {
    color: #0c4a6e;
}
</style>
@endpush

@section('content')
<div class="thanks-wrap">
    @if($jenis === 'jasa')
    <div class="thanks-card" style="--gradient: linear-gradient(135deg, #059669, #34d399);">
        <span class="confetti-emoji">🤲</span>
        <h1 style="color: #065f46;">Terima Kasih, Relawan Hebat!</h1>
        <p class="sub">
            Donasi jasa Anda telah kami terima dengan sepenuh hati. Tim kami akan segera menghubungi Anda dalam <strong>1–2 hari kerja</strong> untuk mendiskusikan rencana kegiatan lebih lanjut.
        </p>
        <div class="info-box" style="background: #F0FDF4; color: #065f46; border: 1px solid #BBF7D0;">
            <strong>🌟 Langkah Selanjutnya:</strong><br>
            Kami akan menghubungi Anda melalui nomor telepon atau email yang telah Anda daftarkan. Mohon tetap aktif dan siap untuk berdiskusi.
        </div>
        <div class="info-box" style="background: #ECFDF5; color: #065f46; border: 1px dashed #6EE7B7;">
            <strong>🏆 Sertifikat Kontribusi</strong> akan disiapkan setelah kegiatan selesai dilaksanakan.
        </div>
        <div class="thanks-actions">
            <a href="{{ route('home') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #059669, #10B981); box-shadow: 0 4px 16px rgba(5,150,105,0.3);">🏠 Kembali ke Beranda</a>
            <a href="{{ route('donasi.index') }}" class="btn btn-outline" style="border-color:#059669; color:#059669;">🤝 Jenis Donasi Lain</a>
        </div>
    </div>
    @else
    <div class="thanks-card thanks-card-blue" style="--gradient: linear-gradient(135deg, #0ea5e9, #38bdf8);">
        <span class="confetti-emoji">🎉</span>
        <h1 style="color: #0c4a6e;">Terima Kasih atas Donasi Anda!</h1>
        @if(!empty($donasiTerimaKasih))
        <p class="sub thanks-personal" style="font-size: 1.1rem; color: #0369a1; margin-bottom: 1.5rem;">
            <strong>Terima kasih atas kebaikan Anda, semoga selalu sehat dan diberkati.</strong>
        </p>
        <div class="donor-summary-card donor-summary-card-blue">
            <div class="donor-summary-header">
                <span>Ringkasan Donasi</span>
            </div>
            <div class="donor-summary-row name">
                <div class="icon-wrap"><i class="fas fa-user"></i></div>
                <div>
                    <div class="label">Nama donatur</div>
                    <div class="value">{{ $donasiTerimaKasih['nama'] ?? '-' }}</div>
                </div>
            </div>
            <div class="donor-summary-row email">
                <div class="icon-wrap"><i class="fas fa-envelope"></i></div>
                <div>
                    <div class="label">Email</div>
                    <div class="value">{{ $donasiTerimaKasih['email'] ?? '-' }}</div>
                </div>
            </div>
            <div class="donor-summary-row amount">
                <div class="icon-wrap"><i class="fas fa-hand-holding-heart"></i></div>
                <div>
                    <div class="label">Jumlah donasi</div>
                    <div class="value">Rp {{ number_format($donasiTerimaKasih['nominal'] ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        @else
        <p class="sub">
            Kebaikan Anda telah kami catat dengan penuh rasa syukur. Setiap rupiah yang Anda berikan akan digunakan sepenuhnya untuk kebutuhan, pendidikan, dan kesehatan anak-anak kami.
        </p>
        @endif
        <div class="thanks-actions">
            <a href="{{ route('home') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #0ea5e9, #0284c7); box-shadow: 0 4px 16px rgba(14,165,233,0.35);">🏠 Kembali ke Beranda</a>
            <a href="{{ route('donasi.index') }}" class="btn btn-outline" style="border-color:#0ea5e9; color:#0284c7;">💰 Donasi Lagi</a>
        </div>
    </div>
    @endif
</div>
@endsection
