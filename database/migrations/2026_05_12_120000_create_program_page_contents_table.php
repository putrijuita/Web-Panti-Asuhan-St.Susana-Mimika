<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_meta_title')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('unggul_section_label')->nullable();
            $table->string('unggul_section_title')->nullable();
            $table->text('unggul_section_sub')->nullable();
            $table->string('unggul_eyebrow')->nullable();
            $table->string('unggul_chip')->nullable();
            $table->text('unggul_default_desc')->nullable();
            $table->string('unggul_fallback_icon')->nullable();
            $table->string('unggul_donate_btn')->nullable();
            $table->string('unggul_donate_hint')->nullable();
            $table->string('rutin_section_label')->nullable();
            $table->string('rutin_section_title')->nullable();
            $table->text('rutin_section_sub')->nullable();
            $table->string('rutin_pill')->nullable();
            $table->string('rutin_eyebrow')->nullable();
            $table->text('rutin_default_desc')->nullable();
            $table->string('rutin_fallback_icon')->nullable();
            $table->string('empty_section_label')->nullable();
            $table->string('empty_section_title')->nullable();
            $table->text('empty_section_sub')->nullable();
            $table->string('involve_section_label')->nullable();
            $table->string('involve_section_title')->nullable();
            $table->json('involve_steps')->nullable();
            $table->string('cta_title')->nullable();
            $table->string('cta_subtitle')->nullable();
            $table->string('cta_btn_donasi')->nullable();
            $table->string('cta_btn_kunjungan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_page_contents');
    }
};
