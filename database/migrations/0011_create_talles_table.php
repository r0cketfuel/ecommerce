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
        Schema::create('talles', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('talle',3);
            $table->comment('Tabla con los talles de los artículos del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talles');
    }
};
