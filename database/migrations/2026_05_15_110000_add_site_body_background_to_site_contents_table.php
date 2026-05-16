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
            if (! Schema::hasColumn('site_contents', 'site_body_background')) {
                $table->string('site_body_background')->nullable()->after('site_logo');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('site_contents')) {
            return;
        }

        Schema::table('site_contents', function (Blueprint $table) {
            if (Schema::hasColumn('site_contents', 'site_body_background')) {
                $table->dropColumn('site_body_background');
            }
        });
    }
};
