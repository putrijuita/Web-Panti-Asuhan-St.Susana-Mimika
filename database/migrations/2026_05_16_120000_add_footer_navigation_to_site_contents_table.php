<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            if (! Schema::hasColumn('site_contents', 'footer_navigation')) {
                $table->json('footer_navigation')->nullable()->after('footer_copyright_right');
            }
        });
    }

    public function down(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            if (Schema::hasColumn('site_contents', 'footer_navigation')) {
                $table->dropColumn('footer_navigation');
            }
        });
    }
};
