<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * Urutkan hari seperti FIELD() di MySQL, tetapi kompatibel SQLite/PostgreSQL.
     */
    public function scopeOrderedByHariUrutanJam(Builder $query): Builder
    {
        return $query->orderByRaw(
            'CASE hari '
                ."WHEN 'setiap_hari' THEN 1 WHEN 'senin' THEN 2 WHEN 'selasa' THEN 3 WHEN 'rabu' THEN 4 "
                ."WHEN 'kamis' THEN 5 WHEN 'jumat' THEN 6 WHEN 'sabtu' THEN 7 WHEN 'minggu' THEN 8 "
                .'ELSE 99 END, urutan, jam_mulai'
        );
    }
}
