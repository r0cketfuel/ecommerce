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
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('banco', 11);
            $table->string('cuit', 11);
            $table->string('titular', 50);
            $table->string('cuenta', 50);
            $table->string('cbu', 22);
            $table->string('alias', 50);
            $table->comment('Tabla con la información de las cuentas bancarias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
};
