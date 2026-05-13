<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_meta_title')->nullable();
            $table->string('hero_icon')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('filter_btn_semua')->nullable();
            $table->string('album_section_icon')->nullable();
            $table->string('album_section_label')->nullable();
            $table->string('album_section_title')->nullable();
            $table->string('gallery_overlay_tag')->nullable();
            $table->text('gallery_default_caption')->nullable();
            $table->string('empty_title')->nullable();
            $table->text('empty_text')->nullable();
            $table->string('video_section_icon')->nullable();
            $table->string('video_section_label')->nullable();
            $table->string('video_section_title')->nullable();
            $table->text('video_section_sub')->nullable();
            $table->text('video_empty_message')->nullable();
            $table->string('video_browser_unsupported')->nullable();
            $table->string('cta_title')->nullable();
            $table->string('cta_subtitle')->nullable();
            $table->string('cta_btn_kunjungan')->nullable();
            $table->string('cta_btn_donasi')->nullable();
            $table->string('lightbox_close_label')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_page_contents');
    }
};
