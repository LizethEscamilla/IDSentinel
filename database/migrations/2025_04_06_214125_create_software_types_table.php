<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('software_types', function (Blueprint $table) {
            $table->id();  // Esto crea la columna 'id' como clave primaria
            $table->string('nombre', 100);  // Nombre del software
            $table->timestamps();  // Marcas de tiempo
        });
    }

    public function down()
    {
        Schema::dropIfExists('software_types');
    }
};

