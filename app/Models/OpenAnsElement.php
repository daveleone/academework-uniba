<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenAnsElement extends Model
{
    use HasFactory;

    protected $fillable = ['answer_id', 'ex_elem_id', 'content'];

    public function givenAnswer()
    {
        return $this->belongsTo(GivenAnswer::class, 'answer_id');
    }

    public function exerciseElement()
    {
        return $this->belongsTo(OpenExElement::class, 'ex_elem_id');
    }
}