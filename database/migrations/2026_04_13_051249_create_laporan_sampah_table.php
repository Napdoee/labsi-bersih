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
        Schema::create('laporan_sampah', function (Blueprint $table) {
            $table->id('id_laporan_sampah');

            $table->unsignedBigInteger('id_ruangan');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_user');

            $table->string('foto_sampah', 255);
            $table->dateTime('waktu_lapor')->useCurrent();
            $table->text('deskripsi')->nullable();

            $table->foreign('id_ruangan')
                  ->references('id_ruangan')
                  ->on('ruangan')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('user')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_sampah');
    }
};
