<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();  // Columna id como clave primaria
            $table->string('nombre', 100)->unique();  // Nombre de la materia
            $table->timestamps();  // Marcas de tiempo para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};

