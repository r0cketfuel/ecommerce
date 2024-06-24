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
        Schema::create('reviews', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->unsignedMediumInteger('usuario_id',);
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('RESTRICT');
            $table->unsignedMediumInteger('articulo_id',);
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('RESTRICT');
            $table->dateTime('fecha');
            $table->string('titulo',50);
            $table->string('texto',255);
            $table->comment('Tabla con las reviews de los artículos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
