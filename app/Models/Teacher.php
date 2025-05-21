<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // 👇 Aquí defines los campos permitidos para asignación masiva
    protected $fillable = ['nombre', 'rfid'];

    // Relación con materias
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject', 'teacher_id', 'subject_id');
    }

    // Relación con grupos
    public function careerGroups()
    {
        return $this->belongsToMany(CareerGroup::class, 'teacher_career_group', 'teacher_id', 'career_group_id');
    }

    // Relación con tipos de software
    public function softwareTypes()
    {
        return $this->belongsToMany(SoftwareType::class, 'teacher_software_type', 'teacher_id', 'software_type_id');
    }
}

