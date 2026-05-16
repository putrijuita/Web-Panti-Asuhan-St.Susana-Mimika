<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class AnakAsuhPageContent extends Model
{
    protected $table = 'anak_asuh_page_contents';

    protected $fillable = [
        'page_meta_title',
        'layout_page_title',
        'layout_page_subtitle',
        'hero_title',
        'hero_subtitle',
        'empty_text',
    ];

    public static function defaults(): array
    {
        return [
            'page_meta_title' => 'Anak Asuh - Panti Asuhan Santa Susana Timika',
            'layout_page_title' => 'Anak Asuh',
            'layout_page_subtitle' => 'Nama panggilan dan foto anak asuh',
            'hero_title' => 'Data Anak Asuh',
            'hero_subtitle' => 'Berikut foto dan nama panggilan anak asuh. Hanya anak dengan nama panggilan yang diisi yang ditampilkan di halaman ini.',
            'empty_text' => 'Belum ada anak asuh yang ditampilkan. Pastikan nama panggilan terisi pada data di panel admin.',
        ];
    }

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1], static::defaults());
    }

    public static function resolvedForPublic(): object
    {
        $defaults = static::defaults();

        if (! Schema::hasTable('anak_asuh_page_contents')) {
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
