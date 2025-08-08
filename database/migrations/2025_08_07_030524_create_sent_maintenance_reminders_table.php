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
        Schema::create('sent_maintenance_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            $table->date('maintenance_date');
            $table->integer('reminder_days_before');
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();

            $table->unique(['mobil_id', 'maintenance_date', 'reminder_days_before'], 'unique_reminder');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sent_maintenance_reminders');
    }
};
