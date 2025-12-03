<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'score',
        'term',
        'grading_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
