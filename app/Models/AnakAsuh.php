<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakAsuh extends Model
{
    use HasFactory;

    protected $table = 'anak_asuh';

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'sekolah',
        'nama_sekolah',
        'asal_daerah',
        'alamat_detail',
        'foto_path',
        'catatan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'sekolah' => 'boolean',
    ];

    public function fotoUrl(): ?string
    {
        if (! $this->foto_path) {
            return null;
        }

        return asset('storage/'.$this->foto_path);
    }
}

