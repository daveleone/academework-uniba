<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GivenAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'quiz_id', 'exercise_id',];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function tfAnsElements()
    {
        return $this->hasMany(TfAnsElement::class);
    }

    public function closedAnsElements()
    {
        return $this->hasMany(ClosedAnsElement::class);
    }

    public function openAnsElements()
    {
        return $this->hasMany(OpenAnsElement::class);
    }

    public function fillAnsElements()
    {
        return $this->hasMany(FillAnsElement::class);
    }
}
