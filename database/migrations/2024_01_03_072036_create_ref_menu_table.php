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
        Schema::create('ref_menu', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 16);
            $table->string('route_name', 16);
            $table->string('url_name', 16);
            $table->string('menu_name', 32);
            $table->string('no_urut', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_menu');
    }
};