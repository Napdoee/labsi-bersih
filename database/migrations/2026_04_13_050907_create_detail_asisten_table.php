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
        Schema::create('detail_asisten', function (Blueprint $table) {
            $table->id('id_detail_asisten');

            $table->unsignedBigInteger('id_asisten');
            $table->unsignedBigInteger('id_jadwal');

            $table->foreign('id_asisten')
                  ->references('id_asisten')
                  ->on('asisten')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_jadwal')
                  ->references('id_jadwal')
                  ->on('jadwal')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_asisten');
    }
};
