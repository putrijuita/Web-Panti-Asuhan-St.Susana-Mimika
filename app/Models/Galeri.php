<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'galeri_category_id',
        'gambar',
        'nama',
        'keterangan',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(GaleriCategory::class, 'galeri_category_id');
    }
}

