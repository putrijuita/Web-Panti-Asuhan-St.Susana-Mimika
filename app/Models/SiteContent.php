<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class SiteContent extends Model
{
    public const DEFAULT_QRIS_LOGO_URL = 'https://upload.wikimedia.org/wikipedia/commons/a/a9/QRIS_logo.svg';

    protected $fillable = [
        'nav_brand_suffix',
        'nav_beranda',
        'nav_tentang',
        'nav_anak_asuh',
        'nav_kegiatan',
        'nav_galeri',
        'nav_donasi',
        'nav_kunjungan',
        'nav_kontak',
        'site_logo',
        'site_body_background',
        'home_btn_donasi',
        'home_btn_kunjungan',
        'home_tentang_section_title',
        'home_about_image',
        'home_about_image_alt',
        'home_visual_title',
        'home_visual_subtitle',
        'home_tentang_cta_label',
        'home_kontak_title',
        'home_kontak_intro',
        'home_kontak_phone_heading',
        'home_kontak_phone_display',
        'home_kontak_phone_href',
        'home_kontak_wa_text',
        'home_kontak_wa_url',
        'home_kontak_fb_heading',
        'home_kontak_fb_text',
        'home_kontak_fb_url',
        'home_kontak_ig_heading',
        'home_kontak_ig_text',
        'home_kontak_ig_url',
        'home_kontak_addr_heading',
        'home_kontak_addr_text',
        'footer_brand_name',
        'footer_brand_desc',
        'footer_heading_menu',
        'footer_heading_kegiatan',
        'footer_heading_kontak',
        'footer_menu_beranda',
        'footer_menu_tentang',
        'footer_menu_anak_asuh',
        'footer_menu_kegiatan',
        'footer_menu_galeri',
        'footer_menu_donasi',
        'footer_menu_kunjungan',
        'footer_menu_kontak',
        'footer_kegiatan_rutin',
        'footer_kegiatan_unggulan',
        'footer_kegiatan_lainnya',
        'footer_phone_display',
        'footer_phone_href',
        'footer_fb_text',
        'footer_fb_url',
        'footer_ig_text',
        'footer_ig_url',
        'footer_address',
        'footer_sosmed_fb_url',
        'footer_sosmed_phone_href',
        'footer_sosmed_ig_url',
        'footer_copyright_left',
        'footer_copyright_right',
        'footer_navigation',
        'header_navigation',
        'donasi_keuangan_page',
        'donasi_jasa_page',
    ];

    protected $casts = [
        'donasi_keuangan_page' => 'array',
        'donasi_jasa_page' => 'array',
        'footer_navigation' => 'array',
        'header_navigation' => 'array',
    ];

    public static function defaults(): array
    {
        return [
            'nav_brand_suffix' => 'Santa Susana Timika',
            'nav_beranda' => 'Beranda',
            'nav_tentang' => 'Tentang',
            'nav_anak_asuh' => 'Anak asuh',
            'nav_kegiatan' => 'Jadwal',
            'nav_galeri' => 'Galeri',
            'nav_donasi' => 'Donasi',
            'nav_kunjungan' => 'Kunjungan',
            'nav_kontak' => 'Kontak',
            'site_logo' => null,
            'site_body_background' => null,
            'home_btn_donasi' => 'Donasi',
            'home_btn_kunjungan' => 'Kunjungan',
            'home_tentang_section_title' => 'Tentang Kami',
            'home_about_image' => null,
            'home_about_image_alt' => 'Panti Asuhan Santa Susana Timika',
            'home_visual_title' => 'Rumah Penuh Kasih',
            'home_visual_subtitle' => 'Timika, Papua Tengah',
            'home_tentang_cta_label' => 'Lihat halaman Tentang Kami',
            'home_kontak_title' => 'Hubungi Kami',
            'home_kontak_intro' => 'Untuk pertanyaan umum, koordinasi donasi, atau rencana kunjungan, silakan hubungi kami pada jam kerja melalui saluran di bawah ini.',
            'home_kontak_phone_heading' => 'Telepon / WhatsApp',
            'home_kontak_phone_display' => '0821-9859-5245',
            'home_kontak_phone_href' => 'tel:082198595245',
            'home_kontak_wa_text' => 'Chat WhatsApp',
            'home_kontak_wa_url' => 'https://wa.me/6282198595245',
            'home_kontak_fb_heading' => 'Facebook',
            'home_kontak_fb_text' => 'Yayasan Peduli Kasih Mimika',
            'home_kontak_fb_url' => 'https://facebook.com/YayasanPeduliKasihMimika',
            'home_kontak_ig_heading' => 'Instagram',
            'home_kontak_ig_text' => 'Yayasan Peduli Kasih Mimika — Panti Asuhan Santa Susana Timika',
            'home_kontak_ig_url' => 'https://www.instagram.com/yayasanpedulikasihmimika',
            'home_kontak_addr_heading' => 'Alamat',
            'home_kontak_addr_text' => 'Timika, Kabupaten Mimika, Papua Tengah',
            'footer_brand_name' => 'Panti Asuhan Santa Susana',
            'footer_brand_desc' => 'Yayasan Peduli Kasih Mimika – Panti Asuhan Santa Susana Timika. Merawat, mendidik, dan memberdayakan anak-anak dengan penuh kasih di Timika, Papua Tengah.',
            'footer_heading_menu' => 'Menu',
            'footer_heading_kegiatan' => 'Jadwal',
            'footer_heading_kontak' => 'Kontak',
            'footer_menu_beranda' => 'Beranda',
            'footer_menu_tentang' => 'Tentang Kami',
            'footer_menu_anak_asuh' => 'Data anak asuh',
            'footer_menu_kegiatan' => 'Jadwal kegiatan anak',
            'footer_menu_galeri' => 'Galeri',
            'footer_menu_donasi' => 'Donasi',
            'footer_menu_kunjungan' => 'Kunjungan',
            'footer_menu_kontak' => 'Kontak',
            'footer_kegiatan_rutin' => 'Lihat jadwal di /program',
            'footer_kegiatan_unggulan' => 'Program Unggulan',
            'footer_kegiatan_lainnya' => 'Program Lainnya',
            'footer_phone_display' => '0821-9859-5245',
            'footer_phone_href' => 'tel:082198595245',
            'footer_fb_text' => 'Yayasan Peduli Kasih Mimika',
            'footer_fb_url' => 'https://facebook.com/YayasanPeduliKasihMimika',
            'footer_ig_text' => 'Yayasan Peduli Kasih Mimika Panti Asuhan Santa Susana Timika',
            'footer_ig_url' => 'https://www.instagram.com/yayasanpedulikasihmimika/',
            'footer_address' => 'Timika, Kab. Mimika, Papua Tengah',
            'footer_sosmed_fb_url' => 'https://facebook.com/YayasanPeduliKasihMimika',
            'footer_sosmed_phone_href' => 'tel:082198595245',
            'footer_sosmed_ig_url' => 'https://www.instagram.com/yayasanpedulikasihmimika/',
            'footer_copyright_left' => 'Yayasan Peduli Kasih Mimika — Panti Asuhan Santa Susana Timika',
            'footer_copyright_right' => 'Untuk anak-anak Papua Tengah',
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    /** @return \stdClass|self */
    public static function resolved(): object
    {
        $defaults = static::defaults();

        if (! Schema::hasTable('site_contents')) {
            return (object) $defaults;
        }

        $content = static::query()->find(1);
        if (! $content) {
            return (object) $defaults;
        }

        foreach ($defaults as $key => $value) {
            if (blank($content->{$key})) {
                $content->{$key} = $value;
            }
        }

        return $content;
    }

    public static function aboutImageUrl(?string $path): string
    {
        if (blank($path)) {
            return asset('images/panti-gedung.png');
        }
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return asset('storage/'.ltrim($path, '/'));
    }

    /**
     * URL gambar latar tubuh (situs publik, panel admin, halaman login admin).
     * Prioritas: unggahan CMS → path di .env / config branding.body_background.
     */
    public static function bodyBackgroundUrl(): string
    {
        if (Schema::hasTable('site_contents') && Schema::hasColumn('site_contents', 'site_body_background')) {
            $path = static::singleton()->site_body_background;
            if (filled($path)) {
                if (filter_var($path, FILTER_VALIDATE_URL)) {
                    return $path;
                }

                return asset('storage/'.ltrim((string) $path, '/'));
            }
        }

        $configPath = config('branding.body_background');

        return ($configPath !== null && $configPath !== '') ? asset(ltrim((string) $configPath, '/')) : '';
    }

    /** URL logo situs (nav, footer, favicon). Null jika belum diunggah. */
    public static function siteLogoUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return asset('storage/'.ltrim($path, '/'));
    }

    /** @return array<string, mixed> */
    public static function donasiKeuanganPageDefaults(): array
    {
        return [
            'page_title' => 'Donasi Keuangan - Panti Asuhan Santa Susana Timika',
            'back_link' => 'Kembali ke Pilihan Donasi',
            'hero' => [
                'icon' => 'fas fa-coins',
                'title' => 'Donasi keuangan',
                'lead' => 'Setiap rupiah yang Anda berikan digunakan 100% untuk kebutuhan, pendidikan, dan kesehatan anak-anak kami di Timika.',
            ],
            'impact' => [
                'title' => 'Dampak Nyata Donasi Anda',
                'title_icon' => 'fas fa-heart',
                'items' => [
                    ['icon' => 'fas fa-utensils', 'bg' => '#ede5dc', 'text' => 'Makan bergizi anak'],
                    ['icon' => 'fas fa-book', 'bg' => '#ede5dc', 'text' => 'Buku dan alat tulis'],
                    ['icon' => 'fas fa-graduation-cap', 'bg' => '#e8dfd1', 'text' => 'Pakaian sekolah'],
                    ['icon' => 'fas fa-notes-medical', 'bg' => '#efe8dd', 'text' => 'Biaya kesehatan anak'],
                ],
            ],
            'quote' => [
                'card_bg' => '#fffaf2',
                'title' => 'Pesan dari Panti',
                'title_icon' => 'fas fa-quote-left',
                'body' => '"Donasi Anda bukan sekadar angka — ia adalah senyum di pagi hari, buku yang dibuka dengan semangat, dan mimpi yang berani diperjuangkan."',
                'attribution' => '— Panti Asuhan Santa Susana',
            ],
            'form' => [
                'title' => 'Form Donasi Keuangan',
                'intro' => 'Lengkapi data berikut untuk melanjutkan donasi dengan QRIS',
                'qris_logo_url' => self::DEFAULT_QRIS_LOGO_URL,
                'qris_logo_storage' => null,
                'qris_badge_text' => 'Pembayaran via QRIS — scan & bayar instan',
                'amounts' => [10000, 50000, 100000, 250000, 500000, 1000000],
                'amount_labels' => ['Rp 10.000', 'Rp 50.000', 'Rp 100.000', 'Rp 250.000', 'Rp 500.000', 'Rp 1 Juta'],
            ],
            'fields' => [
                'nominal_fast' => 'Pilih Nominal Cepat',
                'nominal_note' => 'Nominal minimum Rp 1.000. Anda dapat memilih nominal cepat atau isi manual.',
                'nama' => 'Nama Lengkap',
                'email' => 'Email',
                'telepon' => 'Nomor Telepon (opsional)',
                'telepon_ph' => '08xxxxxxxxxx (aktif WhatsApp)',
                'catatan' => 'Pesan / Doa untuk Anak-Anak (opsional)',
                'catatan_note' => 'Opsional, maksimal 1000 karakter.',
                'nama_ph' => 'Contoh: Maria Yosephine',
                'nominal_ph' => 'Atau masukkan nominal lainnya...',
                'catatan_ph' => 'Tuliskan pesan atau doa tulus Anda...',
                'email_ph' => 'email@contoh.com',
            ],
            'buttons' => [
                'submit' => 'Bayar dengan QRIS',
                'processing' => 'Memproses...',
            ],
            'trust_note' => 'Pembayaran aman diproses oleh Midtrans',
            'modal' => [
                'loading' => 'Membuat kode QRIS...',
                'waiting' => 'Menunggu pembayaran...',
                'checking' => 'Memeriksa pembayaran...',
                'success' => 'Pembayaran berhasil! Mengalihkan...',
                'instruction_before' => 'Buka aplikasi e-wallet atau m-banking Anda',
                'instruction_strong' => 'Scan QR / QRIS',
                'instruction_after' => 'lalu scan kode di atas',
                'prefix_nama' => 'Donasi atas nama: ',
            ],
            'errors' => [
                'nominal_min' => 'Nominal minimal Rp 1.000',
                'nama_required' => 'Nama lengkap wajib diisi',
                'email_invalid' => 'Email tidak valid',
                'connection' => 'Koneksi gagal. Silakan coba lagi.',
                'api_prefix' => 'Terjadi kesalahan: ',
            ],
        ];
    }

    /** @return array<string, mixed> */
    public static function resolvedDonasiKeuanganPage(): array
    {
        $defaults = static::donasiKeuanganPageDefaults();

        if (! Schema::hasTable('site_contents')) {
            return $defaults;
        }

        if (! Schema::hasColumn('site_contents', 'donasi_keuangan_page')) {
            return $defaults;
        }

        $stored = static::query()->value('donasi_keuangan_page');
        if (! is_array($stored)) {
            return $defaults;
        }

        return array_replace_recursive($defaults, $stored);
    }

    /** @param  array<string, mixed>  $form */
    public static function donasiKeuanganQrisLogoUrl(array $form): string
    {
        $path = $form['qris_logo_storage'] ?? null;
        if (filled($path) && is_string($path) && ! str_starts_with($path, 'http')) {
            return asset('storage/'.ltrim($path, '/'));
        }

        $url = $form['qris_logo_url'] ?? null;

        return (filled($url) && is_string($url)) ? $url : self::DEFAULT_QRIS_LOGO_URL;
    }

    /**
     * @return array<string, mixed>
     */
    public static function donasiKeuanganValidationRules(): array
    {
        $rules = [
            'dk' => ['required', 'array'],
            'dk.page_title' => ['required', 'string', 'max:200'],
            'dk.back_link' => ['required', 'string', 'max:120'],
            'dk.hero' => ['required', 'array'],
            'dk.hero.icon' => ['required', 'string', 'max:80'],
            'dk.hero.title' => ['required', 'string', 'max:120'],
            'dk.hero.lead' => ['required', 'string', 'max:800'],
            'dk.impact' => ['required', 'array'],
            'dk.impact.title' => ['required', 'string', 'max:160'],
            'dk.impact.title_icon' => ['required', 'string', 'max:80'],
            'dk.impact.items' => ['required', 'array', 'size:4'],
            'dk.quote' => ['required', 'array'],
            'dk.quote.card_bg' => ['nullable', 'string', 'max:24'],
            'dk.quote.title' => ['required', 'string', 'max:120'],
            'dk.quote.title_icon' => ['required', 'string', 'max:80'],
            'dk.quote.body' => ['required', 'string', 'max:1200'],
            'dk.quote.attribution' => ['required', 'string', 'max:160'],
            'dk.form' => ['required', 'array'],
            'dk.form.title' => ['required', 'string', 'max:160'],
            'dk.form.intro' => ['required', 'string', 'max:400'],
            'dk.form.qris_logo_url' => ['nullable', 'string', 'max:500'],
            'dk.form.qris_logo_storage' => ['nullable', 'string', 'max:500'],
            'dk.form.qris_badge_text' => ['required', 'string', 'max:240'],
            'dk.form.amounts' => ['required', 'array', 'size:6'],
            'dk.form.amount_labels' => ['required', 'array', 'size:6'],
            'dk.fields' => ['required', 'array'],
            'dk.buttons' => ['required', 'array'],
            'dk.trust_note' => ['required', 'string', 'max:240'],
            'dk.modal' => ['required', 'array'],
            'dk.errors' => ['required', 'array'],
        ];

        foreach (range(0, 3) as $i) {
            $rules['dk.impact.items.'.$i] = ['required', 'array'];
            $rules['dk.impact.items.'.$i.'.icon'] = ['required', 'string', 'max:80'];
            $rules['dk.impact.items.'.$i.'.bg'] = ['nullable', 'string', 'max:24'];
            $rules['dk.impact.items.'.$i.'.text'] = ['required', 'string', 'max:240'];
        }

        foreach (range(0, 5) as $i) {
            $rules['dk.form.amounts.'.$i] = ['required', 'integer', 'min:1000', 'max:1000000000'];
            $rules['dk.form.amount_labels.'.$i] = ['required', 'string', 'max:40'];
        }

        $fieldKeys = [
            'nominal_fast', 'nominal_note', 'nama', 'email', 'telepon', 'telepon_ph',
            'catatan', 'catatan_note', 'nama_ph', 'nominal_ph', 'catatan_ph', 'email_ph',
        ];
        foreach ($fieldKeys as $key) {
            $rules['dk.fields.'.$key] = ['required', 'string', 'max:240'];
        }

        $rules['dk.buttons.submit'] = ['required', 'string', 'max:80'];
        $rules['dk.buttons.processing'] = ['required', 'string', 'max:80'];

        $modalKeys = [
            'loading', 'waiting', 'checking', 'success',
            'instruction_before', 'instruction_strong', 'instruction_after', 'prefix_nama',
        ];
        foreach ($modalKeys as $key) {
            $rules['dk.modal.'.$key] = ['required', 'string', 'max:400'];
        }

        $errorKeys = ['nominal_min', 'nama_required', 'email_invalid', 'connection', 'api_prefix'];
        foreach ($errorKeys as $key) {
            $rules['dk.errors.'.$key] = ['required', 'string', 'max:400'];
        }

        return $rules;
    }

    /** @return array<string, mixed> */
    public static function donasiJasaPageDefaults(): array
    {
        return [
            'page_title' => 'Donasi Jasa - Panti Asuhan Santa Susana Timika',
            'back_link' => 'Kembali ke Pilihan Donasi',
            'hero' => [
                'title' => '🤲 Donasi Jasa & Keahlian',
                'lead' => 'Waktu dan keahlian Anda adalah harta yang sangat berharga. Bagikan keduanya untuk langsung mengubah kehidupan anak-anak kami.',
            ],
            'explain' => [
                'title' => 'Apa itu Donasi Jasa?',
                'title_icon' => 'fas fa-info-circle',
                'list_icon' => 'fas fa-check',
                'items' => [
                    ['prefix' => 'Donasi jasa merupakan kegiatan kunjungan yang dilakukan secara ', 'strong' => 'rutin dan terjadwal', 'suffix' => '.'],
                    ['prefix' => 'Kegiatan ini memiliki ', 'strong' => 'timeline atau jadwal kegiatan', 'suffix' => ' yang telah dipilih dan disusun oleh panti.'],
                    ['prefix' => 'Pengunjung atau relawan yang mendaftar pada halaman ini ', 'strong' => 'mengikuti rangkaian kegiatan', 'suffix' => ' yang telah disusun sebelumnya.'],
                ],
            ],
            'bidang' => [
                'title' => 'Bidang Jasa yang Dibutuhkan',
                'title_icon' => 'fas fa-star',
                'intro' => 'Kami menyambut kontribusi di berbagai bidang:',
                'chips' => [
                    ['label' => '📚 Mengajar / Tutoring', 'style' => 'green'],
                    ['label' => '💻 Teknologi & IT', 'style' => 'blue'],
                    ['label' => '🎨 Seni & Desain', 'style' => 'purple'],
                    ['label' => '🏥 Medis & Kesehatan', 'style' => 'orange'],
                    ['label' => '🍳 Memasak & Gizi', 'style' => 'pink'],
                    ['label' => '⚽ Olahraga & Fisik', 'style' => 'green'],
                    ['label' => '🎵 Musik & Seni Budaya', 'style' => 'blue'],
                    ['label' => '🔨 Konstruksi & Teknik', 'style' => 'purple'],
                    ['label' => '💇 Kecantikan & Tata Rambut', 'style' => 'orange'],
                    ['label' => '🤝 Konseling & Psikologi', 'style' => 'pink'],
                    ['label' => '📸 Fotografi & Videografi', 'style' => 'green'],
                    ['label' => '🌐 Bahasa & Komunikasi', 'style' => 'blue'],
                ],
            ],
            'alur' => [
                'title' => 'Alur Donasi Jasa',
                'title_icon' => 'fas fa-route',
                'steps' => [
                    ['num' => '1', 'title' => 'Daftarkan Diri', 'body' => 'Isi form dengan bidang keahlian dan ketersediaan waktu Anda'],
                    ['num' => '2', 'title' => 'Konfirmasi Tim', 'body' => 'Pengurus akan menghubungi Anda dalam 1–2 hari untuk diskusi lebih lanjut'],
                    ['num' => '3', 'title' => 'Rencanakan Bersama', 'body' => 'Kami sesuaikan jadwal, target peserta, dan kebutuhan teknis'],
                    ['num' => '4', 'title' => 'Berikan Jasamu!', 'body' => 'Laksanakan kegiatan dan rasakan dampak nyata yang Anda buat'],
                ],
            ],
            'benefits' => [
                'title' => 'Apa yang Anda Dapatkan',
                'title_icon' => 'fas fa-award',
                'card_style' => 'linear-gradient(135deg, #F0FDF4, #DCFCE7)',
                'border' => '1px solid #BBF7D0',
                'items' => [
                    'Sertifikat kontribusi sukarela',
                    'Pengalaman nyata melayani masyarakat',
                    'Dokumentasi kegiatan untuk portofolio',
                    'Jaringan relawan yang solid dan penuh inspirasi',
                ],
            ],
            'form' => [
                'title' => 'Form Donasi Jasa',
                'intro' => 'Ceritakan keahlian Anda untuk kami',
                'durasi_placeholder' => 'Pilih...',
                'chips' => [
                    ['value' => 'Mengajar / Tutoring', 'icon' => '📚', 'label' => 'Mengajar'],
                    ['value' => 'Teknologi & IT', 'icon' => '💻', 'label' => 'Teknologi'],
                    ['value' => 'Medis & Kesehatan', 'icon' => '🏥', 'label' => 'Kesehatan'],
                    ['value' => 'Seni & Desain', 'icon' => '🎨', 'label' => 'Seni'],
                    ['value' => 'Memasak & Gizi', 'icon' => '🍳', 'label' => 'Memasak'],
                    ['value' => 'Olahraga & Fisik', 'icon' => '⚽', 'label' => 'Olahraga'],
                    ['value' => 'Musik & Seni Budaya', 'icon' => '🎵', 'label' => 'Musik'],
                    ['value' => 'Konseling & Psikologi', 'icon' => '🤝', 'label' => 'Konseling'],
                    ['value' => 'Lainnya', 'icon' => '✨', 'label' => 'Lainnya'],
                ],
                'durasi_options' => [
                    ['value' => '1 hari', 'label' => '1 Hari'],
                    ['value' => '2-3 hari', 'label' => '2-3 Hari'],
                    ['value' => '1 minggu', 'label' => '1 Minggu'],
                    ['value' => '2-4 minggu', 'label' => '2-4 Minggu'],
                    ['value' => '1-3 bulan', 'label' => '1-3 Bulan'],
                    ['value' => 'Rutin / Jangka Panjang', 'label' => 'Rutin / Jangka Panjang'],
                ],
            ],
            'fields' => [
                'jenis_label' => 'Jenis Jasa yang Ditawarkan *',
                'jenis_custom_ph' => 'Atau tulis jenis jasa lainnya...',
                'nama' => 'Nama Lengkap *',
                'nama_ph' => 'Nama Anda',
                'email' => 'Email *',
                'email_ph' => 'email@contoh.com',
                'telepon' => 'Telepon',
                'telepon_ph' => '08xxxxxxxxxx',
                'instansi' => 'Instansi / Lembaga (opsional)',
                'instansi_ph' => 'Nama kampus, perusahaan, komunitas, dll',
                'keahlian' => 'Keahlian & Pengalaman *',
                'keahlian_ph' => 'Ceritakan keahlian dan pengalaman relevan Anda...',
                'tanggal_mulai' => 'Tanggal Mulai *',
                'durasi' => 'Durasi *',
                'deskripsi' => 'Deskripsi Rencana Kegiatan *',
                'deskripsi_ph' => 'Jelaskan rencana kegiatan yang ingin Anda lakukan, target sasaran, metode, dll...',
                'catatan' => 'Catatan Tambahan',
                'catatan_ph' => 'Informasi lain yang perlu kami ketahui...',
            ],
            'buttons' => [
                'submit' => 'Daftarkan Donasi Jasa Saya',
            ],
            'footer_note' => 'Konfirmasi dalam 1-2 hari kerja',
        ];
    }

    /** @return array<string, mixed> */
    public static function resolvedDonasiJasaPage(): array
    {
        $defaults = static::donasiJasaPageDefaults();

        if (! Schema::hasTable('site_contents')) {
            return $defaults;
        }

        if (! Schema::hasColumn('site_contents', 'donasi_jasa_page')) {
            return $defaults;
        }

        $stored = static::query()->value('donasi_jasa_page');
        if (! is_array($stored)) {
            return $defaults;
        }

        return array_replace_recursive($defaults, $stored);
    }

    /**
     * @return array<string, mixed>
     */
    public static function donasiJasaValidationRules(): array
    {
        $rules = [
            'dj' => ['required', 'array'],
            'dj.page_title' => ['required', 'string', 'max:200'],
            'dj.back_link' => ['required', 'string', 'max:120'],
            'dj.hero' => ['required', 'array'],
            'dj.hero.title' => ['required', 'string', 'max:200'],
            'dj.hero.lead' => ['required', 'string', 'max:800'],
            'dj.explain' => ['required', 'array'],
            'dj.explain.title' => ['required', 'string', 'max:160'],
            'dj.explain.title_icon' => ['required', 'string', 'max:80'],
            'dj.explain.list_icon' => ['required', 'string', 'max:80'],
            'dj.explain.items' => ['required', 'array', 'size:3'],
            'dj.bidang' => ['required', 'array'],
            'dj.bidang.title' => ['required', 'string', 'max:160'],
            'dj.bidang.title_icon' => ['required', 'string', 'max:80'],
            'dj.bidang.intro' => ['required', 'string', 'max:400'],
            'dj.bidang.chips' => ['required', 'array', 'size:12'],
            'dj.alur' => ['required', 'array'],
            'dj.alur.title' => ['required', 'string', 'max:160'],
            'dj.alur.title_icon' => ['required', 'string', 'max:80'],
            'dj.alur.steps' => ['required', 'array', 'size:4'],
            'dj.benefits' => ['required', 'array'],
            'dj.benefits.title' => ['required', 'string', 'max:160'],
            'dj.benefits.title_icon' => ['required', 'string', 'max:80'],
            'dj.benefits.card_style' => ['required', 'string', 'max:240'],
            'dj.benefits.border' => ['required', 'string', 'max:120'],
            'dj.benefits.items' => ['required', 'array', 'size:4'],
            'dj.form' => ['required', 'array'],
            'dj.form.title' => ['required', 'string', 'max:160'],
            'dj.form.intro' => ['required', 'string', 'max:400'],
            'dj.form.durasi_placeholder' => ['required', 'string', 'max:80'],
            'dj.form.chips' => ['required', 'array', 'size:9'],
            'dj.form.durasi_options' => ['required', 'array', 'size:6'],
            'dj.fields' => ['required', 'array'],
            'dj.buttons' => ['required', 'array'],
            'dj.footer_note' => ['required', 'string', 'max:200'],
        ];

        foreach (range(0, 2) as $i) {
            $rules['dj.explain.items.'.$i] = ['required', 'array'];
            $rules['dj.explain.items.'.$i.'.prefix'] = ['required', 'string', 'max:400'];
            $rules['dj.explain.items.'.$i.'.strong'] = ['required', 'string', 'max:200'];
            $rules['dj.explain.items.'.$i.'.suffix'] = ['nullable', 'string', 'max:400'];
        }

        foreach (range(0, 11) as $i) {
            $rules['dj.bidang.chips.'.$i] = ['required', 'array'];
            $rules['dj.bidang.chips.'.$i.'.label'] = ['required', 'string', 'max:160'];
            $rules['dj.bidang.chips.'.$i.'.style'] = ['required', 'in:green,blue,purple,orange,pink'];
        }

        foreach (range(0, 3) as $i) {
            $rules['dj.alur.steps.'.$i] = ['required', 'array'];
            $rules['dj.alur.steps.'.$i.'.num'] = ['required', 'string', 'max:8'];
            $rules['dj.alur.steps.'.$i.'.title'] = ['required', 'string', 'max:120'];
            $rules['dj.alur.steps.'.$i.'.body'] = ['required', 'string', 'max:500'];
        }

        foreach (range(0, 3) as $i) {
            $rules['dj.benefits.items.'.$i] = ['required', 'string', 'max:300'];
        }

        foreach (range(0, 8) as $i) {
            $rules['dj.form.chips.'.$i] = ['required', 'array'];
            $rules['dj.form.chips.'.$i.'.value'] = ['required', 'string', 'max:120'];
            $rules['dj.form.chips.'.$i.'.icon'] = ['required', 'string', 'max:32'];
            $rules['dj.form.chips.'.$i.'.label'] = ['required', 'string', 'max:48'];
        }

        foreach (range(0, 5) as $i) {
            $rules['dj.form.durasi_options.'.$i] = ['required', 'array'];
            $rules['dj.form.durasi_options.'.$i.'.value'] = ['required', 'string', 'max:100'];
            $rules['dj.form.durasi_options.'.$i.'.label'] = ['required', 'string', 'max:100'];
        }

        $fieldKeys = [
            'jenis_label', 'jenis_custom_ph', 'nama', 'nama_ph', 'email', 'email_ph',
            'telepon', 'telepon_ph', 'instansi', 'instansi_ph', 'keahlian', 'keahlian_ph',
            'tanggal_mulai', 'durasi', 'deskripsi', 'deskripsi_ph', 'catatan', 'catatan_ph',
        ];
        foreach ($fieldKeys as $key) {
            $rules['dj.fields.'.$key] = ['required', 'string', 'max:240'];
        }

        $rules['dj.buttons.submit'] = ['required', 'string', 'max:120'];

        return $rules;
    }

    /** Format JSON footer navigasi (tersimpan di <code>footer_navigation</code>). */
    public const FOOTER_NAV_VERSION = 2;

    public const FOOTER_MENU_ITEMS_MAX = 25;

    public const FOOTER_KEGIATAN_ITEMS_MAX = 15;

    public const FOOTER_SOCIAL_ITEMS_MAX = 12;

    public const FOOTER_CONTACT_ITEMS_MAX = 15;

    /**
     * Rute bernama halaman publik yang boleh dipilih untuk tautan footer (dropdown CMS).
     *
     * @return array<string, string>
     */
    public static function footerPublicRouteOptions(): array
    {
        return [
            'home' => 'Beranda (/)',
            'tentang' => 'Tentang Kami (/tentang)',
            'anak-asuh' => 'Data anak asuh (/anak-asuh)',
            'program' => 'Kegiatan / jadwal (/program)',
            'program.unggulan' => 'Program unggulan',
            'program.lainnya' => 'Program lainnya',
            'galeri' => 'Galeri (/galeri)',
            'kontak' => 'Kontak (/kontak)',
            'donasi.index' => 'Donasi — beranda (/donasi)',
            'donasi.keuangan' => 'Donasi keuangan',
            'kunjungan.create' => 'Kunjungan (form)',
        ];
    }

    /** @return list<string> */
    public static function footerPublicRouteNames(): array
    {
        return array_keys(self::footerPublicRouteOptions());
    }

    /** @return list<string> */
    public static function footerContactItemTypes(): array
    {
        return ['preset_phone', 'preset_fb', 'preset_ig', 'preset_address', 'custom_link', 'custom_plain'];
    }

    public static function coerceFooterNavigationForAdmin(?array $stored, object $site, bool $includeAnakAsuhMenu): array
    {
        return self::resolvedFooterNavigationStructure($stored, $site, $includeAnakAsuhMenu);
    }

    /**
     * @param  array<string, mixed>|null  $storedRaw
     * @return array<string, mixed>
     */
    public static function resolvedFooterNavigationStructure(?array $storedRaw, object $site, bool $includeAnakAsuhMenu): array
    {
        $stored = is_array($storedRaw) ? $storedRaw : [];
        if (($stored['v'] ?? null) !== self::FOOTER_NAV_VERSION || self::footerNavigationLooksLikeLegacyV1($stored)) {
            $stored = self::migrateFooterNavigationFromLegacyV1($stored, $site, $includeAnakAsuhMenu);
        }
        if (($stored['menu_items'] ?? []) === []) {
            $stored = self::defaultFooterNavigationV2($site, $includeAnakAsuhMenu);
        }
        $stored['v'] = self::FOOTER_NAV_VERSION;

        return self::ensureFooterNavigationSections($stored);
    }

    /** @param  array<string, mixed>  $stored */
    public static function footerNavigationLooksLikeLegacyV1(array $stored): bool
    {
        if (isset($stored['social_slots'])) {
            return true;
        }
        if (isset($stored['contact_slots'])) {
            return true;
        }
        $firstMenu = (($stored['menu_items'] ?? [])[0] ?? null);
        if (is_array($firstMenu) && isset($firstMenu['slug']) && ! isset($firstMenu['label'])) {
            return true;
        }

        return false;
    }

    /**
     * Migrasi struktur penyimpanan lama (slot/slug v1) ke format v2.
     *
     * @param  array<string, mixed>  $stored
     * @return array<string, mixed>
     */
    public static function migrateFooterNavigationFromLegacyV1(array $stored, object $site, bool $includeAnakAsuhMenu): array
    {
        $menuOut = [];
        foreach ($stored['menu_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $slug = (string) ($row['slug'] ?? '');
            if ($slug === 'anak_asuh' && ! $includeAnakAsuhMenu) {
                continue;
            }
            $label = trim((string) ($row['label'] ?? ''));
            if ($label === '' && $slug !== '') {
                $label = self::footerMenuLabelForSlug($site, $slug);
            }
            if ($label === '') {
                $label = $slug !== '' ? $slug : 'Menu';
            }
            $menuOut[] = [
                'label' => $label,
                'href_type' => in_array(($row['href_type'] ?? 'route'), ['route', 'url'], true) ? $row['href_type'] : 'route',
                'route' => (string) ($row['route'] ?? ''),
                'href' => (string) ($row['href'] ?? ''),
                'icon' => isset($row['icon']) && is_string($row['icon']) && $row['icon'] !== ''
                    ? $row['icon']
                    : 'fas fa-chevron-right fa-xs',
            ];
        }

        $kegiatanOut = [];
        foreach ($stored['kegiatan_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $label = trim((string) ($row['label'] ?? ''));
            if ($label === '') {
                $label = (string) ($site->footer_kegiatan_rutin ?? 'Kegiatan');
            }
            $kegiatanOut[] = [
                'label' => $label,
                'href_type' => in_array(($row['href_type'] ?? 'route'), ['route', 'url'], true) ? $row['href_type'] : 'route',
                'route' => (string) ($row['route'] ?? ''),
                'href' => (string) ($row['href'] ?? ''),
                'icon' => isset($row['icon']) && is_string($row['icon']) && $row['icon'] !== ''
                    ? $row['icon']
                    : 'fas fa-chevron-right fa-xs',
            ];
        }

        $slotHref = [
            'facebook' => (string) ($site->footer_sosmed_fb_url ?? ''),
            'phone' => (string) ($site->footer_sosmed_phone_href ?? ''),
            'instagram' => (string) ($site->footer_sosmed_ig_url ?? ''),
        ];

        $socialOut = [];
        foreach ($stored['social_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $socialOut[] = [
                'url' => (string) ($row['url'] ?? ''),
                'icon' => isset($row['icon']) && is_string($row['icon']) ? $row['icon'] : 'fab fa-link',
                'title' => (string) ($row['title'] ?? ''),
            ];
        }

        if ($socialOut === [] && isset($stored['social_slots'])) {
            foreach ($stored['social_slots'] ?? [] as $row) {
                if (! is_array($row)) {
                    continue;
                }
                $slot = (string) ($row['slot'] ?? '');
                $socialOut[] = [
                    'url' => (string) ($slotHref[$slot] ?? ''),
                    'icon' => isset($row['icon']) && is_string($row['icon']) ? $row['icon'] : 'fab fa-link',
                    'title' => (string) ($row['title'] ?? ''),
                ];
            }
        }

        $contactOut = [];
        foreach ($stored['contact_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            if (isset($row['type']) && is_string($row['type']) && in_array($row['type'], self::footerContactItemTypes(), true)) {
                $contactOut[] = $row;
            }
        }

        if ($contactOut === [] && isset($stored['contact_slots'])) {
            foreach ($stored['contact_slots'] ?? [] as $row) {
                if (! is_array($row)) {
                    continue;
                }
                $slot = (string) ($row['slot'] ?? '');
                $isPlain = ($row['kind'] ?? '') === 'plain' || $slot === 'footer_address';
                if ($isPlain) {
                    $contactOut[] = [
                        'type' => 'preset_address',
                        'icon' => (string) ($row['icon'] ?? 'fas fa-location-dot fa-sm'),
                    ];

                    continue;
                }
                $type = match ($slot) {
                    'footer_phone' => 'preset_phone',
                    'footer_fb' => 'preset_fb',
                    'footer_ig' => 'preset_ig',
                    default => 'preset_phone',
                };
                $contactOut[] = [
                    'type' => $type,
                    'href_type' => isset($row['href_type']) && in_array($row['href_type'], ['site', 'route', 'url'], true)
                        ? $row['href_type']
                        : 'site',
                    'route' => (string) ($row['route'] ?? ''),
                    'href' => (string) ($row['href'] ?? ''),
                    'icon' => (string) ($row['icon'] ?? 'fas fa-link'),
                ];
            }
        }

        return [
            'v' => self::FOOTER_NAV_VERSION,
            'menu_items' => $menuOut,
            'kegiatan_items' => $kegiatanOut,
            'social_items' => $socialOut,
            'contact_items' => $contactOut,
        ];
    }

    /** @param  array<string, mixed>  $stored */
    public static function ensureFooterNavigationSections(array $stored): array
    {
        $stored['menu_items'] = array_values(array_filter(array_map(static function ($r) {
            return is_array($r) ? $r : [];
        }, $stored['menu_items'] ?? []), static fn ($r) => $r !== []));

        $stored['kegiatan_items'] = array_values(array_filter(array_map(static function ($r) {
            return is_array($r) ? $r : [];
        }, $stored['kegiatan_items'] ?? [])));

        $stored['social_items'] = array_values(array_filter(array_map(static function ($r) {
            return is_array($r) ? $r : [];
        }, $stored['social_items'] ?? [])));

        $stored['contact_items'] = array_values(array_filter(array_map(static function ($r) {
            return is_array($r) ? $r : [];
        }, $stored['contact_items'] ?? [])));

        return $stored;
    }

    /** @return array<string, mixed> */
    public static function defaultFooterNavigationV2(object $site, bool $includeAnakAsuhMenu): array
    {
        $menu = [
            ['label' => (string) ($site->footer_menu_beranda ?? 'Beranda'), 'href_type' => 'route', 'route' => 'home', 'href' => '', 'icon' => 'fas fa-chevron-right fa-xs'],
            ['label' => (string) ($site->footer_menu_tentang ?? 'Tentang Kami'), 'href_type' => 'route', 'route' => 'tentang', 'href' => '', 'icon' => 'fas fa-chevron-right fa-xs'],
        ];

        if ($includeAnakAsuhMenu) {
            $menu[] = [
                'label' => (string) ($site->footer_menu_anak_asuh ?? 'Data anak asuh'),
                'href_type' => 'route',
                'route' => 'anak-asuh',
                'href' => '',
                'icon' => 'fas fa-chevron-right fa-xs',
            ];
        }

        array_push(
            $menu,
            ['label' => (string) ($site->footer_menu_kegiatan ?? 'Kegiatan'), 'href_type' => 'route', 'route' => 'program', 'href' => '', 'icon' => 'fas fa-chevron-right fa-xs'],
            ['label' => (string) ($site->footer_menu_galeri ?? 'Galeri'), 'href_type' => 'route', 'route' => 'galeri', 'href' => '', 'icon' => 'fas fa-chevron-right fa-xs'],
            ['label' => (string) ($site->footer_menu_donasi ?? 'Donasi'), 'href_type' => 'route', 'route' => 'donasi.index', 'href' => '', 'icon' => 'fas fa-chevron-right fa-xs'],
            ['label' => (string) ($site->footer_menu_kunjungan ?? 'Kunjungan'), 'href_type' => 'route', 'route' => 'kunjungan.create', 'href' => '', 'icon' => 'fas fa-chevron-right fa-xs'],
            ['label' => (string) ($site->footer_menu_kontak ?? 'Kontak'), 'href_type' => 'route', 'route' => 'kontak', 'href' => '', 'icon' => 'fas fa-chevron-right fa-xs'],
        );

        return [
            'v' => self::FOOTER_NAV_VERSION,
            'menu_items' => $menu,
            'kegiatan_items' => [
                [
                    'label' => (string) ($site->footer_kegiatan_rutin ?? 'Kegiatan rutin'),
                    'href_type' => 'route',
                    'route' => 'program',
                    'href' => '',
                    'icon' => 'fas fa-chevron-right fa-xs',
                ],
            ],
            'social_items' => [
                ['url' => (string) ($site->footer_sosmed_fb_url ?? '#'), 'icon' => 'fab fa-facebook-f', 'title' => 'Facebook'],
                ['url' => (string) ($site->footer_sosmed_phone_href ?? '#'), 'icon' => 'fas fa-phone', 'title' => 'Telepon'],
                ['url' => (string) ($site->footer_sosmed_ig_url ?? '#'), 'icon' => 'fab fa-instagram', 'title' => 'Instagram'],
            ],
            'contact_items' => [
                ['type' => 'preset_phone', 'href_type' => 'site', 'route' => '', 'href' => '', 'icon' => 'fas fa-phone fa-sm'],
                ['type' => 'preset_fb', 'href_type' => 'site', 'route' => '', 'href' => '', 'icon' => 'fab fa-facebook-f fa-sm'],
                ['type' => 'preset_ig', 'href_type' => 'site', 'route' => '', 'href' => '', 'icon' => 'fab fa-instagram fa-sm'],
                ['type' => 'preset_address', 'icon' => 'fas fa-location-dot fa-sm'],
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $fn
     * @return array<string, mixed>
     */
    public static function filterFooterNavEmptyRepeaterRows(array $fn): array
    {
        $fn['kegiatan_items'] = array_values(array_filter($fn['kegiatan_items'] ?? [], static function ($row) {
            if (! is_array($row)) {
                return false;
            }

            return trim((string) ($row['label'] ?? '')) !== '';
        }));

        $fn['social_items'] = array_values(array_filter($fn['social_items'] ?? [], static function ($row) {
            if (! is_array($row)) {
                return false;
            }

            return trim((string) ($row['url'] ?? '')) !== ''
                || trim((string) ($row['icon'] ?? '')) !== ''
                || trim((string) ($row['title'] ?? '')) !== '';
        }));

        $fn['contact_items'] = array_values(array_filter($fn['contact_items'] ?? [], static function ($row) {
            if (! is_array($row)) {
                return false;
            }

            return isset($row['type']) && is_string($row['type']) && $row['type'] !== '';
        }));

        return $fn;
    }

    /**
     * @param  array<string, mixed>  $fn
     * @return array<string, mixed>
     */
    public static function sanitizeFooterNavigationForStorage(array $fn): array
    {
        return [
            'v' => self::FOOTER_NAV_VERSION,
            'menu_items' => array_values($fn['menu_items'] ?? []),
            'kegiatan_items' => array_values($fn['kegiatan_items'] ?? []),
            'social_items' => array_values($fn['social_items'] ?? []),
            'contact_items' => array_values($fn['contact_items'] ?? []),
        ];
    }

    /**
     * @param  array<string, mixed>  $fn
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function assertFooterNavigationValid(array $fn): void
    {
        $allowedRoutes = self::footerPublicRouteNames();
        $messages = [];

        $menus = $fn['menu_items'] ?? [];
        if (! is_array($menus) || count($menus) < 1 || count($menus) > self::FOOTER_MENU_ITEMS_MAX) {
            $messages['fn.menu_items'] = ['Kolom menu footer perlu 1–'.self::FOOTER_MENU_ITEMS_MAX.' item.'];
        } else {
            foreach ($menus as $i => $row) {
                if (! is_array($row)) {
                    continue;
                }
                $ht = ($row['href_type'] ?? '') === 'url' ? 'url' : 'route';
                if ($ht === 'route') {
                    $rName = trim((string) ($row['route'] ?? ''));
                    if ($rName === '' || ! in_array($rName, $allowedRoutes, true)) {
                        $messages['fn.menu_items.'.$i.'.route'] = ['Pilih route yang valid.'];
                    }
                } elseif (trim((string) ($row['href'] ?? '')) === '') {
                    $messages['fn.menu_items.'.$i.'.href'] = ['Isi URL ketika jenis tautan URL.'];
                }
            }
        }

        $kegiatan = $fn['kegiatan_items'] ?? [];
        if (! is_array($kegiatan) || count($kegiatan) > self::FOOTER_KEGIATAN_ITEMS_MAX) {
            if (is_array($kegiatan) && count($kegiatan) > self::FOOTER_KEGIATAN_ITEMS_MAX) {
                $messages['fn.kegiatan_items'] = ['Maksimal '.self::FOOTER_KEGIATAN_ITEMS_MAX.' tautan kegiatan.'];
            }
        } elseif (is_array($kegiatan)) {
            foreach ($kegiatan as $i => $row) {
                if (! is_array($row)) {
                    continue;
                }
                $ht = ($row['href_type'] ?? '') === 'url' ? 'url' : 'route';
                if ($ht === 'route') {
                    $rName = trim((string) ($row['route'] ?? ''));
                    if ($rName === '' || ! in_array($rName, $allowedRoutes, true)) {
                        $messages['fn.kegiatan_items.'.$i.'.route'] = ['Pilih route yang valid.'];
                    }
                } elseif (trim((string) ($row['href'] ?? '')) === '') {
                    $messages['fn.kegiatan_items.'.$i.'.href'] = ['Isi URL ketika jenis tautan URL.'];
                }
            }
        }

        $social = $fn['social_items'] ?? [];
        if (! is_array($social) || count($social) > self::FOOTER_SOCIAL_ITEMS_MAX) {
            if (is_array($social) && count($social) > self::FOOTER_SOCIAL_ITEMS_MAX) {
                $messages['fn.social_items'] = ['Maksimal '.self::FOOTER_SOCIAL_ITEMS_MAX.' ikon sosial.'];
            }
        } elseif (is_array($social)) {
            foreach ($social as $i => $row) {
                if (! is_array($row)) {
                    continue;
                }
                if (trim((string) ($row['url'] ?? '')) === '') {
                    $messages['fn.social_items.'.$i.'.url'] = ['URL wajib diisi.'];
                }
            }
        }

        $contact = $fn['contact_items'] ?? [];
        if (! is_array($contact) || count($contact) > self::FOOTER_CONTACT_ITEMS_MAX) {
            if (is_array($contact) && count($contact) > self::FOOTER_CONTACT_ITEMS_MAX) {
                $messages['fn.contact_items'] = ['Maksimal '.self::FOOTER_CONTACT_ITEMS_MAX.' baris kontak.'];
            }
        } elseif (is_array($contact)) {
            $contactTypes = self::footerContactItemTypes();
            foreach ($contact as $i => $row) {
                if (! is_array($row)) {
                    continue;
                }
                $type = (string) ($row['type'] ?? '');
                if (! in_array($type, $contactTypes, true)) {
                    $messages['fn.contact_items.'.$i.'.type'] = ['Jenis baris kontak tidak dikenal.'];

                    continue;
                }
                if (in_array($type, ['preset_phone', 'preset_fb', 'preset_ig'], true)) {
                    $ht = isset($row['href_type']) && in_array($row['href_type'], ['site', 'route', 'url'], true)
                        ? $row['href_type']
                        : 'site';
                    if ($ht === 'route') {
                        $rName = trim((string) ($row['route'] ?? ''));
                        if ($rName === '' || ! in_array($rName, $allowedRoutes, true)) {
                            $messages['fn.contact_items.'.$i.'.route'] = ['Pilih route yang valid.'];
                        }
                    } elseif ($ht === 'url' && trim((string) ($row['href'] ?? '')) === '') {
                        $messages['fn.contact_items.'.$i.'.href'] = ['Isi URL manual.'];
                    }
                } elseif ($type === 'custom_link') {
                    if (trim((string) ($row['label'] ?? '')) === '') {
                        $messages['fn.contact_items.'.$i.'.label'] = ['Label wajib untuk tautan kustom.'];
                    }
                    if (trim((string) ($row['url'] ?? '')) === '') {
                        $messages['fn.contact_items.'.$i.'.url'] = ['URL wajib untuk tautan kustom.'];
                    }
                } elseif ($type === 'custom_plain') {
                    if (trim((string) ($row['body'] ?? '')) === '') {
                        $messages['fn.contact_items.'.$i.'.body'] = ['Isi teks untuk baris teks polos.'];
                    }
                }
            }
        }

        if ($messages !== []) {
            throw \Illuminate\Validation\ValidationException::withMessages($messages);
        }
    }

    /**
     * Ubah satu baris kontak footer menjadi format layout publik.
     *
     * @return array<string, mixed>
     */
    public static function resolveFooterContactItemRow(object $site, array $row): array
    {
        $type = (string) ($row['type'] ?? '');
        $icon = (string) ($row['icon'] ?? 'fas fa-link');

        if ($type === 'custom_plain') {
            return [
                'kind' => 'plain',
                'icon' => $icon !== '' ? $icon : 'fas fa-info-circle',
                'body' => (string) ($row['body'] ?? ''),
            ];
        }

        if ($type === 'custom_link') {
            $url = trim((string) ($row['url'] ?? ''));

            return [
                'kind' => 'link',
                'icon' => $icon,
                'url' => $url !== '' ? $url : '#',
                'label' => (string) ($row['label'] ?? ''),
                'external' => self::footerHrefLooksExternal($url),
            ];
        }

        if ($type === 'preset_address') {
            return [
                'kind' => 'plain',
                'icon' => $icon !== '' ? $icon : 'fas fa-location-dot fa-sm',
                'body' => (string) ($site->footer_address ?? ''),
            ];
        }

        $slot = match ($type) {
            'preset_phone' => 'footer_phone',
            'preset_fb' => 'footer_fb',
            'preset_ig' => 'footer_ig',
            default => 'footer_phone',
        };

        $synthetic = [
            'slot' => $slot,
            'kind' => 'link',
            'href_type' => isset($row['href_type']) && in_array($row['href_type'], ['site', 'route', 'url'], true)
                ? $row['href_type']
                : 'site',
            'route' => (string) ($row['route'] ?? ''),
            'href' => (string) ($row['href'] ?? ''),
            'icon' => $icon,
        ];

        return self::resolveContactSlotRow($site, $synthetic);
    }

    public static function resolveFooterHref(string $hrefType, ?string $routeName, ?string $hrefRaw): ?string
    {
        $hrefRaw = trim((string) $hrefRaw);
        if ($hrefType === 'url') {
            return $hrefRaw !== '' ? $hrefRaw : null;
        }

        $routeName = trim((string) $routeName);
        if ($routeName === '') {
            return null;
        }

        if (! Route::has($routeName)) {
            return '#';
        }

        try {
            return route($routeName);
        } catch (\Throwable) {
            return '#';
        }
    }

    public static function footerHrefLooksExternal(?string $url): bool
    {
        if ($url === null || $url === '' || $url === '#') {
            return false;
        }

        return (bool) preg_match('#^https?://#i', $url);
    }

    /**
     * Teks tautan kolom MENU dari slug kolom footer.
     */
    public static function footerMenuLabelForSlug(object $site, string $slug): string
    {
        $key = match ($slug) {
            'beranda' => 'footer_menu_beranda',
            'tentang' => 'footer_menu_tentang',
            'anak_asuh' => 'footer_menu_anak_asuh',
            'kegiatan' => 'footer_menu_kegiatan',
            'galeri' => 'footer_menu_galeri',
            'donasi' => 'footer_menu_donasi',
            'kunjungan' => 'footer_menu_kunjungan',
            'kontak' => 'footer_menu_kontak',
            default => null,
        };
        if ($key === null) {
            return '';
        }

        $v = $site->{$key} ?? null;

        return is_string($v) && $v !== '' ? $v : '';
    }

    /**
     * @return array<string, mixed>
     */
    public static function resolveContactSlotRow(object $site, array $row): array
    {
        $slot = (string) ($row['slot'] ?? '');
        $kind = ($row['kind'] ?? '') === 'plain' ? 'plain' : 'link';

        $hrefType = isset($row['href_type']) && in_array($row['href_type'], ['site', 'route', 'url'], true)
            ? $row['href_type']
            : 'site';
        $icon = isset($row['icon']) ? (string) $row['icon'] : 'fas fa-link';

        if ($kind === 'plain') {
            return [
                'kind' => 'plain',
                'icon' => $icon,
                'body' => (string) ($site->footer_address ?? ''),
            ];
        }

        $siteHref = match ($slot) {
            'footer_phone' => (string) ($site->footer_phone_href ?? ''),
            'footer_fb' => (string) ($site->footer_fb_url ?? ''),
            'footer_ig' => (string) ($site->footer_ig_url ?? ''),
            default => '',
        };
        $siteLabel = match ($slot) {
            'footer_phone' => (string) ($site->footer_phone_display ?? ''),
            'footer_fb' => (string) ($site->footer_fb_text ?? ''),
            'footer_ig' => (string) ($site->footer_ig_text ?? ''),
            default => '',
        };

        $url = $siteHref;
        $external = self::footerHrefLooksExternal($url);

        if ($hrefType === 'route') {
            $url = self::resolveFooterHref('route', isset($row['route']) ? (string) $row['route'] : '', '') ?? $siteHref;
            $external = self::footerHrefLooksExternal($url);
        } elseif ($hrefType === 'url') {
            $raw = isset($row['href']) ? (string) $row['href'] : '';
            $url = $raw !== '' ? $raw : $siteHref;
            $external = self::footerHrefLooksExternal($url);
        }

        return [
            'kind' => 'link',
            'icon' => $icon,
            'url' => $url !== '' ? $url : '#',
            'label' => $siteLabel,
            'external' => $external,
        ];
    }

    /**
     * @return array{
     *     menu: list<array{label: string, url: string, icon: string, external: bool}>,
     *     kegiatan: list<array{label: string, url: string, icon: string, external: bool}>,
     *     social: list<array{url: string, icon: string, title: string, external: bool}>,
     *     contact: list<array<string, mixed>>
     * }
     */
    public static function footerNavResolvedForPublic(object $site): array
    {
        $includeAnakAsuhMenu = Schema::hasTable('site_contents')
            && Schema::hasColumn('site_contents', 'footer_menu_anak_asuh');

        $storedRaw = null;
        if (
            Schema::hasTable('site_contents')
            && Schema::hasColumn('site_contents', 'footer_navigation')
            && isset($site->footer_navigation)
        ) {
            $raw = $site->footer_navigation;
            $storedRaw = is_array($raw) ? $raw : null;
        }

        $nav = self::resolvedFooterNavigationStructure($storedRaw, $site, $includeAnakAsuhMenu);

        $menu = [];
        foreach ($nav['menu_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $hrefType = ($row['href_type'] ?? 'route') === 'url' ? 'url' : 'route';
            $url = self::resolveFooterHref($hrefType, $row['route'] ?? '', $row['href'] ?? '') ?? '#';
            $menu[] = [
                'label' => (string) ($row['label'] ?? ''),
                'url' => $url,
                'icon' => (string) ($row['icon'] ?? 'fas fa-chevron-right fa-xs'),
                'external' => $hrefType === 'url' && self::footerHrefLooksExternal($url),
            ];
        }

        $kegiatanRows = [];
        foreach ($nav['kegiatan_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $hrefType = ($row['href_type'] ?? 'route') === 'url' ? 'url' : 'route';
            $url = self::resolveFooterHref($hrefType, $row['route'] ?? '', $row['href'] ?? '') ?? '#';
            $label = trim((string) ($row['label'] ?? ''));
            $kegiatanRows[] = [
                'label' => $label !== '' ? $label : ($hrefType === 'route' ? (string) ($row['route'] ?? '') : 'Kegiatan'),
                'url' => $url,
                'icon' => (string) ($row['icon'] ?? 'fas fa-chevron-right fa-xs'),
                'external' => $hrefType === 'url' && self::footerHrefLooksExternal($url),
            ];
        }

        $socialOut = [];
        foreach ($nav['social_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $href = trim((string) ($row['url'] ?? ''));
            $socialOut[] = [
                'url' => $href !== '' ? $href : '#',
                'icon' => (string) ($row['icon'] ?? 'fas fa-link'),
                'title' => (string) ($row['title'] ?? ''),
                'external' => self::footerHrefLooksExternal($href),
            ];
        }

        $contactOut = [];
        foreach ($nav['contact_items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $contactOut[] = self::resolveFooterContactItemRow($site, $row);
        }

        return [
            'menu' => $menu,
            'kegiatan' => $kegiatanRows,
            'social' => $socialOut,
            'contact' => $contactOut,
        ];
    }

    /** @see self::sanitizeHeaderNavigationForStorage() */
    public const HEADER_NAV_VERSION = 1;

    /** Batas item menu atas (bilah navigasi header). */
    public const HEADER_ITEMS_MAX = 20;

    /**
     * @param  array<string, mixed>|null  $storedRaw
     * @return array{v: int, items: list<array<string, mixed>>}
     */
    public static function coerceHeaderNavigationForAdmin(?array $storedRaw, object $site, bool $includeAnakAsuhMenu): array
    {
        $stored = is_array($storedRaw) ? $storedRaw : [];
        $structure = self::resolvedHeaderNavigationStructure($stored, $site, $includeAnakAsuhMenu);

        return [
            'v' => self::HEADER_NAV_VERSION,
            'items' => $structure['items'],
        ];
    }

    /**
     * @param  array<string, mixed>  $stored
     * @return array{items: list<array<string, mixed>>}
     */
    public static function resolvedHeaderNavigationStructure(array $stored, object $site, bool $includeAnakAsuhMenu): array
    {
        $items = [];
        foreach ($stored['items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $items[] = [
                'label' => (string) ($row['label'] ?? ''),
                'href_type' => ($row['href_type'] ?? 'route') === 'url' ? 'url' : 'route',
                'route' => (string) ($row['route'] ?? ''),
                'href' => (string) ($row['href'] ?? ''),
                'style' => (($row['style'] ?? '') === 'cta') ? 'cta' : 'link',
            ];
        }

        if ($items === []) {
            $items = self::defaultHeaderNavigationItems($site, $includeAnakAsuhMenu);
        }

        return ['items' => $items];
    }

    /**
     * Default menu header dari kolom teks navigasi legacy (kolom <code>nav_*</code>).
     *
     * @return list<array{label: string, href_type: string, route: string, href: string, style: string}>
     */
    public static function defaultHeaderNavigationItems(object $site, bool $includeAnakAsuhMenu): array
    {
        $rows = [
            [
                'label' => (string) ($site->nav_beranda ?? 'Beranda'),
                'href_type' => 'route',
                'route' => 'home',
                'href' => '',
                'style' => 'link',
            ],
            [
                'label' => (string) ($site->nav_tentang ?? 'Tentang'),
                'href_type' => 'route',
                'route' => 'tentang',
                'href' => '',
                'style' => 'link',
            ],
        ];

        if ($includeAnakAsuhMenu) {
            $rows[] = [
                'label' => (string) ($site->nav_anak_asuh ?? 'Anak asuh'),
                'href_type' => 'route',
                'route' => 'anak-asuh',
                'href' => '',
                'style' => 'link',
            ];
        }

        $rows[] = [
            'label' => (string) ($site->nav_kegiatan ?? 'Jadwal'),
            'href_type' => 'route',
            'route' => 'program',
            'href' => '',
            'style' => 'link',
        ];
        $rows[] = [
            'label' => (string) ($site->nav_galeri ?? 'Galeri'),
            'href_type' => 'route',
            'route' => 'galeri',
            'href' => '',
            'style' => 'link',
        ];
        $rows[] = [
            'label' => (string) ($site->nav_donasi ?? 'Donasi'),
            'href_type' => 'route',
            'route' => 'donasi.index',
            'href' => '',
            'style' => 'cta',
        ];
        $rows[] = [
            'label' => (string) ($site->nav_kunjungan ?? 'Kunjungan'),
            'href_type' => 'route',
            'route' => 'kunjungan.create',
            'href' => '',
            'style' => 'link',
        ];
        $rows[] = [
            'label' => (string) ($site->nav_kontak ?? 'Kontak'),
            'href_type' => 'route',
            'route' => 'kontak',
            'href' => '',
            'style' => 'link',
        ];

        return $rows;
    }

    /**
     * @param  array<string, mixed>  $hn
     * @return array<string, mixed>
     */
    public static function filterHeaderNavEmptyRows(array $hn): array
    {
        $out = [];
        foreach ($hn['items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            if (trim((string) ($row['label'] ?? '')) === '') {
                continue;
            }
            $out[] = $row;
        }

        return ['items' => $out];
    }

    /** @param  array<string, mixed>  $hn */
    public static function assertHeaderNavigationValid(array $hn): void
    {
        $allowedRoutes = self::footerPublicRouteNames();
        $messages = [];

        $items = $hn['items'] ?? [];
        if (! is_array($items) || count($items) < 1 || count($items) > self::HEADER_ITEMS_MAX) {
            $messages['hn.items'] = ['Menu header perlu 1–'.self::HEADER_ITEMS_MAX.' item.'];
        } elseif (is_array($items)) {
            foreach ($items as $i => $row) {
                if (! is_array($row)) {
                    continue;
                }
                $ht = ($row['href_type'] ?? '') === 'url' ? 'url' : 'route';
                if ($ht === 'route') {
                    $rName = trim((string) ($row['route'] ?? ''));
                    if ($rName === '' || ! in_array($rName, $allowedRoutes, true)) {
                        $messages['hn.items.'.$i.'.route'] = ['Pilih route yang valid.'];
                    }
                } elseif (trim((string) ($row['href'] ?? '')) === '') {
                    $messages['hn.items.'.$i.'.href'] = ['Isi URL ketika jenis tautan URL.'];
                }
            }
        }

        if ($messages !== []) {
            throw ValidationException::withMessages($messages);
        }
    }

    /**
     * @param  array<string, mixed>  $hn
     * @return array{v: int, items: list<array<string, string>>}
     */
    public static function sanitizeHeaderNavigationForStorage(array $hn): array
    {
        $clean = [];
        foreach ($hn['items'] ?? [] as $row) {
            if (! is_array($row)) {
                continue;
            }
            $clean[] = [
                'label' => trim((string) ($row['label'] ?? '')),
                'href_type' => ($row['href_type'] ?? 'route') === 'url' ? 'url' : 'route',
                'route' => trim((string) ($row['route'] ?? '')),
                'href' => trim((string) ($row['href'] ?? '')),
                'style' => (($row['style'] ?? '') === 'cta') ? 'cta' : 'link',
            ];
        }

        return [
            'v' => self::HEADER_NAV_VERSION,
            'items' => $clean,
        ];
    }

    /**
     * Sinkronkan label menu ke kolom <code>nav_*</code> agar form Beranda lama (jika masih dipakai) tetap konsisten.
     *
     * @param  list<array<string, mixed>>  $items
     * @return array<string, string>
     */
    public static function syncNavTextColumnsFromHeaderItems(array $items, bool $hasAnakAsuhColumn): array
    {
        $map = [
            'home' => 'nav_beranda',
            'tentang' => 'nav_tentang',
            'anak-asuh' => 'nav_anak_asuh',
            'program' => 'nav_kegiatan',
            'program.unggulan' => 'nav_kegiatan',
            'program.lainnya' => 'nav_kegiatan',
            'galeri' => 'nav_galeri',
            'donasi.index' => 'nav_donasi',
            'donasi.keuangan' => 'nav_donasi',
            'kunjungan.create' => 'nav_kunjungan',
            'kontak' => 'nav_kontak',
        ];

        $updates = [];
        $seen = [];

        foreach ($items as $row) {
            if (! is_array($row)) {
                continue;
            }
            $label = trim((string) ($row['label'] ?? ''));
            if ($label === '') {
                continue;
            }
            $ht = ($row['href_type'] ?? '') === 'url' ? 'url' : 'route';
            if ($ht !== 'route') {
                continue;
            }
            $routeName = trim((string) ($row['route'] ?? ''));
            $col = $map[$routeName] ?? null;
            if ($col === null) {
                continue;
            }
            if ($col === 'nav_anak_asuh' && ! $hasAnakAsuhColumn) {
                continue;
            }
            if (isset($seen[$col])) {
                continue;
            }
            $seen[$col] = true;
            $updates[$col] = $label;
        }

        return $updates;
    }

    public static function headerNavItemIsActive(?string $routeName): bool
    {
        $routeName = trim((string) $routeName);
        if ($routeName === '') {
            return false;
        }

        if ($routeName === 'home') {
            return request()->routeIs('home');
        }

        if (str_starts_with($routeName, 'donasi')) {
            return request()->routeIs('donasi.*');
        }

        if (str_starts_with($routeName, 'kunjungan')) {
            return request()->routeIs('kunjungan.*');
        }

        if (in_array($routeName, ['program', 'program.unggulan', 'program.lainnya'], true)) {
            return request()->routeIs('program') || request()->routeIs('program.unggulan') || request()->routeIs('program.lainnya');
        }

        return request()->routeIs($routeName);
    }

    /**
     * URL untuk item menu header (tautan eksternal dianggap eksternal).
     *
     * @return list<array{label: string, url: string, style: string, route: string|null, external: bool}>
     */
    public static function headerNavResolvedForPublic(object $site): array
    {
        $includeAnakAsuhMenu = Schema::hasTable('site_contents')
            && Schema::hasColumn('site_contents', 'nav_anak_asuh');

        $legacyLayout = ! Schema::hasColumn('site_contents', 'header_navigation');

        $storedRaw = null;
        if (
            Schema::hasTable('site_contents')
            && Schema::hasColumn('site_contents', 'header_navigation')
            && isset($site->header_navigation)
        ) {
            $raw = $site->header_navigation;
            $storedRaw = is_array($raw) ? $raw : null;
        }

        if ($legacyLayout || $storedRaw === null) {
            $items = self::defaultHeaderNavigationItems($site, $includeAnakAsuhMenu);
        } else {
            $items = self::resolvedHeaderNavigationStructure($storedRaw, $site, $includeAnakAsuhMenu)['items'];
        }

        $out = [];
        foreach ($items as $row) {
            $hrefType = ($row['href_type'] ?? 'route') === 'url' ? 'url' : 'route';
            $routeKey = trim((string) ($row['route'] ?? ''));
            $url = self::resolveFooterHref($hrefType, $row['route'] ?? '', $row['href'] ?? '') ?? '#';
            $style = (($row['style'] ?? '') === 'cta') ? 'cta' : 'link';
            $external = $hrefType === 'url' && self::footerHrefLooksExternal($url);

            $out[] = [
                'label' => (string) ($row['label'] ?? ''),
                'url' => $url,
                'style' => $style,
                'route' => $hrefType === 'route' ? ($routeKey !== '' ? $routeKey : null) : null,
                'external' => $external,
            ];
        }

        return $out;
    }
}
