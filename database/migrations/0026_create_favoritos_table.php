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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->unsignedMediumInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('CASCADE');
            $table->unsignedMediumInteger('articulo_id');
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->unique(['usuario_id', 'articulo_id']);
            $table->dateTime('creado');
            $table->dateTime('actualizado')->nullable()->default(NULL);
            $table->dateTime('eliminado')->nullable()->default(NULL);
            $table->comment('Tabla con los articulos favoritos de los usuarios del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
