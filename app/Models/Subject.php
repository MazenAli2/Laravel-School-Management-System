<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects')
                    ->withPivot('grade_id')
                    ->withTimestamps();
    }
}
