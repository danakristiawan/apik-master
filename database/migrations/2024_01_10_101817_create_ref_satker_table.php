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
        Schema::create('ref_satker', function (Blueprint $table) {
            $table->id();
            $table->string('kode_satker', 6);
            $table->string('nama_satker', 128);
            $table->string('no_nota_debet', 6);
            $table->string('no_nota_kredit', 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_satker');
    }
};
