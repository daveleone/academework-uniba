<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class course_quiz extends Pivot
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

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
