<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiJasa extends Model
{
    protected $fillable = [
        'nama', 'email', 'telepon', 'jenis_jasa', 'keahlian',
        'tanggal_mulai', 'durasi', 'instansi', 'deskripsi', 'catatan', 'status'
    ];
}
