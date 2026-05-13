<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class DonasiPageContent extends Model
{
    protected $table = 'donasi_page_contents';

    protected $fillable = [
        'page_meta_title',
        'hero_image',
        'hero_badge_keuangan_icon',
        'hero_badge_keuangan_text',
        'hero_badge_separator',
        'hero_badge_jasa_icon',
        'hero_badge_jasa_text',
        'hero_title_line1',
        'hero_word_red',
        'hero_word_green',
        'hero_subtitle',
        'card_keu_top_icon',
        'card_keu_pill',
        'card_keu_title',
        'card_keu_intro',
        'card_keu_feat1',
        'card_keu_feat2',
        'card_keu_feat3',
        'card_keu_feat4',
        'card_keu_cta',
        'card_jasa_top_icon',
        'card_jasa_pill',
        'card_jasa_title',
        'card_jasa_intro',
        'card_jasa_feat1',
        'card_jasa_feat2',
        'card_jasa_feat3',
        'card_jasa_feat4',
        'card_jasa_cta',
        'section_grafik_icon',
        'section_grafik_title',
        'stat_lbl_pemasukan',
        'stat_lbl_pengeluaran',
        'stat_lbl_sisa',
        'section_table_icon',
        'section_table_title',
        'tbl_th_nama',
        'tbl_th_email',
        'tbl_th_nominal',
        'tbl_th_waktu',
        'tbl_empty_msg',
        'chart_lbl_pemasukan',
        'chart_lbl_pengeluaran',
        'chart_lbl_sisa',
        'dl1_text',
        'dl1_btn',
        'dl2_text',
        'dl2_btn',
    ];

    public static function defaults(): array
    {
        return [
            'page_meta_title' => 'Donasi - Panti Asuhan Santa Susana Timika',
            'hero_image' => null,
            'hero_badge_keuangan_icon' => 'fas fa-coins',
            'hero_badge_keuangan_text' => 'Donasi Keuangan',
            'hero_badge_separator' => '·',
            'hero_badge_jasa_icon' => 'fas fa-hands-helping',
            'hero_badge_jasa_text' => 'Donasi Jasa',
            'hero_title_line1' => 'Setiap Bentuk Kebaikan',
            'hero_word_red' => 'Bernilai',
            'hero_word_green' => 'Bermakna',
            'hero_subtitle' => 'Anda bisa berdonasi dalam dua cara — melalui <strong>uang</strong> untuk memenuhi kebutuhan, atau melalui <strong>jasa dan keahlian</strong> untuk memperkaya kehidupan anak-anak kami.',
            'card_keu_top_icon' => 'fas fa-coins',
            'card_keu_pill' => 'Donasi Uang',
            'card_keu_title' => 'Donasi Keuangan',
            'card_keu_intro' => 'Bantu kebutuhan sehari-hari, pendidikan, dan kesehatan anak-anak dengan donasi finansial.',
            'card_keu_feat1' => 'Pilih nominal bebas, mulai dari Rp 10.000',
            'card_keu_feat2' => 'Dana untuk makan, sekolah, kesehatan & fasilitas',
            'card_keu_feat3' => 'Laporan penggunaan dana secara transparan',
            'card_keu_feat4' => 'Cepat, mudah, dan langsung berdampak',
            'card_keu_cta' => 'Donasi Keuangan Sekarang →',
            'card_jasa_top_icon' => 'fas fa-hands-helping',
            'card_jasa_pill' => 'Donasi Jasa',
            'card_jasa_title' => 'Donasi Jasa',
            'card_jasa_intro' => 'Gunakan keahlian dan waktu Anda untuk langsung melayani dan memberdayakan anak-anak.',
            'card_jasa_feat1' => 'Mengajar, melatih, membimbing langsung',
            'card_jasa_feat2' => 'Berbagai bidang: medis, IT, seni, olahraga, dll',
            'card_jasa_feat3' => 'Jadwal fleksibel sesuai ketersediaan Anda',
            'card_jasa_feat4' => 'Dampak langsung terasa oleh anak-anak',
            'card_jasa_cta' => 'Daftarkan Donasi Jasa →',
            'section_grafik_icon' => 'fas fa-chart-line',
            'section_grafik_title' => 'Pemasukan, Pengeluaran & Sisa Saldo Donasi (6 Bulan Terakhir)',
            'stat_lbl_pemasukan' => 'Total Pemasukan',
            'stat_lbl_pengeluaran' => 'Total Pengeluaran',
            'stat_lbl_sisa' => 'Sisa Saldo Donasi',
            'section_table_icon' => 'fas fa-list-alt',
            'section_table_title' => 'Transparansi Donasi',
            'tbl_th_nama' => 'Nama Donatur',
            'tbl_th_email' => 'Email',
            'tbl_th_nominal' => 'Nominal Donasi',
            'tbl_th_waktu' => 'Tanggal / Waktu',
            'tbl_empty_msg' => 'Belum ada data donasi yang tercatat.',
            'chart_lbl_pemasukan' => 'Pemasukan',
            'chart_lbl_pengeluaran' => 'Pengeluaran',
            'chart_lbl_sisa' => 'Sisa Saldo',
            'dl1_text' => 'Unduh laporan donasi keuangan dalam bentuk PDF (data selesai dibayar)',
            'dl1_btn' => 'Download Laporan Donasi',
            'dl2_text' => 'Unduh laporan pengelolaan donasi (pengeluaran & bukti) dalam bentuk PDF',
            'dl2_btn' => 'Download Laporan Pengelolaan Donasi',
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    public static function resolvedForPublic(): object
    {
        $defaults = static::defaults();

        if (! Schema::hasTable('donasi_page_contents')) {
            return (object) $defaults;
        }

        $row = static::query()->find(1);
        if (! $row) {
            return (object) $defaults;
        }

        foreach ($defaults as $key => $value) {
            if (blank($row->{$key})) {
                $row->{$key} = $value;
            }
        }

        return $row;
    }

    public function fillMissingFromDefaults(): void
    {
        $defaults = static::defaults();
        $changed = false;
        foreach ($this->getFillable() as $key) {
            if (! array_key_exists($key, $defaults)) {
                continue;
            }
            if (blank($this->{$key})) {
                $this->{$key} = $defaults[$key];
                $changed = true;
            }
        }
        if ($changed) {
            $this->saveQuietly();
        }
    }
}
