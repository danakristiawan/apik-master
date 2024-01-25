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
        Schema::create('ref_kode_sub_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 2);
            $table->string('kode_sub_transaksi', 1);
            $table->string('nama_sub_transaksi', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_kode_sub_transaksi');
    }
};
