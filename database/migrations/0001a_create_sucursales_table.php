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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('nombre', 50)->nullable();
            $table->string('direccion', 50)->nullable();
            $table->string('entre_calles_1', 50)->nullable();
            $table->string('entre_calles_2', 50)->nullable();
            $table->string('codigo_postal', 50)->nullable();
            $table->string('local', 50)->nullable();
            $table->string('barrio', 50)->nullable();
            $table->string('localidad', 50)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('pais', 50)->nullable();
            $table->string('telefono_1', 15)->nullable();
            $table->string('telefono_2', 15)->nullable();
            $table->string('fax', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('geolocalizacion', 40)->nullable();
            $table->boolean('principal')->nullable();
            $table->datetime('creado');
            $table->datetime('actualizado')->nullable();
            $table->datetime('eliminado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
