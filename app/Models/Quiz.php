<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'creator_id'        
    ];

    public function creator() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercises() : BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'exercise_quiz');
    }

}
