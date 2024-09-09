<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'points',
        'topic_id'
        //'teacher_id'
    ];

//    public function teacher() : BelongsTo{
//        return $this->belongsTo(User::class);
//    }

    public function topic() : BelongsTo{
        return $this->belongsTo(Topic::class);
    }

    public function elements() : HasMany | EloquentCollection |Collection{
        switch ($this->type){
            case 'true/false':
                return $this->hasMany(tfExElement::class);
                break;
            case 'open':
                return $this->hasMany(openExElement::class);
                break;
            case 'close':
                return $this->hasMany(closedExElement::class);
                break;
            case 'fill-in':
                return $this->hasMany(fillExElement::class);
                break;
            default:
                return collect();
                break;
        }
    }

    public function quizzes() : BelongsToMany
    {
        return $this->belongsToMany(Quiz::class, 'exercise_quiz');
    }

    
}
