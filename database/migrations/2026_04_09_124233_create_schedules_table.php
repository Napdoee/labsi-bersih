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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('subject');    // Nama Mata Kuliah
            $table->string('class');      // A, B, C, dsb
            $table->string('day');        // Senin, Selasa, dsb (Sesuai request Anda)
            $table->time('start_time');   // Jam mulai (Contoh: 08:00)
            $table->time('end_time');     // Jam selesai (Contoh: 09:40)
            $table->string('room');       // Lab 401, 402, 403
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
