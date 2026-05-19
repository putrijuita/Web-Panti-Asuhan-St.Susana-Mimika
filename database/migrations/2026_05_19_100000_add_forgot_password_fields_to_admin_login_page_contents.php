<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin_login_page_contents', function (Blueprint $table) {
            $table->string('forgot_password_label')->nullable()->after('remember_label');
            $table->string('forgot_password_url')->nullable()->after('forgot_password_label');
        });
    }

    public function down(): void
    {
        Schema::table('admin_login_page_contents', function (Blueprint $table) {
            $table->dropColumn(['forgot_password_label', 'forgot_password_url']);
        });
    }
};
