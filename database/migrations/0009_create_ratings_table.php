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
        Schema::create('ratings', function (Blueprint $table) {
            $table->unsignedMediumInteger('id',true);
            $table->unsignedMediumInteger('articulo_id');
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('RESTRICT');
            $table->unsignedMediumInteger('visualizaciones')->default(0);
            $table->unsignedMediumInteger('puntuaciones')->default(0);
            $table->unsignedMediumInteger('sumatoria')->default(0);
            $table->Float('promedio')->unsigned()->default(0);
            $table->comment('Tabla con las estadísticas de cada artículo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
