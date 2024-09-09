<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'quiz_id',
        'mark'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
