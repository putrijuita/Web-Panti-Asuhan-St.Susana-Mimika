<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $fillable = ['nama', 'email', 'telepon', 'tanggal_kunjungan', 'instansi', 'keperluan', 'catatan', 'status'];
}
