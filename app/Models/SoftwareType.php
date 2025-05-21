<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareType extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relación inversa con docentes
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_software_type', 'software_type_id', 'teacher_id');
    }
}

