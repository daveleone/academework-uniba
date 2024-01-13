<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Exercise;

class ExercisesController extends Controller
{
    public function show($id): View{
        $topic = Topic::find($id);
        $exercises = Exercise::where('topicId', $topic->id)->get();
        return view('exercises', ['topic' => $topic, 'exercises' => $exercises]);
    }
}
