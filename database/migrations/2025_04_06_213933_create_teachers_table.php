<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Crear tabla de docentes
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();  // Columna 'id' como clave primaria
            $table->string('nombre', 100)->unique();  // Nombre del docente, único
            $table->string('rfid', 100);  // RFID obligatorio para el docente
            $table->timestamps();  // Tiempos de creación y actualización
        });
    }

    public function down()
    {
        // Eliminar la tabla de docentes si se deshace la migración
        Schema::dropIfExists('teachers');
    }
};
