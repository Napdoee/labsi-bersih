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
        Schema::table('laporan_sampah', function (Blueprint $table) {
            // Rename id_kelas → id_kelas_pelapor
            $table->dropForeign(['id_kelas']);
            $table->renameColumn('id_kelas', 'id_kelas_pelapor');
        });

        Schema::table('laporan_sampah', function (Blueprint $table) {
            // Re-add foreign key for renamed column
            $table->foreign('id_kelas_pelapor')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            // Kelas yang kena pinalti (nullable, auto-detected)
            $table->unsignedBigInteger('id_kelas_pinalti')->nullable()->after('id_kelas_pelapor');
            $table->foreign('id_kelas_pinalti')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            // Status laporan
            $table->enum('status', ['menunggu', 'diverifikasi', 'ditolak'])
                  ->default('menunggu')
                  ->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_sampah', function (Blueprint $table) {
            $table->dropForeign(['id_kelas_pinalti']);
            $table->dropColumn(['id_kelas_pinalti', 'status']);

            $table->dropForeign(['id_kelas_pelapor']);
            $table->renameColumn('id_kelas_pelapor', 'id_kelas');
        });

        Schema::table('laporan_sampah', function (Blueprint $table) {
            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        });
    }
};
