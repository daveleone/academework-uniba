<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exercise_quiz extends Model
{
    use HasFactory;

    protected $fillable = [
      'quiz_id',
      'exercise_id'
    ];

    protected $table = 'exercise_quiz';
}
