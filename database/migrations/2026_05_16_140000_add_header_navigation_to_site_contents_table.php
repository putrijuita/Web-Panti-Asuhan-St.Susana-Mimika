<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            if (! Schema::hasColumn('site_contents', 'header_navigation')) {
                $table->json('header_navigation')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            if (Schema::hasColumn('site_contents', 'header_navigation')) {
                $table->dropColumn('header_navigation');
            }
        });
    }
};
