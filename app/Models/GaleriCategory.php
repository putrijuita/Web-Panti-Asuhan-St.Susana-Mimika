<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GaleriCategory extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function galeris(): HasMany
    {
        return $this->hasMany(Galeri::class, 'galeri_category_id');
    }
}

