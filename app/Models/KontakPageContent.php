<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class KontakPageContent extends Model
{
    protected $table = 'kontak_page_contents';

    protected $fillable = [
        'page_meta_title',
        'hero_image',
        'hero_icon',
        'hero_title',
        'hero_subtitle',
        'info_block_icon',
        'info_block_title',
        'phone_item_icon',
        'phone_title',
        'phone_href',
        'phone_display',
        'phone_note',
        'fb_item_icon',
        'fb_title',
        'fb_url',
        'fb_link_text',
        'fb_note',
        'ig_item_icon',
        'ig_title',
        'ig_url',
        'ig_link_text',
        'addr_item_icon',
        'addr_title',
        'addr_line1',
        'addr_line2',
        'addr_line3',
        'addr_maps_url',
        'quick_block_icon',
        'quick_block_title',
        'quick_fb_text',
        'quick_fb_url',
        'quick_ig_text',
        'quick_ig_url',
        'quick_phone_text',
        'quick_phone_url',
        'jam_block_icon',
        'jam_block_title',
        'jam_row1_hari',
        'jam_row1_waktu',
        'jam_row2_hari',
        'jam_row2_waktu',
        'jam_row3_hari',
        'jam_row3_waktu',
        'faq_block_icon',
        'faq_block_title',
        'faq1_q',
        'faq1_a',
        'faq2_q',
        'faq2_a',
        'faq3_q',
        'faq3_a',
        'faq4_q',
        'faq4_a',
        'form_title',
        'form_subtitle',
        'lbl_nama',
        'ph_nama',
        'lbl_email',
        'ph_email',
        'lbl_subjek',
        'select_placeholder',
        'opt1_value',
        'opt1_label',
        'opt2_value',
        'opt2_label',
        'opt3_value',
        'opt3_label',
        'opt4_value',
        'opt4_label',
        'opt5_value',
        'opt5_label',
        'opt6_value',
        'opt6_label',
        'lbl_pesan',
        'ph_pesan',
        'btn_submit_icon',
        'btn_submit_text',
        'form_footer_icon',
        'form_footer_text',
        'divider_text',
        'divider_btn_icon',
        'divider_btn_text',
        'divider_btn_href',
        'success_message',
    ];

    public static function defaults(): array
    {
        return [
            'page_meta_title' => 'Kontak - Panti Asuhan Santa Susana Timika',
            'hero_image' => null,
            'hero_icon' => 'fas fa-phone-volume',
            'hero_title' => 'Hubungi Kami',
            'hero_subtitle' => 'Kami siap menjawab pertanyaan, menerima masukan, dan membantu Anda terhubung dengan Panti Asuhan Santa Susana',
            'info_block_icon' => 'fas fa-address-book',
            'info_block_title' => 'Informasi Kontak',
            'phone_item_icon' => 'fas fa-phone',
            'phone_title' => 'Telepon',
            'phone_href' => 'tel:082198595245',
            'phone_display' => '0821-9859-5245',
            'phone_note' => 'Tersedia jam kerja',
            'fb_item_icon' => 'fab fa-facebook-f',
            'fb_title' => 'Facebook',
            'fb_url' => 'https://facebook.com/YayasanPeduliKasihMimika',
            'fb_link_text' => 'Yayasan Peduli Kasih Mimika',
            'fb_note' => 'Panti Asuhan Santa Susana Timika',
            'ig_item_icon' => 'fab fa-instagram',
            'ig_title' => 'Instagram',
            'ig_url' => 'https://www.instagram.com/yayasanpedulikasihmimika',
            'ig_link_text' => 'Yayasan Peduli Kasih Mimika Panti Asuhan Santa Susana Timika',
            'addr_item_icon' => 'fas fa-location-dot',
            'addr_title' => 'Alamat',
            'addr_line1' => 'JL.POROS SP2-SP5 GANG PETRA',
            'addr_line2' => 'KAMPUNG MINABUA, SP 2 TIMIKA, DISTRIK MIMIKA BARU',
            'addr_line3' => 'KABUPATEN MIMIKA – PROVINSI PAPUA TENGAH',
            'addr_maps_url' => null,
            'quick_block_icon' => 'fas fa-share-nodes',
            'quick_block_title' => 'Terhubung Cepat',
            'quick_fb_text' => 'Facebook',
            'quick_fb_url' => 'https://facebook.com/YayasanPeduliKasihMimika',
            'quick_ig_text' => 'Instagram: Yayasan Peduli Kasih Mimika Panti Asuhan Santa Susana Timika',
            'quick_ig_url' => 'https://www.instagram.com/yayasanpedulikasihmimika',
            'quick_phone_text' => 'Telepon: 0821-9859-5245',
            'quick_phone_url' => 'tel:082198595245',
            'jam_block_icon' => 'fas fa-clock',
            'jam_block_title' => 'Jam Operasional',
            'jam_row1_hari' => 'Senin - Jumat',
            'jam_row1_waktu' => '08.00 - 17.00',
            'jam_row2_hari' => 'Sabtu',
            'jam_row2_waktu' => '08.00 - 14.00',
            'jam_row3_hari' => 'Minggu & Hari Besar',
            'jam_row3_waktu' => 'Tutup / Sesuai Pemberitahuan',
            'faq_block_icon' => 'fas fa-circle-question',
            'faq_block_title' => 'Pertanyaan Umum',
            'faq1_q' => 'Bagaimana cara berdonasi?',
            'faq1_a' => 'Isi form donasi di halaman Donasi dengan nama, email, dan nominal. Tim kami akan menghubungi untuk konfirmasi pembayaran.',
            'faq2_q' => 'Bolehkah donasi barang/sembako?',
            'faq2_a' => 'Tentu saja! Silakan hubungi kami terlebih dahulu via WhatsApp untuk koordinasi jenis barang dan waktu pengiriman/pengantaran.',
            'faq3_q' => 'Berapa lama proses konfirmasi kunjungan?',
            'faq3_a' => 'Kami akan menghubungi Anda dalam 1-2 hari kerja setelah form kunjungan diterima untuk konfirmasi dan penjadwalan.',
            'faq4_q' => 'Apakah bisa jadi relawan?',
            'faq4_a' => 'Kami sangat terbuka untuk relawan. Hubungi kami via WhatsApp atau form kontak ini untuk membahas program kerelawanan yang sesuai.',
            'form_title' => 'Kirim Pesan',
            'form_subtitle' => 'Sampaikan pertanyaan, masukan, atau informasi lainnya',
            'lbl_nama' => 'Nama Lengkap *',
            'ph_nama' => 'Nama Anda',
            'lbl_email' => 'Email *',
            'ph_email' => 'email@contoh.com',
            'lbl_subjek' => 'Subjek / Topik *',
            'select_placeholder' => 'Pilih topik...',
            'opt1_value' => 'Informasi Donasi',
            'opt1_label' => 'Informasi Donasi',
            'opt2_value' => 'Kunjungan',
            'opt2_label' => 'Kunjungan',
            'opt3_value' => 'Kerelawanan',
            'opt3_label' => 'Kerelawanan',
            'opt4_value' => 'Kemitraan',
            'opt4_label' => 'Kemitraan / Kerja Sama',
            'opt5_value' => 'Program',
            'opt5_label' => 'Informasi Program',
            'opt6_value' => 'Lainnya',
            'opt6_label' => 'Lainnya',
            'lbl_pesan' => 'Pesan *',
            'ph_pesan' => 'Tuliskan pesan Anda di sini...',
            'btn_submit_icon' => 'fas fa-paper-plane',
            'btn_submit_text' => 'Kirim Pesan',
            'form_footer_icon' => 'fas fa-reply',
            'form_footer_text' => 'Kami akan membalas dalam 1-2 hari kerja',
            'divider_text' => 'Atau hubungi langsung',
            'divider_btn_icon' => 'fas fa-phone',
            'divider_btn_text' => 'Telepon',
            'divider_btn_href' => 'tel:082198595245',
            'success_message' => 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.',
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    public static function resolvedForPublic(): object
    {
        $defaults = static::defaults();

        if (! Schema::hasTable('kontak_page_contents')) {
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

    /**
     * URL Google Maps: tautan khusus dari CMS jika diisi, selain itu pencarian dari baris alamat.
     */
    public static function resolvedGoogleMapsUrl(object $page): string
    {
        $custom = trim((string) ($page->addr_maps_url ?? ''));
        if ($custom !== '') {
            return $custom;
        }

        $parts = array_filter([
            $page->addr_line1 ?? '',
            $page->addr_line2 ?? '',
            $page->addr_line3 ?? '',
        ], static fn ($s) => $s !== null && trim((string) $s) !== '');

        $query = implode(', ', array_map(static fn ($s) => trim((string) $s), $parts));

        return 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($query);
    }
}
