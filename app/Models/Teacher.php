<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'date_of_birth',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects')
                    ->withPivot('grade_id')
                    ->withTimestamps();
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
