<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $fillable = ['nama', 'email', 'telepon', 'nominal', 'catatan', 'status'];
}
