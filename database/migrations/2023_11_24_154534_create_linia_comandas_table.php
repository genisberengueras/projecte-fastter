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
        Schema::create('linia_comandas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('comanda_id');
            $table->string('primer_plat');
            $table->string('segon_plat');
            $table->string('postres');
            $table->integer('preu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linia_comandas');
    }
};
