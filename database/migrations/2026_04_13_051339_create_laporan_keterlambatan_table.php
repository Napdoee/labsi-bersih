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
        Schema::create('laporan_keterlambatan', function (Blueprint $table) {
            $table->id('id_laporan_terlambat');

            $table->unsignedBigInteger('id_matkul');
            $table->unsignedBigInteger('id_asisten');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_jadwal');
            $table->unsignedBigInteger('id_user');

            $table->integer('keterlambatan');
            $table->text('deskripsi')->nullable();
            $table->dateTime('waktu_lapor')->useCurrent();

            $table->foreign('id_matkul')
                  ->references('id_matkul')
                  ->on('mata_kuliah')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_asisten')
                  ->references('id_asisten')
                  ->on('asisten')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_jadwal')
                  ->references('id_jadwal')
                  ->on('jadwal')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_keterlambatan');
    }
};
