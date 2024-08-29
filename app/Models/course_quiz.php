<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'course_id',
        'start_time',
        'duration_minutes',
        'repeatable' 
    ];
    
    protected $table = "course_quiz";
}
