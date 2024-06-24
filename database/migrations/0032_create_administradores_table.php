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
        Schema::create('administradores', function (Blueprint $table) {
            $table->unsignedTinyInteger('id', true);
            $table->string('username', 16);
            $table->string('password', 60);
            $table->string('apellidos', 50);
            $table->string('nombres', 50);
            $table->unsignedTinyInteger('rol_id')->nullable();
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('SET NULL');
            $table->rememberToken();
            $table->datetime('creado');
            $table->datetime('actualizado')->nullable();
            $table->datetime('eliminado')->nullable();
            $table->comment('Tabla con los administradores del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradores');
    }
};
