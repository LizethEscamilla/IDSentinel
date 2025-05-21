<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerGroup extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Relación inversa con docentes
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_career_group', 'career_group_id', 'teacher_id');
    }
}

