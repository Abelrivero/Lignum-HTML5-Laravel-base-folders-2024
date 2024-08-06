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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->date("anio");
            $table->string("titulo", 250);
            $table->bigInteger("duracion");
            $table->text("sinopsis", 250);
            $table->string("imagen")->nullable();
            $table->foreignId("actorPrincipalID")->references("id")->on("actors")->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};
