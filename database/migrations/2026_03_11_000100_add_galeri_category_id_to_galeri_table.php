<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->foreignId('galeri_category_id')
                ->nullable()
                ->after('id')
                ->constrained('galeri_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropConstrainedForeignId('galeri_category_id');
        });
    }
};

