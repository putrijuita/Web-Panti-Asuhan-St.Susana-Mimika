<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tentang_contents', function (Blueprint $table) {
            $table->id();
            $table->string('hero_kicker')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('summary_subtitle')->nullable();
            $table->text('summary_paragraph_1')->nullable();
            $table->text('summary_paragraph_2')->nullable();
            $table->text('summary_cta_note')->nullable();
            $table->string('tentang_hero_title')->nullable();
            $table->text('tentang_hero_description')->nullable();
            $table->text('visi_text')->nullable();
            $table->json('misi_items')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tentang_contents');
    }
};

