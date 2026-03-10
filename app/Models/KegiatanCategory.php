<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KegiatanCategory extends Model
{
    protected $fillable = ['nama'];

    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'kegiatan_category_id');
    }
}

