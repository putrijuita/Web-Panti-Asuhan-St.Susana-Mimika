<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakPesan extends Model
{
    protected $table = 'kontak_pesan';

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'read_at',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }
}
