<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('career_groups', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();  // Nombre del grupo
            $table->timestamps();  // Marcas de tiempo para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('career_groups');
    }
};
