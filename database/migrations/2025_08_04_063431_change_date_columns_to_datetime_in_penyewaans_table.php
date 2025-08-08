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
            $table->dateTime('tanggal_sewa')->change();
            $table->dateTime('tanggal_kembali')->change();
            $table->dateTime('tanggal_kembali_aktual')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->date('tanggal_sewa')->change();
            $table->date('tanggal_kembali')->change();
            $table->date('tanggal_kembali_aktual')->nullable()->change();
        });
    }
};