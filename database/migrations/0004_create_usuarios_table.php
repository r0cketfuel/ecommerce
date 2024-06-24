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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->string('username', 16)->unique();
            $table->string('password', 60);
            $table->string('apellidos', 50);
            $table->string('nombres', 50);
            $table->unsignedTinyInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id')->references('id')->on('tipos_documentos');
            $table->string('documento_nro', 8)->unique();
            $table->string('cuil', 11)->nullable();
            $table->string('cuit', 11)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedTinyInteger('genero_id')->nullable();
            $table->foreign('genero_id')->references('id')->on('generos')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->string('telefono_fijo', 15)->nullable();
            $table->string('telefono_celular', 15)->nullable();
            $table->string('telefono_alt', 15)->nullable();
            $table->string('email', 50)->unique();
            $table->string('token_verificacion_email', 32)->nullable();
            $table->unsignedTinyInteger('estado')->default(0);
            $table->dateTime('creado');
            $table->dateTime('actualizado')->nullable();
            $table->dateTime('eliminado')->nullable();
            $table->dateTime('alta')->nullable();
            $table->rememberToken();
            $table->comment('Tabla con los usuarios del sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
