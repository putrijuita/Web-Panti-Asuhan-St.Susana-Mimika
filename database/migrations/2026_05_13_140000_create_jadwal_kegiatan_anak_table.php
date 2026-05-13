<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_kegiatan_anak', function (Blueprint $table) {
            $table->id();

            $table->string('judul'); // mis. Doa Pagi, Belajar, Istirahat
            $table->string('kategori')->nullable(); // ibadah, belajar, istirahat, rekreasi, dll.

            // Hari kegiatan: gunakan salah satu key dari daftarHari() di model
            $table->string('hari');

            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();

            $table->string('lokasi')->nullable(); // Aula, Ruang Belajar, dll.

            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0); // urutan dalam hari

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_kegiatan_anak');
    }
};

