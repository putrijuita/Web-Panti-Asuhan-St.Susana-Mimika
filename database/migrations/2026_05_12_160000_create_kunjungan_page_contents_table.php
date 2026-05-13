<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungan_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_meta_title')->nullable();
            $table->string('thanks_meta_title')->nullable();
            $table->string('hero_icon')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();

            $table->string('explain_icon')->nullable();
            $table->string('explain_title')->nullable();
            $table->text('explain_li_1')->nullable();
            $table->text('explain_li_2')->nullable();
            $table->text('explain_li_3')->nullable();

            $table->string('flow_icon')->nullable();
            $table->string('flow_title')->nullable();
            $table->string('step1_title')->nullable();
            $table->text('step1_text')->nullable();
            $table->string('step2_title')->nullable();
            $table->text('step2_text')->nullable();
            $table->string('step3_title')->nullable();
            $table->text('step3_text')->nullable();
            $table->string('step4_title')->nullable();
            $table->text('step4_text')->nullable();

            $table->string('activities_icon')->nullable();
            $table->string('activities_title')->nullable();
            $table->text('activities_intro')->nullable();
            $table->string('act1_icon')->nullable();
            $table->string('act1_text')->nullable();
            $table->string('act2_icon')->nullable();
            $table->string('act2_text')->nullable();
            $table->string('act3_icon')->nullable();
            $table->string('act3_text')->nullable();
            $table->string('act4_icon')->nullable();
            $table->string('act4_text')->nullable();
            $table->string('act5_icon')->nullable();
            $table->string('act5_text')->nullable();
            $table->string('act6_icon')->nullable();
            $table->string('act6_text')->nullable();

            $table->string('rules_icon')->nullable();
            $table->string('rules_title')->nullable();
            $table->text('rule1')->nullable();
            $table->text('rule2')->nullable();
            $table->text('rule3')->nullable();
            $table->text('rule4')->nullable();
            $table->text('rule5')->nullable();

            $table->string('form_title')->nullable();
            $table->text('form_intro')->nullable();
            $table->string('lbl_nama')->nullable();
            $table->string('ph_nama')->nullable();
            $table->string('lbl_email')->nullable();
            $table->string('ph_email')->nullable();
            $table->string('lbl_telepon')->nullable();
            $table->string('tag_optional')->nullable();
            $table->string('ph_telepon')->nullable();
            $table->string('lbl_tanggal')->nullable();
            $table->text('note_tanggal')->nullable();
            $table->string('lbl_instansi')->nullable();
            $table->string('tag_optional_instansi')->nullable();
            $table->string('ph_instansi')->nullable();
            $table->string('lbl_keperluan')->nullable();
            $table->string('ph_keperluan')->nullable();
            $table->text('note_keperluan')->nullable();
            $table->string('lbl_catatan')->nullable();
            $table->string('tag_optional_catatan')->nullable();
            $table->string('ph_catatan')->nullable();
            $table->text('note_catatan')->nullable();
            $table->string('btn_submit_icon')->nullable();
            $table->string('btn_submit_text')->nullable();
            $table->string('form_footer_icon')->nullable();
            $table->string('form_footer_text')->nullable();

            $table->string('thanks_emoji')->nullable();
            $table->string('thanks_title')->nullable();
            $table->text('thanks_body')->nullable();
            $table->string('thanks_btn_text')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan_page_contents');
    }
};
