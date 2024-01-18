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
        Schema::create('to_good_to_go_restaurants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('tipus_plat_id');
            $table->integer('quantitat');
            $table->integer('restaurant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('to_good_to_go_restaurants');
    }
};
