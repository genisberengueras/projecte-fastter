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
        Schema::create('linia_comanda_multiples', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('comanda_multpile_id');
            $table->integer('plat_sol_id')->nullable();
            $table->integer('togoodtogo_id')->nullable();
            $table->integer('quantitat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linia_comanda_multiples');
    }
};
