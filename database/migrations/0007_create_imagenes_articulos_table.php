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
        Schema::create('imagenes_articulos', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->unsignedMediumInteger('articulo_id');
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->string('ruta', 100);
            $table->string('descripcion', 255)->nullable();
            $table->comment('Tabla con las imágenes de cada artículo del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_articulos');
    }
};
