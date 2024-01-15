<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use Illuminate\View\View;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Exercise;
use App\Models\tfExElement;

class ExercisesController extends Controller
{
    public function show($id): View{
        $topic = Topic::find($id);
        $exercises = Exercise::where('topicId', $topic->id)->get();
        return view('exercises', ['topic' => $topic, 'exercises' => $exercises]);
    }

    public function create($id) : View{
        $topic = Topic::find($id);
        $exercises = Exercise::where('topicId', $topic->id)->get();
        $exercise = [
            'name' => Request()->get('ExName'),
            'description' => Request()->get('ExDescription'),
            'type' => Request()->get('ExType'),
            'points' => Request()->get('ExPoints'),
            'topicId' => $topic->id
        ];
        Session::put('tfExerciseInit', json_encode($exercise));
        $exType = Request()->get('ExType');
        if($exType == 'true/false'){
            return view('createTfEx', ['topic' => $topic, 'exercises' => $exercises]);
        } elseif ($exType == 'open'){
            return view('createOpenEx');
        }elseif ($exType == 'close'){
            return view('createCloseEx');
        }elseif ($exType == 'fill-in'){
            return view('createFillEx');
        }
        return view('exercises', ['topic' => $topic, 'exercises' => $exercises]);
    }

    public function createTf($id) : View {
        $topic = Topic::find($id);                                    //ottimizzare?

        $exercise = json_decode(Session::get('tfExerciseInit'));
        Session::forget('tfExerciseInit');

        $exercise = Exercise::create([
            'name' => $exercise->name,
            'description' => $exercise->description,
            'type' => $exercise->type,
            'points' => $exercise->points,
            'topicId' => $topic->id
        ]);
        $nQuestions = intval(Request()->get('questionNum'));
        for($i = 0; $i < $nQuestions; $i++){
            tfExElement::create([
                'position' => $i,
                'exerciseId' => $exercise->id,
                'content' => Request()->get('question'.$i),
                'truth' => Request()->get('isTrue'.$i, false) == "1" ? true : false
            ]);
        }
        return $this->show($id);
    }
}
