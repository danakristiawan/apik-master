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
        Schema::create('data_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_satker', 6);
            $table->string('nama_bank', 8);
            $table->string('nomor_rekening', 32);
            $table->string('tanggal', 2);
            $table->string('bulan', 2);
            $table->string('tahun', 4);
            $table->string('tipe', 1);
            $table->string('jenis', 64);
            $table->string('kode', 2);
            $table->decimal('debet', 15, 2);
            $table->decimal('kredit', 15, 2);
            $table->string('keterangan', 255);
            $table->string('status', 1)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_transaksi');
    }
};
