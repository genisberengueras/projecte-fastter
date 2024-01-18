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
        Schema::create('calendaris', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('restaurant_id');
            $table->string('dilluns');
            $table->string('dimarts');
            $table->string('dimecres');
            $table->string('dijous');
            $table->string('divendres');
            $table->string('dissabte');
            $table->string('diumenge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendaris');
    }
};
