<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trash_reports', function (Blueprint $table) {
            $table->id();
            // Siapa yang lapor (Login User)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('room');           // Lokasi Lab
            $table->string('image');          // Path foto bukti sampah
            $table->text('description');      // Catatan laporan

            // Relasi pinalti (Menyimpan data sesi mana yang kena pinalti)
            $table->foreignId('penalty_schedule_id')->nullable()->constrained('schedules')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_reports');
    }
};
