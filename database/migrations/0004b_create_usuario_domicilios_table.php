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
        Schema::create('usuarios_domicilios', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->unsignedMediumInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->string('domicilio', 50);
            $table->string('domicilio_nro', 5);
            $table->string('domicilio_piso', 2)->nullable();
            $table->string('domicilio_depto', 2)->nullable();
            $table->string('domicilio_aclaraciones', 150)->nullable();
            $table->string('localidad', 50);
            $table->string('codigo_postal', 10);
            $table->boolean('principal')->nullable();
            $table->dateTime('creado');
            $table->dateTime('actualizado')->nullable()->default(NULL);
            $table->dateTime('eliminado')->nullable()->default(NULL);
            $table->comment('Tabla con los domicilios de los usuarios del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_domicilios');
    }
};
