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
        Schema::create('categorias', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('nombre',40)->unique();
            $table->string('descripcion',255);
            $table->datetime('creado');
            $table->datetime('actualizado')->nullable();
            $table->datetime('eliminado')->nullable();
            $table->comment('Tabla con las categorías de los artículos del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
