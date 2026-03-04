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
    <div class="thanks-card" style="--gradient: linear-gradient(135deg, #DC2626, #f97316);">
        <span class="confetti-emoji">🎉</span>
        <h1 style="color: #7f1d1d;">Terima Kasih atas Donasi Anda!</h1>
        <p class="sub">
            Kebaikan Anda telah kami catat dengan penuh rasa syukur. Setiap rupiah yang Anda berikan akan digunakan sepenuhnya untuk kebutuhan, pendidikan, dan kesehatan anak-anak kami.
        </p>
        <div class="info-box" style="background: #FFF5F5; color: #7f1d1d; border: 1px solid #FECACA;">
            <strong>💝 Informasi Transfer:</strong><br>
            Tim kami akan menghubungi Anda melalui email atau telepon untuk memberikan informasi rekening dan konfirmasi donasi Anda.
        </div>
        <div class="info-box" style="background: #FEF9C3; color: #713f12; border: 1px dashed #FDE68A;">
            <strong>✨ Doa & Harapan:</strong><br>
            Semoga kebaikan Anda kembali berlipat ganda. Anak-anak kami mendoakan Anda setiap hari.
        </div>
        <div class="thanks-actions">
            <a href="{{ route('home') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #DC2626, #EF4444); box-shadow: 0 4px 16px rgba(220,38,38,0.3);">🏠 Kembali ke Beranda</a>
            <a href="{{ route('donasi.index') }}" class="btn btn-outline" style="border-color:#DC2626; color:#DC2626;">💰 Donasi Lagi</a>
        </div>
    </div>
    @endif
</div>
@endsection
