<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    protected $fillable = [
        'nama',
        'waktu_kegiatan',
        'gambar',
        'deskripsi',
        'kegiatan_category_id',
    ];

    protected $casts = [
        'waktu_kegiatan' => 'datetime',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KegiatanCategory::class, 'kegiatan_category_id');
    }
}

