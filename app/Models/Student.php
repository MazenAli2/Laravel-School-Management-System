<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Guardian;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade_id',
        'section_id',
        'guardian_id',
        'admission_date',
        'roll_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }
}
