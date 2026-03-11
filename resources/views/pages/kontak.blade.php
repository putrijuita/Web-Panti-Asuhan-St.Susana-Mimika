@extends('layouts.app')

@section('title', 'Kontak - Panti Asuhan Santa Susana Timika')

@push('styles')
<style>
.kontak-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #3730a3 50%, #6366f1 100%);
    border-radius: 24px;
    padding: 3.5rem 2.5rem;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 3rem;
}
.kontak-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 75% 25%, rgba(255,255,255,0.08) 0%, transparent 50%);
}
.kontak-hero h1 { font-size: clamp(2rem,5vw,2.8rem); font-weight: 800; margin-bottom: 1rem; position: relative; }
.kontak-hero p  { font-size: 1.05rem; opacity: 0.9; max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative; }

.kontak-layout {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 2rem;
    align-items: start;
}
.kontak-form-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 8px 40px rgba(46,134,171,0.1);
    position: sticky;
    top: 88px;
}
.kontak-form-card h2 { font-size: 1.4rem; color: var(--biru-gelap); margin-bottom: 0.4rem; }
.kontak-form-card .subtitle { color: #64748B; font-size: 0.9rem; margin-bottom: 2rem; }

.submit-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #3730a3, #6366f1);
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(99,102,241,0.3);
}
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(99,102,241,0.4); }

.kontak-info-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(46,134,171,0.08);
    margin-bottom: 1.5rem;
}
.kontak-info-card h3 { font-size: 1.05rem; color: var(--biru-gelap); margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem; }

.kontak-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    margin-bottom: 1.25rem;
    padding: 1rem;
    border-radius: 14px;
    background: #F8FAFC;
    transition: all 0.2s;
}
.kontak-item:hover { background: #EFF6FF; transform: translateX(4px); }
.kontak-item-icon {
    width: 44px; height: 44px; min-width: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    color: white;
}
.kontak-item-body h4  { font-weight: 700; font-size: 0.9rem; color: var(--teks-gelap); margin-bottom: 0.25rem; }
.kontak-item-body p   { font-size: 0.85rem; color: #64748B; line-height: 1.5; }
.kontak-item-body a   { color: var(--biru-tua); text-decoration: none; font-weight: 600; }
.kontak-item-body a:hover { text-decoration: underline; }

.sosmed-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}
.sosmed-btn {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.85rem 1rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s;
}
.sosmed-btn:hover { transform: translateY(-2px); }
.sosmed-btn.fb { background: #1877F2; color: white; }
.sosmed-btn.ig { background: linear-gradient(135deg, #833AB4, #FD1D1D, #F77737); color: white; }
.sosmed-btn.wa { background: #25D366; color: white; }
.sosmed-btn.phone { background: var(--biru-tua); color: white; }

.jam-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
}
.jam-item {
    background: #F8FAFC;
    border-radius: 10px;
    padding: 0.75rem;
    font-size: 0.85rem;
}
.jam-item .hari   { color: #64748B; }
.jam-item .waktu  { font-weight: 700; color: var(--biru-gelap); }

.faq-item {
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 0.75rem;
}
.faq-question {
    padding: 1rem 1.25rem;
    font-weight: 600;
    color: var(--teks-gelap);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    transition: background 0.2s;
    font-family: inherit;
    border: none;
    width: 100%;
    text-align: left;
    font-size: 0.95rem;
}
.faq-question:hover { background: #F8FAFC; }
.faq-answer {
    padding: 0 1.25rem;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s;
    font-size: 0.9rem;
    color: #64748B;
    line-height: 1.6;
}
.faq-answer.open { max-height: 200px; padding: 0 1.25rem 1rem; }

@media (max-width: 860px) {
    .kontak-layout { grid-template-columns: 1fr; }
    .kontak-form-card { position: static; }
    .sosmed-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="kontak-hero">
    <h1>📞 Hubungi Kami</h1>
    <p>Kami siap menjawab pertanyaan, menerima masukan, dan membantu Anda terhubung dengan Panti Asuhan Santa Susana</p>
</div>

<div class="kontak-layout">
    <!-- Kiri: Info Kontak -->
    <div>
        <!-- Info Kontak Utama -->
        <div class="kontak-info-card">
            <h3><i class="fas fa-address-book" style="color:var(--biru-tua);"></i> Informasi Kontak</h3>
            <div class="kontak-item">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, var(--biru-tua), var(--biru-muda-gelap));">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>Telepon</h4>
                    <p><a href="tel:082198595245">0821-9859-5245</a></p>
                    <p style="font-size:0.8rem; color:#94A3B8; margin-top:0.2rem;">Tersedia jam kerja</p>
                </div>
            </div>
            <div class="kontak-item">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, #1877F2, #3b5998);">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>Facebook</h4>
                    <p><a href="https://facebook.com/YayasanPeduliKasihMimika" target="_blank">Yayasan Peduli Kasih Mimika</a></p>
                    <p style="font-size:0.8rem; color:#94A3B8; margin-top:0.2rem;">Panti Asuhan Santa Susana Timika</p>
                </div>
            </div>
            <div class="kontak-item">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, #833AB4, #FD1D1D, #F77737);">
                    <i class="fab fa-instagram"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>Instagram</h4>
                    <p><a href="https://www.instagram.com/yayasanpedulikasihmimika/" target="_blank" rel="noopener noreferrer">Yayasan Peduli Kasih Mimika Panti Asuhan Santa Susana Timika</a></p>
                </div>
            </div>
            <div class="kontak-item" style="margin-bottom: 0;">
                <div class="kontak-item-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <i class="fas fa-location-dot"></i>
                </div>
                <div class="kontak-item-body">
                    <h4>Alamat</h4>
                    <p>JL.POROS SP2-SP5 GANG PETRA</p>
                    <p>KAMPUNG MINABUA, SP 2 TIMIKA, DISTRIK MIMIKA BARU</p>
                    <p>KABUPATEN MIMIKA – PROVINSI PAPUA TENGAH</p>
                </div>
            </div>
        </div>

        <!-- Sosmed Quick Links -->
        <div class="kontak-info-card">
            <h3><i class="fas fa-share-nodes" style="color:#8b5cf6;"></i> Terhubung Cepat</h3>
            <div class="sosmed-grid">
                <a href="https://facebook.com/YayasanPeduliKasihMimika" target="_blank" rel="noopener noreferrer" class="sosmed-btn fb" style="grid-column: span 2;">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <a href="https://www.instagram.com/yayasanpedulikasihmimika/" target="_blank" rel="noopener noreferrer" class="sosmed-btn ig" style="grid-column: span 2;">
                    <i class="fab fa-instagram"></i> Instagram: Yayasan Peduli Kasih Mimika Panti Asuhan Santa Susana Timika
                </a>
                <a href="tel:082198595245" class="sosmed-btn phone" style="grid-column: span 2;">
                    <i class="fas fa-phone"></i> Telepon: 0821-9859-5245
                </a>
            </div>
        </div>

        <!-- Jam Operasional -->
        <div class="kontak-info-card">
            <h3><i class="fas fa-clock" style="color:#f59e0b;"></i> Jam Operasional</h3>
            <div class="jam-grid">
                <div class="jam-item"><div class="hari">Senin - Jumat</div><div class="waktu">08.00 - 17.00</div></div>
                <div class="jam-item"><div class="hari">Sabtu</div><div class="waktu">08.00 - 14.00</div></div>
                <div class="jam-item" style="grid-column:span 2;"><div class="hari">Minggu & Hari Besar</div><div class="waktu" style="color:#ef4444;">Tutup / Sesuai Pemberitahuan</div></div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="kontak-info-card">
            <h3><i class="fas fa-circle-question" style="color:#10b981;"></i> Pertanyaan Umum</h3>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Bagaimana cara berdonasi? <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Isi form donasi di halaman Donasi dengan nama, email, dan nominal. Tim kami akan menghubungi untuk konfirmasi pembayaran.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Bolehkah donasi barang/sembako? <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Tentu saja! Silakan hubungi kami terlebih dahulu via WhatsApp untuk koordinasi jenis barang dan waktu pengiriman/pengantaran.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Berapa lama proses konfirmasi kunjungan? <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Kami akan menghubungi Anda dalam 1-2 hari kerja setelah form kunjungan diterima untuk konfirmasi dan penjadwalan.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Apakah bisa jadi relawan? <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Kami sangat terbuka untuk relawan. Hubungi kami via WhatsApp atau form kontak ini untuk membahas program kerelawanan yang sesuai.</div>
            </div>
        </div>
    </div>

    <!-- Kanan: Form Pesan -->
    <div class="kontak-form-card">
        <h2>Kirim Pesan</h2>
        <p class="subtitle">Sampaikan pertanyaan, masukan, atau informasi lainnya</p>

        <form action="{{ route('kontak.store') }}" method="POST">
            @csrf
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
                <label>Subjek / Topik *</label>
                <select name="subjek" required>
                    <option value="" disabled {{ old('subjek') ? '' : 'selected' }}>Pilih topik...</option>
                    <option value="Informasi Donasi" {{ old('subjek')=='Informasi Donasi' ? 'selected' : '' }}>Informasi Donasi</option>
                    <option value="Kunjungan" {{ old('subjek')=='Kunjungan' ? 'selected' : '' }}>Kunjungan</option>
                    <option value="Kerelawanan" {{ old('subjek')=='Kerelawanan' ? 'selected' : '' }}>Kerelawanan</option>
                    <option value="Kemitraan" {{ old('subjek')=='Kemitraan' ? 'selected' : '' }}>Kemitraan / Kerja Sama</option>
                    <option value="Program" {{ old('subjek')=='Program' ? 'selected' : '' }}>Informasi Program</option>
                    <option value="Lainnya" {{ old('subjek')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('subjek')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Pesan *</label>
                <textarea name="pesan" required placeholder="Tuliskan pesan Anda di sini..." style="min-height: 150px;">{{ old('pesan') }}</textarea>
                @error('pesan')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="submit-btn">📨 Kirim Pesan</button>
        </form>

        <div style="text-align: center; margin-top: 1.25rem; font-size: 0.82rem; color: #94A3B8;">
            <i class="fas fa-reply"></i> Kami akan membalas dalam 1-2 hari kerja
        </div>

        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #F1F5F9;">
            <p style="font-size: 0.85rem; color: #94A3B8; text-align: center; margin-bottom: 0.75rem;">Atau hubungi langsung</p>
            <div style="display: flex; gap: 0.75rem; justify-content: center;">
                <a href="tel:082198595245" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                    <i class="fas fa-phone"></i> Telepon
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleFaq(btn) {
    const answer = btn.nextElementSibling;
    const icon = btn.querySelector('.fa-chevron-down, .fa-chevron-up');
    const isOpen = answer.classList.contains('open');

    document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('open'));
    document.querySelectorAll('.faq-question i').forEach(i => {
        i.classList.remove('fa-chevron-up');
        i.classList.add('fa-chevron-down');
    });

    if (!isOpen) {
        answer.classList.add('open');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    }
}
</script>
@endpush
