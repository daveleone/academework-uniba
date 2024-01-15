<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tfExElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'exerciseId',
        'position',
        'content',
        'truth'
    ];
}
