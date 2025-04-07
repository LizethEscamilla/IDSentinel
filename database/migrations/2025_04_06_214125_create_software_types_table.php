<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('software_types', function (Blueprint $table) {
            $table->id('id_sw');
            $table->string('nombre', 50)->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('software_types');
    }
};

