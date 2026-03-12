<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengelolaan_donasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('jumlah', 15, 0);
            $table->string('gambar')->nullable();
            $table->dateTime('tanggal_waktu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengelolaan_donasi');
    }
};
