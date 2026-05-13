<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anak_asuh', function (Blueprint $table) {
            $table->id();

            // Identitas anak asuh
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();

            // Sekolah: sedang sekolah atau tidak
            $table->boolean('sekolah')->default(true);
            $table->string('nama_sekolah')->nullable();

            // Alamat / asal daerah
            $table->string('asal_daerah')->nullable(); // contoh: Timika, Mimika, Papua, dll.
            $table->text('alamat_detail')->nullable(); // alamat rincian (opsional, internal)

            // Media
            $table->string('foto_path')->nullable(); // storage/app/public/*

            // Keterangan internal
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anak_asuh');
    }
};

