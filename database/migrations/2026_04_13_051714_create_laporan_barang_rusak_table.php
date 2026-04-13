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
        Schema::create('laporan_barang_rusak', function (Blueprint $table) {
            $table->id('id_laporan_barang_rusak');

            $table->unsignedBigInteger('id_ruangan');
            $table->unsignedBigInteger('id_user');

            $table->string('foto_barang_rusak', 255);
            $table->string('nama_barang', 100);
            $table->text('deskripsi')->nullable();
            $table->dateTime('waktu_lapor')->useCurrent();

            $table->foreign('id_ruangan')
                  ->references('id_ruangan')
                  ->on('ruangan')
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
        Schema::dropIfExists('laporan_barang_rusak');
    }
};
