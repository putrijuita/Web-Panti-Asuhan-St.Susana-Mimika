<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_meta_title')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_icon')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();

            $table->string('info_block_icon')->nullable();
            $table->string('info_block_title')->nullable();
            $table->string('phone_item_icon')->nullable();
            $table->string('phone_title')->nullable();
            $table->string('phone_href')->nullable();
            $table->string('phone_display')->nullable();
            $table->string('phone_note')->nullable();
            $table->string('fb_item_icon')->nullable();
            $table->string('fb_title')->nullable();
            $table->string('fb_url')->nullable();
            $table->text('fb_link_text')->nullable();
            $table->string('fb_note')->nullable();
            $table->string('ig_item_icon')->nullable();
            $table->string('ig_title')->nullable();
            $table->string('ig_url')->nullable();
            $table->text('ig_link_text')->nullable();
            $table->string('addr_item_icon')->nullable();
            $table->string('addr_title')->nullable();
            $table->string('addr_line1')->nullable();
            $table->string('addr_line2')->nullable();
            $table->string('addr_line3')->nullable();

            $table->string('quick_block_icon')->nullable();
            $table->string('quick_block_title')->nullable();
            $table->string('quick_fb_text')->nullable();
            $table->string('quick_fb_url')->nullable();
            $table->text('quick_ig_text')->nullable();
            $table->string('quick_ig_url')->nullable();
            $table->string('quick_phone_text')->nullable();
            $table->string('quick_phone_url')->nullable();

            $table->string('jam_block_icon')->nullable();
            $table->string('jam_block_title')->nullable();
            $table->string('jam_row1_hari')->nullable();
            $table->string('jam_row1_waktu')->nullable();
            $table->string('jam_row2_hari')->nullable();
            $table->string('jam_row2_waktu')->nullable();
            $table->string('jam_row3_hari')->nullable();
            $table->string('jam_row3_waktu')->nullable();

            $table->string('faq_block_icon')->nullable();
            $table->string('faq_block_title')->nullable();
            $table->string('faq1_q')->nullable();
            $table->text('faq1_a')->nullable();
            $table->string('faq2_q')->nullable();
            $table->text('faq2_a')->nullable();
            $table->string('faq3_q')->nullable();
            $table->text('faq3_a')->nullable();
            $table->string('faq4_q')->nullable();
            $table->text('faq4_a')->nullable();

            $table->string('form_title')->nullable();
            $table->text('form_subtitle')->nullable();
            $table->string('lbl_nama')->nullable();
            $table->string('ph_nama')->nullable();
            $table->string('lbl_email')->nullable();
            $table->string('ph_email')->nullable();
            $table->string('lbl_subjek')->nullable();
            $table->string('select_placeholder')->nullable();
            $table->string('opt1_value')->nullable();
            $table->string('opt1_label')->nullable();
            $table->string('opt2_value')->nullable();
            $table->string('opt2_label')->nullable();
            $table->string('opt3_value')->nullable();
            $table->string('opt3_label')->nullable();
            $table->string('opt4_value')->nullable();
            $table->string('opt4_label')->nullable();
            $table->string('opt5_value')->nullable();
            $table->string('opt5_label')->nullable();
            $table->string('opt6_value')->nullable();
            $table->string('opt6_label')->nullable();
            $table->string('lbl_pesan')->nullable();
            $table->string('ph_pesan')->nullable();
            $table->string('btn_submit_icon')->nullable();
            $table->string('btn_submit_text')->nullable();
            $table->string('form_footer_icon')->nullable();
            $table->string('form_footer_text')->nullable();
            $table->string('divider_text')->nullable();
            $table->string('divider_btn_icon')->nullable();
            $table->string('divider_btn_text')->nullable();
            $table->string('divider_btn_href')->nullable();

            $table->string('success_message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_page_contents');
    }
};
