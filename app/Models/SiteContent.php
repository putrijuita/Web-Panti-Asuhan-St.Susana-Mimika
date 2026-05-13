<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteContent extends Model
{
    public const DEFAULT_QRIS_LOGO_URL = 'https://upload.wikimedia.org/wikipedia/commons/a/a9/QRIS_logo.svg';

    protected $fillable = [
        'nav_brand_suffix',
        'nav_beranda',
        'nav_tentang',
        'nav_kegiatan',
        'nav_galeri',
        'nav_donasi',
        'nav_kunjungan',
        'nav_kontak',
        'site_logo',
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
        'donasi_keuangan_page',
        'donasi_jasa_page',
    ];

    protected $casts = [
        'donasi_keuangan_page' => 'array',
        'donasi_jasa_page' => 'array',
    ];

    public static function defaults(): array
    {
        return [
            'nav_brand_suffix' => 'Santa Susana Timika',
            'nav_beranda' => 'Beranda',
            'nav_tentang' => 'Tentang',
            'nav_kegiatan' => 'Kegiatan',
            'nav_galeri' => 'Galeri',
            'nav_donasi' => 'Donasi',
            'nav_kunjungan' => 'Kunjungan',
            'nav_kontak' => 'Kontak',
            'site_logo' => null,
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
            'footer_heading_kegiatan' => 'Kegiatan',
            'footer_heading_kontak' => 'Kontak',
            'footer_menu_beranda' => 'Beranda',
            'footer_menu_tentang' => 'Tentang Kami',
            'footer_menu_kegiatan' => 'Kegiatan',
            'footer_menu_galeri' => 'Galeri',
            'footer_menu_donasi' => 'Donasi',
            'footer_menu_kunjungan' => 'Kunjungan',
            'footer_menu_kontak' => 'Kontak',
            'footer_kegiatan_rutin' => 'Kegiatan Rutin Kami',
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
}
