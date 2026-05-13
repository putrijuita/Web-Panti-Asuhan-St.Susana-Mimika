<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_contents', function (Blueprint $table) {
            $table->id();

            $table->string('nav_brand_suffix')->nullable();
            $table->string('nav_beranda')->nullable();
            $table->string('nav_tentang')->nullable();
            $table->string('nav_kegiatan')->nullable();
            $table->string('nav_galeri')->nullable();
            $table->string('nav_donasi')->nullable();
            $table->string('nav_kunjungan')->nullable();
            $table->string('nav_kontak')->nullable();

            $table->string('home_btn_donasi')->nullable();
            $table->string('home_btn_kunjungan')->nullable();
            $table->string('home_btn_profil')->nullable();

            $table->string('home_tentang_section_title')->nullable();
            $table->string('home_about_image')->nullable();
            $table->string('home_about_image_alt')->nullable();
            $table->string('home_visual_title')->nullable();
            $table->string('home_visual_subtitle')->nullable();
            $table->string('home_tentang_cta_label')->nullable();

            $table->string('home_kontak_title')->nullable();
            $table->text('home_kontak_intro')->nullable();
            $table->string('home_kontak_phone_heading')->nullable();
            $table->string('home_kontak_phone_display')->nullable();
            $table->string('home_kontak_phone_href')->nullable();
            $table->string('home_kontak_wa_text')->nullable();
            $table->string('home_kontak_wa_url')->nullable();
            $table->string('home_kontak_fb_heading')->nullable();
            $table->string('home_kontak_fb_text')->nullable();
            $table->string('home_kontak_fb_url')->nullable();
            $table->string('home_kontak_ig_heading')->nullable();
            $table->string('home_kontak_ig_text')->nullable();
            $table->string('home_kontak_ig_url')->nullable();
            $table->string('home_kontak_addr_heading')->nullable();
            $table->string('home_kontak_addr_text')->nullable();

            $table->string('footer_brand_name')->nullable();
            $table->text('footer_brand_desc')->nullable();
            $table->string('footer_heading_menu')->nullable();
            $table->string('footer_heading_kegiatan')->nullable();
            $table->string('footer_heading_kontak')->nullable();
            $table->string('footer_menu_beranda')->nullable();
            $table->string('footer_menu_tentang')->nullable();
            $table->string('footer_menu_kegiatan')->nullable();
            $table->string('footer_menu_galeri')->nullable();
            $table->string('footer_menu_donasi')->nullable();
            $table->string('footer_menu_kunjungan')->nullable();
            $table->string('footer_menu_kontak')->nullable();
            $table->string('footer_kegiatan_rutin')->nullable();
            $table->string('footer_kegiatan_unggulan')->nullable();
            $table->string('footer_kegiatan_lainnya')->nullable();
            $table->string('footer_phone_display')->nullable();
            $table->string('footer_phone_href')->nullable();
            $table->string('footer_fb_text')->nullable();
            $table->string('footer_fb_url')->nullable();
            $table->string('footer_ig_text')->nullable();
            $table->string('footer_ig_url')->nullable();
            $table->string('footer_address')->nullable();
            $table->string('footer_sosmed_fb_url')->nullable();
            $table->string('footer_sosmed_phone_href')->nullable();
            $table->string('footer_sosmed_ig_url')->nullable();
            $table->string('footer_copyright_left')->nullable();
            $table->string('footer_copyright_right')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_contents');
    }
};
