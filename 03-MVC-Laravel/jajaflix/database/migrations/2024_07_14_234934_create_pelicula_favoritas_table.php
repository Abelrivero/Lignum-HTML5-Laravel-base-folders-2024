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
        Schema::create('pelicula_favoritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peliculaId')->references('id')->on('peliculas')->onDelete('cascade');
            $table->integer('usuarioId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelicula_favoritas');
    }
};
