<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)->using(CourseStudent::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function averageGradeForCourse($courseId)
    {
        return $this->marks()
            ->whereHas('quiz', function($query) use ($courseId) {
                $query->whereHas('courses', function($subQuery) use ($courseId) {
                    $subQuery->where('course_id', $courseId)
                        ->where('course_quiz.repeatable', false);
                });
            })
            ->avg('mark');
    }

    public function lastGradeForCourse($courseId)
    {
        return $this->marks()
            ->whereHas('quiz.courses', function($query) use ($courseId) {
                $query->where('course_id', $courseId)
                    ->where('course_quiz.repeatable', false);
            })
            ->latest('created_at')
            ->first();
    }



    use HasFactory;
}
