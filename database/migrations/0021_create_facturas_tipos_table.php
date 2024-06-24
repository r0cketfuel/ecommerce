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
        Schema::create('facturas_tipos', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('tipo',1);
            $table->string('descripcion',100);
            $table->comment('Tabla con los tipos de factura utilizados en la facturación');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_tipos');
    }
};
