<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class fillExElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'position',
        'content',
        'type'
    ];

    public function exercise () : BelongsTo{
        return $this->belongsTo(Exercise::class);
    }
}
