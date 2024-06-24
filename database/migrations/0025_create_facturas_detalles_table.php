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
        Schema::create('facturas_detalles', function (Blueprint $table) {
            $table->unsignedInteger('id', true);
            $table->unsignedInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('RESTRICT');
            $table->unsignedMediumInteger('articulo_id');
            $table->decimal('precio');
            $table->unsignedMediumInteger('cantidad');
            $table->decimal('subtotal');
            $table->comment('Tabla con el detalle de cada factura del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_detalles');
    }
};
