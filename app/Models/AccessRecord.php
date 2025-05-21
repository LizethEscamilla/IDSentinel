<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRecord extends Model
{
    use HasFactory;

    protected $table = 'access_records';

    protected $primaryKey = 'id';

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'career_group_id',
        'software_type_id',
        'rfid',
        'num_alumnos',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_entrada' => 'datetime',
        'hora_salida' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function careerGroup()
    {
        return $this->belongsTo(CareerGroup::class);
    }

    public function softwareType()
    {
        return $this->belongsTo(SoftwareType::class);
    }
}
