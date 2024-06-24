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
        Schema::create('pagos_mercadopago', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('mercadopago_id', 10);
            $table->unsignedInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('RESTRICT');
            $table->comment('Tabla con el número de pago otorgado por mercadopago asociado a una factura del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_mercadopago');
    }
};
