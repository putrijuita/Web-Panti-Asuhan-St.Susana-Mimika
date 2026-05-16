<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            $table->string('nav_anak_asuh', 80)->nullable()->after('nav_tentang');
            $table->string('footer_menu_anak_asuh', 80)->nullable()->after('footer_menu_tentang');
        });

        if (Schema::hasTable('site_contents')) {
            DB::table('site_contents')->whereNull('nav_anak_asuh')->update([
                'nav_anak_asuh' => 'Anak asuh',
                'footer_menu_anak_asuh' => 'Data anak asuh',
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            $table->dropColumn(['nav_anak_asuh', 'footer_menu_anak_asuh']);
        });
    }
};
