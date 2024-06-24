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
        Schema::create('cupones', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('codigo', 10);
            $table->unsignedMediumInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('CASCADE');
            $table->dateTime('valido_desde');
            $table->dateTime('valido_hasta');
            $table->unsignedTinyInteger('estado');
            $table->unsignedTinyInteger('tipo_descuento');
            $table->decimal('descuento',10,2);
            $table->comment('Tabla con los cupones de los usuarios del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupones');
    }
};
