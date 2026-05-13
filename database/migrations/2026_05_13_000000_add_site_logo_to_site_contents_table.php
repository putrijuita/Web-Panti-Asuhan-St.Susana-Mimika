<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('site_contents')) {
            return;
        }

        Schema::table('site_contents', function (Blueprint $table) {
            if (! Schema::hasColumn('site_contents', 'site_logo')) {
                $table->string('site_logo')->nullable()->after('nav_kontak');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_contents')) {
            return;
        }

        Schema::table('site_contents', function (Blueprint $table) {
            if (Schema::hasColumn('site_contents', 'site_logo')) {
                $table->dropColumn('site_logo');
            }
        });
    }
};
