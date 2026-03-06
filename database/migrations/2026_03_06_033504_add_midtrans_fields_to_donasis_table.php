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
        Schema::table('donasis', function (Blueprint $table) {
            $table->string('order_id')->nullable()->unique()->after('id');
            $table->string('midtrans_snap_token')->nullable()->after('status');
            $table->string('payment_type')->nullable()->after('midtrans_snap_token');
        });
    }

    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'midtrans_snap_token', 'payment_type']);
        });
    }
};
