<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRecord extends Model {
    use HasFactory;

    protected $fillable = [
        'docente', 'rfid', 'materia', 'num_alumnos',
        'grupo_carrera', 'tipo_uso_sw', 'fecha', 'hora_entrada',
        'hora_salida', 'estado'
    ];

    protected $primaryKey = 'id_registro';
}

