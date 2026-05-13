<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class TentangContent extends Model
{
    protected $fillable = [
        'hero_kicker',
        'hero_title',
        'hero_description',
        'summary_subtitle',
        'summary_paragraph_1',
        'summary_paragraph_2',
        'summary_cta_note',
        'tentang_hero_title',
        'tentang_hero_description',
        'visi_text',
        'misi_items',
        'page_meta_title',
        'vm_section_label',
        'vm_visi_icon',
        'vm_misi_icon',
        'vm_visi_heading',
        'vm_misi_heading',
        'nilai_section_label',
        'nilai_section_title',
        'nilai_section_sub',
        'nilai_items',
        'sejarah_section_label',
        'sejarah_section_title',
        'sejarah_section_sub',
        'sejarah_items',
        'pengurus_section_label',
        'pengurus_section_title',
        'pengurus_section_sub',
        'cta_title',
        'cta_subtitle',
        'cta_btn_donasi',
        'cta_btn_kunjungan',
        'cta_btn_kontak',
    ];

    protected $casts = [
        'misi_items' => 'array',
        'nilai_items' => 'array',
        'sejarah_items' => 'array',
    ];

    public static function defaults(): array
    {
        return [
            'hero_kicker' => 'Yayasan Peduli Kasih Mimika',
            'hero_title' => 'Panti Asuhan Santa Susana Timika',
            'hero_description' => 'Selamat datang. Situs ini disiapkan agar masyarakat luas dapat mengenal pekerjaan kami di lapangan. Yayasan Peduli Kasih Mimika mengelola Panti Asuhan Santa Susana Timika di Provinsi Papua Tengah: anak-anak diasuh di rumah panti, tetap bersekolah, dan dibimbing supaya hidupnya tertib serta mandiri bertahap.',
            'summary_subtitle' => 'Gambaran singkat yayasan dan panti, sebelum Anda membuka halaman profil lengkap',
            'summary_paragraph_1' => 'Panti Asuhan Santa Susana Timika berada di bawah naungan Yayasan Peduli Kasih Mimika, bertempat di Kabupaten Mimika. Sehari-hari kami mengurus kebutuhan tinggal, makan, sekolah, dan kebiasaan baik anak asuh, dengan pendekatan yang sabar dan terukur.',
            'summary_paragraph_2' => 'Bila ada yang ingin mengetahui bagaimana dana dipakai atau bagaimana program berjalan, tim kami siap menjelaskan. Donasi, barang, maupun kunjungan dari masyarakat sangat membantu kelancaran operasional panti.',
            'summary_cta_note' => 'Visi, misi, nilai yang dijunjung, potongan sejarah, dan daftar pengurus tersedia di halaman khusus.',
            'tentang_hero_title' => 'Tentang Panti Asuhan Santa Susana',
            'tentang_hero_description' => 'Mengenal lebih dekat perjalanan, visi, dan dedikasi kami dalam melayani anak-anak di Timika, Papua Tengah.',
            'visi_text' => 'Ada bersama mereka, mendampingi dan membimbing mereka serta membentuk karakter anak asuh agar menjadi pribadi yang menjunjung tinggi nilai-nilai moralitas secara Katolik, memiliki intelektual yang berkualitas dan disiplin yang tinggi serta menjadi pribadi yang takut akan Tuhan dan mengasihi sesama.',
            'misi_items' => [
                'Memberikan kenyamanan dan kedamaian bagi anak asuh.',
                'Memberi kesempatan kepada anak asuh untuk mengembangkan bakat dan kemampuan secara jasmani maupun rohani.',
                'Mendidik, membina, mengayomi, memotivasi dan mengarahkan agar menjadi pribadi yang mandiri, menghargai hidup dan menjadi berkat bagi bangsa serta memberikan pengaruh yang positif bagi sesama, hidup menghayati dan menghormati Allah Tritunggal Maha Kudus serta menghormati Bunda Maria sebagai Ibu Kehidupan.',
                'Membentuk pola hidup kerohanian yang layak dan membentuk karakter hidup bersosial.',
                'Membina dan menanamkan hidup beriman secara Katolik dan mengamalkannya dalam hidup sehari-hari.',
            ],
            'page_meta_title' => 'Tentang Kami - Panti Asuhan Santa Susana Timika',
            'vm_section_label' => 'Visi & Misi',
            'vm_visi_icon' => 'fas fa-eye',
            'vm_misi_icon' => 'fas fa-bullseye',
            'vm_visi_heading' => 'Visi',
            'vm_misi_heading' => 'Misi',
            'nilai_section_label' => 'Nilai Kami',
            'nilai_section_title' => 'Nilai-Nilai yang Kami Junjung',
            'nilai_section_sub' => '',
            'nilai_items' => static::defaultNilaiItems(),
            'sejarah_section_label' => 'Sejarah',
            'sejarah_section_title' => 'Perjalanan Kami',
            'sejarah_section_sub' => 'Dari awal yang sederhana hingga tumbuh menjadi rumah bagi banyak anak',
            'sejarah_items' => static::defaultSejarahItems(),
            'pengurus_section_label' => 'Pengurus',
            'pengurus_section_title' => 'Orang-Orang di Balik Pelayanan',
            'pengurus_section_sub' => 'Tim pengurus yang berdedikasi dan berkomitmen untuk anak-anak',
            'cta_title' => 'Ikut Berkontribusi Bersama Kami',
            'cta_subtitle' => 'Donasi atau kunjungan Anda adalah bukti nyata kepedulian',
            'cta_btn_donasi' => 'Donasi sekarang',
            'cta_btn_kunjungan' => 'Ajukan kunjungan',
            'cta_btn_kontak' => 'Hubungi kami',
        ];
    }

    /** @return array<int, array{icon: string, title: string, text: string}> */
    public static function defaultNilaiItems(): array
    {
        return [
            ['icon' => 'fas fa-heart', 'title' => 'Kasih', 'text' => 'Setiap tindakan dilandasi cinta dan kepedulian tulus'],
            ['icon' => 'fas fa-hands-praying', 'title' => 'Iman', 'text' => 'Berpijak pada nilai-nilai rohani dan kepercayaan kepada Tuhan'],
            ['icon' => 'fas fa-people-group', 'title' => 'Kebersamaan', 'text' => 'Membangun komunitas yang solid dan saling mendukung'],
            ['icon' => 'fas fa-book', 'title' => 'Pendidikan', 'text' => 'Pendidikan adalah kunci utama masa depan cerah'],
            ['icon' => 'fas fa-hand-fist', 'title' => 'Kemandirian', 'text' => 'Membekali anak menjadi pribadi mandiri dan percaya diri'],
            ['icon' => 'fas fa-scale-balanced', 'title' => 'Integritas', 'text' => 'Transparansi dan kejujuran dalam setiap langkah pelayanan'],
        ];
    }

    /** @return array<int, array{badge: string, title: string, body: string}> */
    public static function defaultSejarahItems(): array
    {
        return [
            [
                'badge' => 'Awal Berdiri',
                'title' => 'Pendirian Yayasan Peduli Kasih Mimika',
                'body' => 'Didirikan atas dasar kepedulian terhadap anak-anak kurang mampu di wilayah Mimika, Papua Tengah. Bermula dari sekelompok kecil yang bersatu hati.',
            ],
            [
                'badge' => 'Perkembangan',
                'title' => 'Pembukaan Panti Asuhan Santa Susana',
                'body' => 'Rumah pengasuhan resmi mulai beroperasi, menerima anak-anak dari berbagai latar belakang untuk mendapat pendidikan dan kasih sayang.',
            ],
            [
                'badge' => 'Pertumbuhan',
                'title' => 'Perluasan Program & Fasilitas',
                'body' => 'Program pendidikan, kesehatan, dan keterampilan diperluas. Dukungan donatur dari berbagai penjuru semakin menguat.',
            ],
            [
                'badge' => 'Kini',
                'title' => 'Melayani dengan Penuh Kasih',
                'body' => 'Terus bertumbuh dan berbenah, memberikan pelayanan terbaik bagi anak-anak demi masa depan yang lebih cerah.',
            ],
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    /** Konten untuk view publik (beranda + halaman Tentang), dengan fallback default. */
    public static function resolvedForPublic(): object
    {
        $defaults = static::defaults();
        $defaults['misi_items'] = $defaults['misi_items'] ?? [];
        $defaults['nilai_items'] = $defaults['nilai_items'] ?? static::defaultNilaiItems();
        $defaults['sejarah_items'] = $defaults['sejarah_items'] ?? static::defaultSejarahItems();

        if (! Schema::hasTable('tentang_contents')) {
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

        if (empty($content->nilai_items) || ! is_array($content->nilai_items)) {
            $content->nilai_items = $defaults['nilai_items'];
        }
        if (empty($content->sejarah_items) || ! is_array($content->sejarah_items)) {
            $content->sejarah_items = $defaults['sejarah_items'];
        }
        if (empty($content->misi_items) || ! is_array($content->misi_items)) {
            $content->misi_items = $defaults['misi_items'];
        }

        return $content;
    }

    /** Setelah migrasi kolom baru: isi baris singleton dari default bila masih kosong. */
    public function fillMissingAttributesFromDefaults(): void
    {
        $defaults = static::defaults();
        $changed = false;
        foreach ($this->getFillable() as $key) {
            if (! array_key_exists($key, $defaults)) {
                continue;
            }
            $def = $defaults[$key];
            if (in_array($key, ['misi_items', 'nilai_items', 'sejarah_items'], true)) {
                $cur = $this->{$key};
                if (empty($cur) || ! is_array($cur)) {
                    $this->{$key} = $def;
                    $changed = true;
                }

                continue;
            }
            if (blank($this->{$key})) {
                $this->{$key} = $def;
                $changed = true;
            }
        }
        if ($changed) {
            $this->saveQuietly();
        }
    }
}
