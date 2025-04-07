<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('access_records', function (Blueprint $table) {
            $table->id('id_registro');

            $table->string('docente', 100);
            $table->foreign('docente')->references('nombre')->on('teachers')->onDelete('cascade');

            $table->string('rfid', 50);

            $table->string('materia', 50);
            $table->foreign('materia')->references('nombre')->on('subjects')->onDelete('cascade');

            $table->integer('num_alumnos');

            $table->text('grupo_carrera');
            $table->foreign('grupo_carrera')->references('nombre')->on('career_groups')->onDelete('cascade');

            $table->string('tipo_uso_sw', 50);
            $table->foreign('tipo_uso_sw')->references('nombre')->on('software_types')->onDelete('cascade');

            $table->date('fecha');
            $table->time('hora_entrada');
            $table->time('hora_salida')->nullable();
            $table->enum('estado', ['ocupado', 'libre']);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('access_records');
    }
};
