<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'grade',
        'average_grade',
        'last_grade',
        'last_grade_date'
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

    public function quizGrades()
    {
        return $this->hasMany(StudentQuizGrade::class);
    }

    use HasFactory;
}
