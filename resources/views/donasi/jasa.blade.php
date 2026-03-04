@extends('layouts.app')

@section('title', 'Donasi Jasa - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.jasa-hero {
    background: linear-gradient(135deg, #064e3b 0%, #059669 55%, #34d399 100%);
    border-radius: 24px;
    padding: 3.5rem 2.5rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.jasa-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 25%, rgba(255,255,255,0.1) 0%, transparent 50%);
}
.back-link {
    display: inline-flex; align-items: center; gap: 0.4rem;
    color: rgba(255,255,255,0.8); text-decoration: none;
    font-size: 0.88rem; margin-bottom: 1.5rem; transition: opacity 0.2s; position: relative;
}
.back-link:hover { opacity:1; color: white; }
.jasa-hero h1 { font-size: clamp(1.8rem,4.5vw,2.8rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.jasa-hero p  { font-size: 1.05rem; opacity: 0.9; max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative; }

.jasa-layout {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 2rem;
    align-items: start;
}
.form-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 8px 40px rgba(5,150,105,0.1);
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

/* Jenis Jasa Pilihan Grid */
.jasa-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.6rem;
    margin-bottom: 0.75rem;
}
.jasa-chip {
    padding: 0.7rem 0.5rem;
    border: 2px solid #E2E8F0;
    border-radius: 12px;
    background: white;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    font-family: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.2rem;
}
.jasa-chip:hover { border-color: #059669; background: #F0FDF4; }
.jasa-chip.selected { border-color: #059669; background: linear-gradient(135deg, #059669, #10b981); color: white; }
.jasa-chip .jasa-icon { font-size: 1.4rem; line-height: 1; }
.jasa-chip .jasa-label { font-size: 0.72rem; font-weight: 700; }

.jenis-chip-wrap {
    display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.25rem;
}
.jenis-chip {
    display: flex; align-items: center; gap: 0.4rem;
    padding: 0.5rem 0.9rem; border-radius: 50px;
    font-size: 0.82rem; font-weight: 600; border: none;
    cursor: pointer; font-family: inherit; transition: all 0.2s;
    border: 2px solid transparent;
}
.jenis-chip.green  { background: #D1FAE5; color: #065f46; }
.jenis-chip.blue   { background: #DBEAFE; color: #1E40AF; }
.jenis-chip.purple { background: #EDE9FE; color: #5B21B6; }
.jenis-chip.orange { background: #FEF3C7; color: #92400E; }
.jenis-chip.pink   { background: #FCE7F3; color: #9D174D; }

.how-item {
    display: flex; gap: 1rem; align-items: flex-start;
    margin-bottom: 1.25rem;
}
.how-num {
    width: 32px; height: 32px; min-width: 32px;
    background: linear-gradient(135deg, #059669, #10b981);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    color: white; font-weight: 800; font-size: 0.85rem;
}
.how-text h4 { font-weight: 700; color: var(--teks-gelap); margin-bottom: 0.2rem; font-size: 0.93rem; }
.how-text p  { font-size: 0.83rem; color: #64748B; line-height: 1.5; }

.submit-btn {
    width: 100%; padding: 1rem;
    background: linear-gradient(135deg, #059669, #10B981);
    color: white; border: none; border-radius: 14px;
    font-size: 1.1rem; font-weight: 700;
    cursor: pointer; font-family: inherit; transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(5,150,105,0.3);
    display: flex; align-items: center; justify-content: center; gap: 0.5rem;
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(5,150,105,0.4); }

@media (max-width: 860px) {
    .jasa-layout { grid-template-columns: 1fr; }
    .form-card { position: static; }
    .jasa-grid { grid-template-columns: repeat(3,1fr); }
}
@media (max-width: 480px) {
    .jasa-grid { grid-template-columns: repeat(2,1fr); }
}
</style>
@endpush

@section('content')
<div class="jasa-hero">
    <a href="{{ route('donasi.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Pilihan Donasi
    </a>
    <h1>🤲 Donasi Jasa & Keahlian</h1>
    <p>Waktu dan keahlian Anda adalah harta yang sangat berharga. Bagikan keduanya untuk langsung mengubah kehidupan anak-anak kami.</p>
</div>

<div class="jasa-layout">
    <!-- Info Kiri -->
    <div>
        <div class="info-card">
            <h3><i class="fas fa-star" style="color:#059669;"></i> Bidang Jasa yang Dibutuhkan</h3>
            <p style="color:#64748B; font-size:0.88rem; margin-bottom:1rem;">Kami menyambut kontribusi di berbagai bidang:</p>
            <div class="jenis-chip-wrap">
                <span class="jenis-chip green">📚 Mengajar / Tutoring</span>
                <span class="jenis-chip blue">💻 Teknologi & IT</span>
                <span class="jenis-chip purple">🎨 Seni & Desain</span>
                <span class="jenis-chip orange">🏥 Medis & Kesehatan</span>
                <span class="jenis-chip pink">🍳 Memasak & Gizi</span>
                <span class="jenis-chip green">⚽ Olahraga & Fisik</span>
                <span class="jenis-chip blue">🎵 Musik & Seni Budaya</span>
                <span class="jenis-chip purple">🔨 Konstruksi & Teknik</span>
                <span class="jenis-chip orange">💇 Kecantikan & Tata Rambut</span>
                <span class="jenis-chip pink">🤝 Konseling & Psikologi</span>
                <span class="jenis-chip green">📸 Fotografi & Videografi</span>
                <span class="jenis-chip blue">🌐 Bahasa & Komunikasi</span>
            </div>
        </div>

        <div class="info-card">
            <h3><i class="fas fa-route" style="color:#059669;"></i> Alur Donasi Jasa</h3>
            <div class="how-item"><div class="how-num">1</div><div class="how-text"><h4>Daftarkan Diri</h4><p>Isi form dengan bidang keahlian dan ketersediaan waktu Anda</p></div></div>
            <div class="how-item"><div class="how-num">2</div><div class="how-text"><h4>Konfirmasi Tim</h4><p>Pengurus akan menghubungi Anda dalam 1–2 hari untuk diskusi lebih lanjut</p></div></div>
            <div class="how-item"><div class="how-num">3</div><div class="how-text"><h4>Rencanakan Bersama</h4><p>Kami sesuaikan jadwal, target peserta, dan kebutuhan teknis</p></div></div>
            <div class="how-item" style="margin-bottom:0;"><div class="how-num">4</div><div class="how-text"><h4>Berikan Jasamu!</h4><p>Laksanakan kegiatan dan rasakan dampak nyata yang Anda buat</p></div></div>
        </div>

        <div class="info-card" style="background: linear-gradient(135deg, #F0FDF4, #DCFCE7); border: 1px solid #BBF7D0;">
            <h3><i class="fas fa-award" style="color:#059669;"></i> Apa yang Anda Dapatkan</h3>
            <ul style="list-style:none; padding:0;">
                <li style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.75rem; font-size:0.88rem; color:#065f46;">
                    <i class="fas fa-check-circle"></i> Sertifikat kontribusi sukarela
                </li>
                <li style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.75rem; font-size:0.88rem; color:#065f46;">
                    <i class="fas fa-check-circle"></i> Pengalaman nyata melayani masyarakat
                </li>
                <li style="display:flex; align-items:center; gap:0.6rem; margin-bottom:0.75rem; font-size:0.88rem; color:#065f46;">
                    <i class="fas fa-check-circle"></i> Dokumentasi kegiatan untuk portofolio
                </li>
                <li style="display:flex; align-items:center; gap:0.6rem; font-size:0.88rem; color:#065f46;">
                    <i class="fas fa-check-circle"></i> Jaringan relawan yang solid dan penuh inspirasi
                </li>
            </ul>
        </div>

        <div class="info-card" style="text-align:center; background: #F8FAFC; border: 1px dashed #CBD5E1;">
            <p style="font-size: 0.9rem; color:#64748B; margin-bottom: 0.75rem;">Ingin donasi dalam bentuk uang?</p>
            <a href="{{ route('donasi.keuangan') }}" class="btn btn-outline" style="border-color:#DC2626; color:#DC2626;">💰 Donasi Keuangan</a>
        </div>
    </div>

    <!-- Form Kanan -->
    <div class="form-card">
        <h2 style="font-size:1.4rem; color:var(--biru-gelap); margin-bottom:0.4rem;">Form Donasi Jasa</h2>
        <p style="color:#64748B; font-size:0.9rem; margin-bottom:2rem;">Ceritakan keahlian Anda untuk kami</p>

        <form action="{{ route('donasi.jasa.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Jenis Jasa yang Ditawarkan *</label>
                <div class="jasa-grid" id="jasaGrid">
                    <button type="button" class="jasa-chip" onclick="setJasa('Mengajar / Tutoring', this)">
                        <span class="jasa-icon">📚</span><span class="jasa-label">Mengajar</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Teknologi & IT', this)">
                        <span class="jasa-icon">💻</span><span class="jasa-label">Teknologi</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Medis & Kesehatan', this)">
                        <span class="jasa-icon">🏥</span><span class="jasa-label">Kesehatan</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Seni & Desain', this)">
                        <span class="jasa-icon">🎨</span><span class="jasa-label">Seni</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Memasak & Gizi', this)">
                        <span class="jasa-icon">🍳</span><span class="jasa-label">Memasak</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Olahraga & Fisik', this)">
                        <span class="jasa-icon">⚽</span><span class="jasa-label">Olahraga</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Musik & Seni Budaya', this)">
                        <span class="jasa-icon">🎵</span><span class="jasa-label">Musik</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Konseling & Psikologi', this)">
                        <span class="jasa-icon">🤝</span><span class="jasa-label">Konseling</span>
                    </button>
                    <button type="button" class="jasa-chip" onclick="setJasa('Lainnya', this)">
                        <span class="jasa-icon">✨</span><span class="jasa-label">Lainnya</span>
                    </button>
                </div>
                <input type="hidden" id="jenis_jasa" name="jenis_jasa" value="{{ old('jenis_jasa') }}">
                <input type="text" id="jenis_jasa_custom" placeholder="Atau tulis jenis jasa lainnya..."
                    style="margin-top:0.5rem;" oninput="document.getElementById('jenis_jasa').value=this.value">
                @error('jenis_jasa')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

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
                </div>
            </div>
            <div class="form-group">
                <label>Instansi / Lembaga (opsional)</label>
                <input type="text" name="instansi" value="{{ old('instansi') }}" placeholder="Nama kampus, perusahaan, komunitas, dll">
            </div>
            <div class="form-group">
                <label>Keahlian & Pengalaman *</label>
                <textarea name="keahlian" required placeholder="Ceritakan keahlian dan pengalaman relevan Anda...">{{ old('keahlian') }}</textarea>
                @error('keahlian')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal Mulai *</label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required min="{{ date('Y-m-d') }}">
                    @error('tanggal_mulai')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Durasi *</label>
                    <select name="durasi" required>
                        <option value="" disabled {{ old('durasi') ? '' : 'selected' }}>Pilih...</option>
                        <option value="1 hari" {{ old('durasi')=='1 hari'?'selected':'' }}>1 Hari</option>
                        <option value="2-3 hari" {{ old('durasi')=='2-3 hari'?'selected':'' }}>2-3 Hari</option>
                        <option value="1 minggu" {{ old('durasi')=='1 minggu'?'selected':'' }}>1 Minggu</option>
                        <option value="2-4 minggu" {{ old('durasi')=='2-4 minggu'?'selected':'' }}>2-4 Minggu</option>
                        <option value="1-3 bulan" {{ old('durasi')=='1-3 bulan'?'selected':'' }}>1-3 Bulan</option>
                        <option value="Rutin / Jangka Panjang" {{ old('durasi')=='Rutin / Jangka Panjang'?'selected':'' }}>Rutin / Jangka Panjang</option>
                    </select>
                    @error('durasi')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group">
                <label>Deskripsi Rencana Kegiatan *</label>
                <textarea name="deskripsi" required style="min-height:100px;"
                    placeholder="Jelaskan rencana kegiatan yang ingin Anda lakukan, target sasaran, metode, dll...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Catatan Tambahan</label>
                <textarea name="catatan" placeholder="Informasi lain yang perlu kami ketahui...">{{ old('catatan') }}</textarea>
            </div>
            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> Daftarkan Donasi Jasa Saya
            </button>
        </form>
        <p style="text-align:center; margin-top:1rem; font-size:0.8rem; color:#94A3B8;">
            <i class="fas fa-clock"></i> Konfirmasi dalam 1-2 hari kerja
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
function setJasa(val, btn) {
    document.querySelectorAll('.jasa-chip').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('jenis_jasa').value = val;
    document.getElementById('jenis_jasa_custom').value = val !== 'Lainnya' ? val : '';
}
</script>
@endpush
