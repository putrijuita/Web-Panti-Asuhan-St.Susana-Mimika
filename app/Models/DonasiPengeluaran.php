<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiPengeluaran extends Model
{
    protected $fillable = [
        'nama_pengeluaran',
        'jumlah_pengeluaran',
        'gambar_path',
        'tanggal_pengeluaran',
    ];

    protected $casts = [
        'tanggal_pengeluaran' => 'datetime',
        'jumlah_pengeluaran' => 'decimal:2',
    ];
}

