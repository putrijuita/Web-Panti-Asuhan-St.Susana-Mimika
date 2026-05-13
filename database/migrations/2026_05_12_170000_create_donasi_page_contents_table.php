<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_meta_title')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_badge_keuangan_icon')->nullable();
            $table->string('hero_badge_keuangan_text')->nullable();
            $table->string('hero_badge_separator')->nullable();
            $table->string('hero_badge_jasa_icon')->nullable();
            $table->string('hero_badge_jasa_text')->nullable();
            $table->string('hero_title_line1')->nullable();
            $table->string('hero_word_red')->nullable();
            $table->string('hero_word_green')->nullable();
            $table->text('hero_subtitle')->nullable();

            $table->string('card_keu_top_icon')->nullable();
            $table->string('card_keu_pill')->nullable();
            $table->string('card_keu_title')->nullable();
            $table->text('card_keu_intro')->nullable();
            $table->string('card_keu_feat1')->nullable();
            $table->string('card_keu_feat2')->nullable();
            $table->string('card_keu_feat3')->nullable();
            $table->string('card_keu_feat4')->nullable();
            $table->string('card_keu_cta')->nullable();

            $table->string('card_jasa_top_icon')->nullable();
            $table->string('card_jasa_pill')->nullable();
            $table->string('card_jasa_title')->nullable();
            $table->text('card_jasa_intro')->nullable();
            $table->string('card_jasa_feat1')->nullable();
            $table->string('card_jasa_feat2')->nullable();
            $table->string('card_jasa_feat3')->nullable();
            $table->string('card_jasa_feat4')->nullable();
            $table->string('card_jasa_cta')->nullable();

            $table->string('section_grafik_icon')->nullable();
            $table->string('section_grafik_title')->nullable();
            $table->string('stat_lbl_pemasukan')->nullable();
            $table->string('stat_lbl_pengeluaran')->nullable();
            $table->string('stat_lbl_sisa')->nullable();
            $table->string('section_table_icon')->nullable();
            $table->string('section_table_title')->nullable();
            $table->string('tbl_th_nama')->nullable();
            $table->string('tbl_th_email')->nullable();
            $table->string('tbl_th_nominal')->nullable();
            $table->string('tbl_th_waktu')->nullable();
            $table->string('tbl_empty_msg')->nullable();
            $table->string('chart_lbl_pemasukan')->nullable();
            $table->string('chart_lbl_pengeluaran')->nullable();
            $table->string('chart_lbl_sisa')->nullable();

            $table->text('dl1_text')->nullable();
            $table->string('dl1_btn')->nullable();
            $table->text('dl2_text')->nullable();
            $table->string('dl2_btn')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_page_contents');
    }
};
