<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class KunjunganPageContent extends Model
{
    protected $table = 'kunjungan_page_contents';

    protected $fillable = [
        'page_meta_title',
        'thanks_meta_title',
        'hero_icon',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'explain_icon',
        'explain_title',
        'explain_li_1',
        'explain_li_2',
        'explain_li_3',
        'flow_icon',
        'flow_title',
        'step1_title',
        'step1_text',
        'step2_title',
        'step2_text',
        'step3_title',
        'step3_text',
        'step4_title',
        'step4_text',
        'activities_icon',
        'activities_title',
        'activities_intro',
        'act1_icon',
        'act1_text',
        'act2_icon',
        'act2_text',
        'act3_icon',
        'act3_text',
        'act4_icon',
        'act4_text',
        'act5_icon',
        'act5_text',
        'act6_icon',
        'act6_text',
        'rules_icon',
        'rules_title',
        'rule1',
        'rule2',
        'rule3',
        'rule4',
        'rule5',
        'form_title',
        'form_intro',
        'lbl_nama',
        'ph_nama',
        'lbl_email',
        'ph_email',
        'lbl_telepon',
        'tag_optional',
        'ph_telepon',
        'lbl_tanggal',
        'note_tanggal',
        'lbl_instansi',
        'tag_optional_instansi',
        'ph_instansi',
        'lbl_keperluan',
        'ph_keperluan',
        'note_keperluan',
        'lbl_catatan',
        'tag_optional_catatan',
        'ph_catatan',
        'note_catatan',
        'btn_submit_icon',
        'btn_submit_text',
        'form_footer_icon',
        'form_footer_text',
        'thanks_emoji',
        'thanks_title',
        'thanks_body',
        'thanks_btn_text',
    ];

    public static function defaults(): array
    {
        return [
            'page_meta_title' => 'Ajukan Kunjungan - Panti Asuhan Santa Susana Timika',
            'thanks_meta_title' => 'Terima Kasih - Panti Asuhan St. Susana Mimika',
            'hero_icon' => 'fas fa-door-open',
            'hero_title' => 'Ajukan kunjungan',
            'hero_subtitle' => 'Kehadiran Anda membawa sukacita dan dukungan nyata bagi anak-anak. Silakan ajukan jadwal kunjungan, dan tim kami akan membantu proses konfirmasinya.',
            'hero_image' => null,
            'explain_icon' => 'fas fa-info-circle',
            'explain_title' => 'Apa itu Kunjungan?',
            'explain_li_1' => 'Kunjungan bersifat <strong>fleksibel</strong> dan menyesuaikan dengan <strong>waktu yang dipilih pengunjung</strong>.',
            'explain_li_2' => 'Pengunjung <strong>tidak terikat dengan kegiatan tertentu</strong>.',
            'explain_li_3' => 'Aktivitas yang dilakukan saat berkunjung <strong>dapat disesuaikan dengan keinginan pengunjung</strong>, selama tetap mengikuti aturan panti.',
            'flow_icon' => 'fas fa-list-check',
            'flow_title' => 'Alur Pengajuan Kunjungan',
            'step1_title' => 'Isi Formulir',
            'step1_text' => 'Lengkapi data diri dan tujuan kunjungan di form ini',
            'step2_title' => 'Konfirmasi',
            'step2_text' => 'Tim kami menghubungi Anda dalam 1-2 hari kerja untuk penjadwalan',
            'step3_title' => 'Persiapan',
            'step3_text' => 'Siapkan keperluan yang ingin dibawa atau dilakukan',
            'step4_title' => 'Kunjungi',
            'step4_text' => 'Datang pada hari yang disepakati dan lakukan kegiatan bersama anak-anak',
            'activities_icon' => 'fas fa-calendar-check',
            'activities_title' => 'Kegiatan yang Bisa Dilakukan',
            'activities_intro' => 'Saat berkunjung, Anda dapat melakukan berbagai kegiatan bersama anak-anak:',
            'act1_icon' => 'fas fa-book',
            'act1_text' => 'Mengajar dan tutoring',
            'act2_icon' => 'fas fa-palette',
            'act2_text' => 'Workshop seni',
            'act3_icon' => 'fas fa-futbol',
            'act3_text' => 'Kegiatan olahraga',
            'act4_icon' => 'fas fa-utensils',
            'act4_text' => 'Memasak bersama',
            'act5_icon' => 'fas fa-music',
            'act5_text' => 'Bermusik dan bernyanyi',
            'act6_icon' => 'fas fa-gift',
            'act6_text' => 'Berbagi donasi',
            'rules_icon' => 'fas fa-circle-exclamation',
            'rules_title' => 'Aturan Kunjungan',
            'rule1' => 'Kunjungan hanya pada hari dan jam yang telah disepakati',
            'rule2' => 'Menjaga sopan santun dan sikap yang positif',
            'rule3' => 'Tidak membawa benda/makanan tanpa pemberitahuan',
            'rule4' => 'Foto/video anak hanya boleh dengan izin pengurus',
            'rule5' => 'Dilarang memberikan uang tunai langsung ke anak',
            'form_title' => 'Form Kunjungan',
            'form_intro' => 'Lengkapi data berikut secara jelas agar tim kami lebih mudah menghubungi Anda',
            'lbl_nama' => 'Nama Lengkap',
            'ph_nama' => 'Contoh: Maria Yosephine',
            'lbl_email' => 'Email',
            'ph_email' => 'email@contoh.com',
            'lbl_telepon' => 'Telepon',
            'tag_optional' => '(opsional)',
            'ph_telepon' => '08xxxxxxxxxx (aktif WhatsApp)',
            'lbl_tanggal' => 'Tanggal Kunjungan',
            'note_tanggal' => 'Pilih tanggal rencana kunjungan. Penjadwalan final akan dikonfirmasi oleh tim kami.',
            'lbl_instansi' => 'Instansi / Organisasi',
            'tag_optional_instansi' => '(opsional)',
            'ph_instansi' => 'Sekolah, perusahaan, gereja, dll (opsional)',
            'lbl_keperluan' => 'Keperluan Kunjungan',
            'ph_keperluan' => 'Jelaskan tujuan kunjungan dan kegiatan utama yang ingin dilakukan...',
            'note_keperluan' => 'Maksimal 500 karakter. Jelaskan dengan singkat agar proses persetujuan lebih cepat.',
            'lbl_catatan' => 'Catatan Tambahan',
            'tag_optional_catatan' => '(opsional)',
            'ph_catatan' => 'Contoh: jumlah rombongan, rencana barang bawaan, atau kebutuhan khusus',
            'note_catatan' => 'Jika tidak ada catatan tambahan, bagian ini boleh dikosongkan.',
            'btn_submit_icon' => 'fas fa-paper-plane',
            'btn_submit_text' => 'Kirim permohonan kunjungan',
            'form_footer_icon' => 'fas fa-clock',
            'form_footer_text' => 'Konfirmasi dalam 1-2 hari kerja',
            'thanks_emoji' => '✅',
            'thanks_title' => 'Permohonan Diterima!',
            'thanks_body' => 'Permohonan kunjungan Anda telah kami terima. Tim kami akan menghubungi Anda untuk konfirmasi.',
            'thanks_btn_text' => 'Kembali ke Beranda',
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    public static function resolvedForPublic(): object
    {
        $defaults = static::defaults();

        if (! Schema::hasTable('kunjungan_page_contents')) {
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
