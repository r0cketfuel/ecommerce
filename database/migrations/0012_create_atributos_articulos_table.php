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
        Schema::create('atributos_articulos', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->unsignedMediumInteger('articulo_id');
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->unsignedTinyInteger('talle_id')->nullable();
            $table->foreign('talle_id')->references('id')->on('talles')->onDelete('CASCADE');
            $table->string('color',7)->nullable();
            $table->unsignedMediumInteger('compra_min')->nullable()->default(NULL);
            $table->unsignedMediumInteger('compra_max')->nullable()->default(NULL);
            $table->unsignedMediumInteger('stock');
            $table->unsignedBigInteger('imagen_id')->nullable()->default(NULL);
            $table->foreign('imagen_id')->references('id')->on('imagenes_articulos')->onDelete('SET NULL');
            $table->comment('Tabla con las distintas variaciones de los artículos, límites de compra y su stock individual');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atributos_articulos');
    }
};
