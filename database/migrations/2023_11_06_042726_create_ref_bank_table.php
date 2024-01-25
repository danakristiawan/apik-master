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
        Schema::create('ref_bank', function (Blueprint $table) {
            $table->id();
            $table->string('kode_satker', 6);
            $table->string('nomor_rekening', 32);
            $table->string('uraian_rekening', 128);
            $table->string('jenis_rekening', 1);
            $table->string('nama_jenis_rekening', 16);
            $table->string('nama_bank', 16);
            $table->string('surat_izin', 64);
            $table->string('tanggal_surat', 32);
            $table->string('status_rekening', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_bank');
    }
};
