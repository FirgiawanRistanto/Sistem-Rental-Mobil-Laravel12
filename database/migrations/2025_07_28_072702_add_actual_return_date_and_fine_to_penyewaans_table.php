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
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->date('tanggal_kembali_aktual')->nullable()->after('tanggal_kembali');
            $table->integer('denda')->default(0)->after('total_biaya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kembali_aktual', 'denda']);
        });
    }
};
