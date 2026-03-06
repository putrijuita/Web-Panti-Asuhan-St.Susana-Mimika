<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $fillable = ['order_id', 'nama', 'email', 'telepon', 'nominal', 'catatan', 'status', 'midtrans_snap_token', 'payment_type'];
}
