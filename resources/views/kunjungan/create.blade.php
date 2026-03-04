@extends('layouts.app')

@section('title', 'Ajukan Kunjungan - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.kunjungan-hero {
    background: linear-gradient(135deg, #065f46 0%, #059669 50%, #10b981 100%);
    border-radius: 24px;
    padding: 3.5rem 2.5rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.kunjungan-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(255,255,255,0.09) 0%, transparent 50%);
}
.kunjungan-hero h1 { font-size: clamp(2rem,5vw,2.8rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.kunjungan-hero p  { font-size: 1.05rem; opacity: 0.9; max-width: 580px; margin: 0 auto; line-height: 1.7; position: relative; }

.kunjungan-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2rem;
    align-items: start;
}
.form-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 8px 40px rgba(46,134,171,0.1);
    position: sticky;
    top: 88px;
}
.info-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
    margin-bottom: 1.5rem;
}
.info-card h3 { font-size: 1.1rem; color: var(--biru-gelap); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }

.step-list { list-style: none; }
.step-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.25rem;
    align-items: flex-start;
}
.step-num {
    width: 32px; height: 32px; min-width: 32px;
    background: linear-gradient(135deg, #059669, #10b981);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 800; font-size: 0.85rem;
}
.step-text h4 { font-weight: 700; color: var(--teks-gelap); margin-bottom: 0.2rem; font-size: 0.95rem; }
.step-text p  { font-size: 0.85rem; color: #64748B; line-height: 1.5; }

.kegiatan-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-top: 1rem;
}
.kegiatan-item {
    background: #F0FDF4;
    border-radius: 10px;
    padding: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.85rem;
    color: #166534;
    font-weight: 500;
}

.submit-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #059669, #10b981);
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(5,150,105,0.3);
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(5,150,105,0.4); }

.aturan-list {
    list-style: none;
}
.aturan-list li {
    display: flex; gap: 0.5rem;
    margin-bottom: 0.6rem;
    font-size: 0.88rem;
    color: #475569;
    align-items: flex-start;
}
.aturan-list .dot {
    width: 6px; height: 6px;
    background: #059669;
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 7px;
}

@media (max-width: 860px) {
    .kunjungan-layout { grid-template-columns: 1fr; }
    .form-card { position: static; }
    .kegiatan-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="kunjungan-hero">
    <h1>🏠 Ajukan Kunjungan</h1>
    <p>Kunjungan Anda bukan hanya membawa kebahagiaan, tetapi juga menunjukkan kepada anak-anak bahwa mereka dicintai banyak orang</p>
</div>

<div class="kunjungan-layout">
    <!-- Info Kiri -->
    <div>
        <div class="info-card">
            <h3><i class="fas fa-list-check" style="color:#059669;"></i> Alur Pengajuan Kunjungan</h3>
            <ul class="step-list">
                <li class="step-item"><div class="step-num">1</div><div class="step-text"><h4>Isi Formulir</h4><p>Lengkapi data diri dan tujuan kunjungan di form ini</p></div></li>
                <li class="step-item"><div class="step-num">2</div><div class="step-text"><h4>Konfirmasi</h4><p>Tim kami akan menghubungi Anda dalam 1-2 hari kerja</p></div></li>
                <li class="step-item"><div class="step-num">3</div><div class="step-text"><h4>Persiapan</h4><p>Siapkan keperluan yang ingin dibawa atau dilakukan</p></div></li>
                <li class="step-item"><div class="step-num">4</div><div class="step-text"><h4>Kunjungi</h4><p>Datang pada hari yang telah disepakati dan bersuka cita!</p></div></li>
            </ul>
        </div>

        <div class="info-card">
            <h3><i class="fas fa-calendar-check" style="color:#059669;"></i> Kegiatan yang Bisa Dilakukan</h3>
            <p style="color: #64748B; font-size: 0.9rem; margin-bottom: 0.5rem;">Saat berkunjung, Anda dapat melakukan berbagai kegiatan bersama anak-anak:</p>
            <div class="kegiatan-grid">
                <div class="kegiatan-item">📖 Mengajar & Tutoring</div>
                <div class="kegiatan-item">🎨 Workshop Seni</div>
                <div class="kegiatan-item">⚽ Kegiatan Olahraga</div>
                <div class="kegiatan-item">🍳 Memasak Bersama</div>
                <div class="kegiatan-item">🎵 Bermusik & Bernyanyi</div>
                <div class="kegiatan-item">🎁 Berbagi Donasi</div>
            </div>
        </div>

        <div class="info-card" style="background: #FFFBEB; border: 1px solid #FDE68A;">
            <h3><i class="fas fa-circle-exclamation" style="color:#D97706;"></i> Aturan Kunjungan</h3>
            <ul class="aturan-list">
                <li><span class="dot"></span>Kunjungan hanya pada hari dan jam yang telah disepakati</li>
                <li><span class="dot"></span>Menjaga sopan santun dan sikap yang positif</li>
                <li><span class="dot"></span>Tidak membawa benda/makanan tanpa pemberitahuan</li>
                <li><span class="dot"></span>Foto/video anak hanya boleh dengan izin pengurus</li>
                <li><span class="dot"></span>Dilarang memberikan uang tunai langsung ke anak</li>
            </ul>
        </div>

        <div class="info-card" style="background: linear-gradient(135deg, #F0FDF4, #DCFCE7); border: 1px solid #BBF7D0;">
            <h3><i class="fas fa-phone" style="color:#059669;"></i> Perlu Bantuan?</h3>
            <p style="color: #166534; margin-bottom: 1rem; font-size: 0.9rem;">Hubungi kami langsung untuk informasi lebih lanjut tentang kunjungan.</p>
            <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                <a href="tel:082198595245" style="display: flex; align-items: center; gap: 0.6rem; color: #065f46; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-phone"></i> 0821-9859-5245
                </a>
                <a href="https://wa.me/6282198595245" target="_blank" style="display: flex; align-items: center; gap: 0.6rem; color: #065f46; text-decoration: none; font-weight: 600;">
                    <i class="fab fa-whatsapp"></i> Chat WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Form Kanan -->
    <div class="form-card">
        <h2 style="font-size: 1.4rem; color: var(--biru-gelap); margin-bottom: 0.4rem;">Form Kunjungan</h2>
        <p style="color: #64748B; font-size: 0.9rem; margin-bottom: 2rem;">Lengkapi data berikut dengan benar</p>

        <form action="{{ route('kunjungan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Nama Anda">
                @error('nama')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com">
                    @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx">
                    @error('telepon')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <label>Tanggal Kunjungan *</label>
                <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}" required min="{{ date('Y-m-d') }}">
                @error('tanggal_kunjungan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Instansi / Organisasi</label>
                <input type="text" name="instansi" value="{{ old('instansi') }}" placeholder="Sekolah, perusahaan, gereja, dll (opsional)">
                @error('instansi')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Keperluan Kunjungan *</label>
                <textarea name="keperluan" required placeholder="Jelaskan tujuan dan rencana kegiatan selama kunjungan...">{{ old('keperluan') }}</textarea>
                @error('keperluan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Catatan Tambahan</label>
                <textarea name="catatan" placeholder="Jumlah orang yang ikut, barang yang dibawa, dll">{{ old('catatan') }}</textarea>
                @error('catatan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="submit-btn">🏠 Kirim Permohonan Kunjungan</button>
        </form>
        <div style="text-align: center; margin-top: 1.25rem; font-size: 0.82rem; color: #94A3B8;">
            <i class="fas fa-clock"></i> Konfirmasi dalam 1-2 hari kerja
        </div>
    </div>
</div>
@endsection
