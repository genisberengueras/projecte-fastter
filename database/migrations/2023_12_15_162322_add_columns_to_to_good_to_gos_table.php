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
        Schema::table('to_good_to_gos', function (Blueprint $table) {
            $table->text('nom');
            $table->float('preu');
            $table->dateTime('data');
            $table->integer('quantitat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gos', function (Blueprint $table) {
            //
        });
    }
};
