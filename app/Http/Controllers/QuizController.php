<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(): View
    {
        return view('teacher.quiz-teacher');
    }

    public function make(): View
    {
        return view('teacher.make-quiz');
    }
}
