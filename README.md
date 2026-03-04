# Website Panti Asuhan St. Susana Mimika

Website resmi Yayasan Panti Asuhan St. Susana Mimika dengan tema biru muda.

## Fitur

1. **Donasi** - Form donasi online untuk donatur
2. **Kunjungan** - Form pengajuan kunjungan ke panti asuhan

## Teknologi

- Laravel 12
- PHP 8.3
- SQLite (database)
- Apache (port 80)

## Akses Website

- **URL:** http://localhost (atau IP server Anda)
- **Port:** 80

## Struktur Halaman

- `/` - Beranda
- `/donasi` - Form donasi
- `/kunjungan` - Form pengajuan kunjungan

## Menjalankan Development Server

```bash
cd /home/ubuntu/panti-susana-mimika
php artisan serve --host=0.0.0.0 --port=8000
```

## Database

Data disimpan di `database/database.sqlite`. Untuk melihat data donasi dan kunjungan:

```bash
php artisan tinker
>>> App\Models\Donasi::all();
>>> App\Models\Kunjungan::all();
```

## Pengembangan Selanjutnya

- Integrasi payment gateway untuk donasi
- Panel admin untuk mengelola donasi dan kunjungan
- Fitur galeri foto
- Informasi profil panti asuhan
# Web-Panti-Asuhan-St.Susana-Mimika
