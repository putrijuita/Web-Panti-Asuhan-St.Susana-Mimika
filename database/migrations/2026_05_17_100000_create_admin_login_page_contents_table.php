<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_login_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('hero_badge_text')->nullable();
            $table->string('hero_badge_icon', 120)->nullable();
            $table->string('hero_title_prefix')->nullable();
            $table->string('hero_title_emphasis')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->boolean('use_site_body_background')->default(true);
            $table->string('form_title')->nullable();
            $table->text('form_subtitle')->nullable();
            $table->string('email_label')->nullable();
            $table->string('email_placeholder')->nullable();
            $table->string('password_label')->nullable();
            $table->string('password_placeholder')->nullable();
            $table->string('remember_label')->nullable();
            $table->string('submit_text')->nullable();
            $table->string('footer_link_text')->nullable();
            $table->text('cms_note_admin')->nullable();
            $table->text('cms_note_super_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_login_page_contents');
    }
};
