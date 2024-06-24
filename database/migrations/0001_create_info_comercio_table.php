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
        Schema::create('info_comercio', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('nombre', 50)->nullable();
            $table->string('slogan', 50)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->string('cuit', 11)->nullable();
            $table->string('facebook', 50)->nullable();
            $table->string('instagram', 50)->nullable();
            $table->string('twitter', 50)->nullable();
            $table->string('pinterest', 50)->nullable();
            $table->string('tiktok', 50)->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->comment('Tabla con la información del comercio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_comercio');
    }
};
