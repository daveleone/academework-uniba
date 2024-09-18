<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class exercise_quiz extends Pivot
{
    use HasFactory;

    protected $fillable = [
      'quiz_id',
      'exercise_id'
    ];

    protected $table = 'exercise_quiz';
}
