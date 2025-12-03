<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'notes',
    ];

    /**
     * Get the sections for the grade.
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
