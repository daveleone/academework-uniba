<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'course_description',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->using(CourseStudent::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function quizzes() : BelongsToMany
    {
        return $this->belongsToMany(Quiz::class, 'course_quiz')
            ->withPivot('start_time','duration_minutes','repeatable');
    }

    use HasFactory;
}
