<?php

namespace App\Models;
use App\Models\AccessRecord;

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
    protected $table = 'access_records';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'docente', 'nombre');
    }
}

