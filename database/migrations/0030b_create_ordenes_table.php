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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->unsignedInteger('id',true);
            $table->unsignedInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('RESTRICT');
            $table->unsignedTinyInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('ordenes_estados')->onDelete('RESTRICT');
            $table->datetime('creado');
            $table->datetime('actualizado')->nullable();
            $table->comment('Tabla con las ordenes del sistema y sus correspondientes estados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
