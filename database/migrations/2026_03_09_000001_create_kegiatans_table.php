<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->dateTime('waktu_kegiatan')->nullable();
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreignId('kegiatan_category_id')
                ->nullable()
                ->constrained('kegiatan_categories')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};

