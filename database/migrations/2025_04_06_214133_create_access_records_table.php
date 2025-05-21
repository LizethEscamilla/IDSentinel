<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('access_records', function (Blueprint $table) {
            $table->id(); // Clave primaria como 'id'

            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->string('rfid', 50);
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->integer('num_alumnos');
            $table->foreignId('career_group_id')->constrained('career_groups')->onDelete('cascade');
            $table->foreignId('software_type_id')->constrained('software_types')->onDelete('cascade');
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