<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKegiatanAnak extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kegiatan_anak';

    protected $fillable = [
        'judul',
        'kategori',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'aktif',
        'urutan',
        'deskripsi',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        // time column akan diparsing menjadi Carbon (tanggal mengikuti hari ini)
    ];

    public static function daftarHari(): array
    {
        return [
            'setiap_hari' => 'Setiap hari',
            'senin' => 'Senin',
            'selasa' => 'Selasa',
            'rabu' => 'Rabu',
            'kamis' => 'Kamis',
            'jumat' => 'Jumat',
            'sabtu' => 'Sabtu',
            'minggu' => 'Minggu',
        ];
    }
}

