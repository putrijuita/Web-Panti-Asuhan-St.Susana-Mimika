<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('kontak_pesan')) {
            return;
        }

        Schema::table('kontak_pesan', function (Blueprint $table) {
            if (! Schema::hasColumn('kontak_pesan', 'replied_at')) {
                $table->timestamp('replied_at')->nullable()->after('read_at');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('kontak_pesan')) {
            return;
        }

        Schema::table('kontak_pesan', function (Blueprint $table) {
            if (Schema::hasColumn('kontak_pesan', 'replied_at')) {
                $table->dropColumn('replied_at');
            }
        });
    }
};
