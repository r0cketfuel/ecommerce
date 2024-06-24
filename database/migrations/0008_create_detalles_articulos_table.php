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
        Schema::create('detalles_articulos', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->unsignedMediumInteger('articulo_id')->unique();
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->string('detalle',10240);
            $table->datetime('creado');
            $table->datetime('actualizado')->nullable();
            $table->comment('Tabla con la información detallada de cada artículo del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_articulos');
    }
};
