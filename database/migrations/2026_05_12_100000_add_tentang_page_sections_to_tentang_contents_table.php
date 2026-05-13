<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tentang_contents', function (Blueprint $table) {
            $table->string('page_meta_title')->nullable();
            $table->string('vm_section_label')->nullable();
            $table->string('vm_visi_icon')->nullable();
            $table->string('vm_misi_icon')->nullable();
            $table->string('vm_visi_heading')->nullable();
            $table->string('vm_misi_heading')->nullable();
            $table->string('nilai_section_label')->nullable();
            $table->string('nilai_section_title')->nullable();
            $table->text('nilai_section_sub')->nullable();
            $table->json('nilai_items')->nullable();
            $table->string('sejarah_section_label')->nullable();
            $table->string('sejarah_section_title')->nullable();
            $table->text('sejarah_section_sub')->nullable();
            $table->json('sejarah_items')->nullable();
            $table->string('pengurus_section_label')->nullable();
            $table->string('pengurus_section_title')->nullable();
            $table->text('pengurus_section_sub')->nullable();
            $table->string('cta_title')->nullable();
            $table->string('cta_subtitle')->nullable();
            $table->string('cta_btn_donasi')->nullable();
            $table->string('cta_btn_kunjungan')->nullable();
            $table->string('cta_btn_kontak')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tentang_contents', function (Blueprint $table) {
            $table->dropColumn([
                'page_meta_title',
                'vm_section_label',
                'vm_visi_icon',
                'vm_misi_icon',
                'vm_visi_heading',
                'vm_misi_heading',
                'nilai_section_label',
                'nilai_section_title',
                'nilai_section_sub',
                'nilai_items',
                'sejarah_section_label',
                'sejarah_section_title',
                'sejarah_section_sub',
                'sejarah_items',
                'pengurus_section_label',
                'pengurus_section_title',
                'pengurus_section_sub',
                'cta_title',
                'cta_subtitle',
                'cta_btn_donasi',
                'cta_btn_kunjungan',
                'cta_btn_kontak',
            ]);
        });
    }
};
