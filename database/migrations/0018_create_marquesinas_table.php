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
        Schema::create('marquesinas', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('mensaje', 50);
            $table->dateTime('valido_desde');
            $table->dateTime('valido_hasta');
            $table->datetime('creado');
            $table->datetime('actualizado')->nullable();
            $table->datetime('eliminado')->nullable();
            $table->comment('Tabla con las marquesinas que se muestran en el top header');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marquesinas');
    }
};
