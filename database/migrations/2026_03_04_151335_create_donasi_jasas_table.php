<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_jasas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->string('jenis_jasa'); // mengajar, medis, memasak, konstruksi, teknologi, dll
            $table->text('keahlian'); // deskripsi keahlian
            $table->date('tanggal_mulai');
            $table->string('durasi'); // 1 hari, 1 minggu, dst
            $table->string('instansi')->nullable();
            $table->text('deskripsi'); // deskripsi rencana jasa
            $table->text('catatan')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_jasas');
    }
};
