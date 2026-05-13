<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('kontak_page_contents')) {
            return;
        }

        Schema::table('kontak_page_contents', function (Blueprint $table) {
            if (! Schema::hasColumn('kontak_page_contents', 'addr_maps_url')) {
                $table->text('addr_maps_url')->nullable()->after('addr_line3');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('kontak_page_contents')) {
            return;
        }

        Schema::table('kontak_page_contents', function (Blueprint $table) {
            if (Schema::hasColumn('kontak_page_contents', 'addr_maps_url')) {
                $table->dropColumn('addr_maps_url');
            }
        });
    }
};
