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
        Schema::table('mobils', function (Blueprint $table) {
            $table->date('jadwal_perawatan_berikutnya')->nullable()->after('status');
            $table->integer('periode_perawatan_hari')->nullable()->after('jadwal_perawatan_berikutnya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->dropColumn('jadwal_perawatan_berikutnya');
            $table->dropColumn('periode_perawatan_hari');
        });
    }
};