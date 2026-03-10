<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('donasi_pengeluarans')) {
            return;
        }

        Schema::table('donasi_pengeluarans', function (Blueprint $table) {
            if (! Schema::hasColumn('donasi_pengeluarans', 'nama')) {
                $table->string('nama')->after('id')->default('');
            }

            if (! Schema::hasColumn('donasi_pengeluarans', 'jumlah')) {
                $table->decimal('jumlah', 15, 2)->after('nama')->default(0);
            }

            if (! Schema::hasColumn('donasi_pengeluarans', 'gambar')) {
                $table->string('gambar')->nullable()->after('jumlah');
            }

            if (! Schema::hasColumn('donasi_pengeluarans', 'waktu_pengeluaran')) {
                $table->timestamp('waktu_pengeluaran')->nullable()->after('gambar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('donasi_pengeluarans')) {
            return;
        }

        Schema::table('donasi_pengeluarans', function (Blueprint $table) {
            if (Schema::hasColumn('donasi_pengeluarans', 'nama')) {
                $table->dropColumn('nama');
            }

            if (Schema::hasColumn('donasi_pengeluarans', 'jumlah')) {
                $table->dropColumn('jumlah');
            }

            if (Schema::hasColumn('donasi_pengeluarans', 'gambar')) {
                $table->dropColumn('gambar');
            }

            if (Schema::hasColumn('donasi_pengeluarans', 'waktu_pengeluaran')) {
                $table->dropColumn('waktu_pengeluaran');
            }
        });
    }
};

