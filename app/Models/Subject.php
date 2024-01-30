<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'teacher_id'
    ];

    public function teacher() : BelongsTo{
        return $this->belongsTo(User::class, 'foreign_id', 'teacher_id'); // Da modificare?
    }

    public function topics() : HasMany{
        return $this->HasMany(Topic::class);
    }

    public function exercises(): HasManyThrough{
        return $this->hasManyThrough(Exercise::class, Topic::class);
    }
}
