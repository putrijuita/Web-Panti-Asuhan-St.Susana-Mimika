<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ProgramPageContent extends Model
{
    protected $table = 'program_page_contents';

    protected $fillable = [
        'page_meta_title',
        'hero_title',
        'hero_subtitle',
        'unggul_section_label',
        'unggul_section_title',
        'unggul_section_sub',
        'unggul_eyebrow',
        'unggul_chip',
        'unggul_default_desc',
        'unggul_fallback_icon',
        'unggul_donate_btn',
        'unggul_donate_hint',
        'rutin_section_label',
        'rutin_section_title',
        'rutin_section_sub',
        'rutin_pill',
        'rutin_eyebrow',
        'rutin_default_desc',
        'rutin_fallback_icon',
        'empty_section_label',
        'empty_section_title',
        'empty_section_sub',
        'involve_section_label',
        'involve_section_title',
        'involve_steps',
        'cta_title',
        'cta_subtitle',
        'cta_btn_donasi',
        'cta_btn_kunjungan',
    ];

    protected $casts = [
        'involve_steps' => 'array',
    ];

    public static function defaults(): array
    {
        return [
            'page_meta_title' => 'Jadwal Kegiatan Anak - Panti Asuhan Santa Susana Timika',
            'hero_title' => 'Jadwal Kegiatan Anak',
            'hero_subtitle' => 'Jadwal rutin kegiatan anak asuh di panti: waktu, judul, dan informasi singkat yang kami tampilkan untuk keluarga dan donatur.',
            'unggul_section_label' => 'Program Unggulan',
            'unggul_section_title' => 'Program Unggulan di Panti',
            'unggul_section_sub' => 'Program-program inti yang menjadi fokus pengembangan karakter, pendidikan, dan kemandirian anak-anak.',
            'unggul_eyebrow' => 'Program Unggulan',
            'unggul_chip' => 'Program Unggulan',
            'unggul_default_desc' => 'Program fokus pembinaan karakter, pendidikan, dan kemandirian anak di Panti.',
            'unggul_fallback_icon' => 'fas fa-star',
            'unggul_donate_btn' => 'Lakukan donasi pada program ini',
            'unggul_donate_hint' => 'Dukung program ini dengan donasi Anda.',
            'rutin_section_label' => 'Jadwal',
            'rutin_section_title' => 'Kegiatan per hari',
            'rutin_section_sub' => 'Berikut jadwal yang aktif. Detail diatur di panel admin (Data & aset → Jadwal kegiatan anak).',
            'rutin_pill' => 'Kegiatan Rutin',
            'rutin_eyebrow' => 'Di Panti Santa Susana',
            'rutin_default_desc' => 'Belum ada keterangan untuk kegiatan ini, namun kegiatan ini berjalan secara rutin di Panti.',
            'rutin_fallback_icon' => 'fas fa-thumbtack',
            'empty_section_label' => 'Jadwal',
            'empty_section_title' => 'Belum Ada Jadwal Dipublikasikan',
            'empty_section_sub' => 'Saat ini belum ada jadwal aktif yang ditampilkan. Silakan kembali lagi nanti.',
            'involve_section_label' => 'Terlibat',
            'involve_section_title' => 'Cara Anda Bisa Terlibat',
            'involve_steps' => static::defaultInvolveSteps(),
            'cta_title' => 'Dukung kegiatan harian anak',
            'cta_subtitle' => 'Donasi dan kunjungan Anda membantu kami menjalankan jadwal dan kebutuhan anak asuh.',
            'cta_btn_donasi' => 'Donasi sekarang',
            'cta_btn_kunjungan' => 'Ajukan kunjungan',
        ];
    }

    /** @return array<int, array{title: string, text: string}> */
    public static function defaultInvolveSteps(): array
    {
        return [
            ['title' => 'Pilih Program', 'text' => 'Pilih program yang ingin Anda dukung'],
            ['title' => 'Donasikan', 'text' => 'Kirim donasi melalui form donasi kami'],
            ['title' => 'Kunjungi', 'text' => 'Ajukan kunjungan dan temui anak-anak'],
            ['title' => 'Dampak', 'text' => 'Lihat dampak nyata dari kontribusi Anda'],
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    public static function resolvedForPublic(): object
    {
        $defaults = static::defaults();
        $defaults['involve_steps'] = $defaults['involve_steps'] ?? static::defaultInvolveSteps();

        if (! Schema::hasTable('program_page_contents')) {
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

        if (empty($row->involve_steps) || ! is_array($row->involve_steps) || count($row->involve_steps) < 4) {
            $row->involve_steps = $defaults['involve_steps'];
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
            $def = $defaults[$key];
            if ($key === 'involve_steps') {
                $cur = $this->involve_steps;
                if (empty($cur) || ! is_array($cur) || count($cur) < 4) {
                    $this->involve_steps = $def;
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
