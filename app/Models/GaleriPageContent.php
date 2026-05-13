<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class GaleriPageContent extends Model
{
    protected $table = 'galeri_page_contents';

    protected $fillable = [
        'page_meta_title',
        'hero_icon',
        'hero_title',
        'hero_subtitle',
        'filter_btn_semua',
        'album_section_icon',
        'album_section_label',
        'album_section_title',
        'gallery_overlay_tag',
        'gallery_default_caption',
        'empty_title',
        'empty_text',
        'video_section_icon',
        'video_section_label',
        'video_section_title',
        'video_section_sub',
        'video_empty_message',
        'video_browser_unsupported',
        'cta_title',
        'cta_subtitle',
        'cta_btn_kunjungan',
        'cta_btn_donasi',
        'lightbox_close_label',
    ];

    public static function defaults(): array
    {
        return [
            'page_meta_title' => 'Galeri - Panti Asuhan Santa Susana Timika',
            'hero_icon' => 'fas fa-images',
            'hero_title' => 'Galeri kegiatan',
            'hero_subtitle' => 'Sekilas momen berharga dari kehidupan dan kegiatan anak-anak di Panti Asuhan Santa Susana Timika',
            'filter_btn_semua' => 'Semua',
            'album_section_icon' => 'fas fa-th',
            'album_section_label' => 'Album Kegiatan',
            'album_section_title' => 'Foto Kegiatan di Panti',
            'gallery_overlay_tag' => 'Kegiatan',
            'gallery_default_caption' => 'Dokumentasi kegiatan di Panti Asuhan Santa Susana.',
            'empty_title' => 'Belum Ada Foto Galeri',
            'empty_text' => 'Tim kami akan segera menambahkan foto-foto kegiatan anak-anak di panti.',
            'video_section_icon' => 'fas fa-photo-film',
            'video_section_label' => 'Dokumentasi',
            'video_section_title' => 'Dokumentasi Video',
            'video_section_sub' => 'Video dokumentasi kegiatan di Panti Asuhan Santa Susana Timika.',
            'video_empty_message' => 'Belum ada dokumentasi video yang ditambahkan. Nantikan update dokumentasi kegiatan terbaru kami.',
            'video_browser_unsupported' => 'Browser Anda tidak mendukung pemutaran video.',
            'cta_title' => 'Jadilah bagian dari cerita ini',
            'cta_subtitle' => 'Kunjungi kami dan ciptakan momen berharga bersama anak-anak',
            'cta_btn_kunjungan' => 'Kunjungi kami',
            'cta_btn_donasi' => 'Donasi',
            'lightbox_close_label' => 'Tutup',
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    public static function resolvedForPublic(): object
    {
        $defaults = static::defaults();

        if (! Schema::hasTable('galeri_page_contents')) {
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
