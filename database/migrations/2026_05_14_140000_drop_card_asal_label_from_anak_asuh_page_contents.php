<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('anak_asuh_page_contents')) {
            return;
        }

        if (! Schema::hasColumn('anak_asuh_page_contents', 'card_asal_label')) {
            return;
        }

        Schema::table('anak_asuh_page_contents', function (Blueprint $table) {
            $table->dropColumn('card_asal_label');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('anak_asuh_page_contents')) {
            return;
        }

        if (Schema::hasColumn('anak_asuh_page_contents', 'card_asal_label')) {
            return;
        }

        Schema::table('anak_asuh_page_contents', function (Blueprint $table) {
            $table->string('card_asal_label')->nullable();
        });
    }
};
