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
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->unsignedMediumInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('CASCADE');
            $table->string('nombre',100)->unique();
            $table->string('descripcion',255);
            $table->datetime('creado');
            $table->datetime('actualizado')->nullable();
            $table->datetime('eliminado')->nullable();
            $table->comment('Tabla con las subcategorías de los artículos del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategorias');
    }
};
