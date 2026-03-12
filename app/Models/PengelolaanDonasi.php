<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaanDonasi extends Model
{
    use HasFactory;

    protected $table = 'pengelolaan_donasi';

    protected $fillable = [
        'nama',
        'jumlah',
        'gambar',
        'tanggal_waktu',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
        'jumlah' => 'decimal:0',
    ];
}
