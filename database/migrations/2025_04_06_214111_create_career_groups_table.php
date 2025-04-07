<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('career_groups', function (Blueprint $table) {
            $table->id('id_gruposcarreras');
            $table->text('nombre')->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('career_groups');
    }
};
