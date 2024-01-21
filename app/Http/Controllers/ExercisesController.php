<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use Illuminate\View\View;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Exercise;
use App\Models\tfExElement;
use App\Models\closedExElement;
use App\Models\openExElement;


class ExercisesController extends Controller
{
    public function show($id): View{
        $topic = Topic::find($id);
        $exercises = Exercise::where('topicId', $topic->id)->get();
        return view('exercises.exercises', ['topic' => $topic, 'exercises' => $exercises]);
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
        Session::put('exerciseInit', json_encode($exercise));
        $exType = Request()->get('ExType');

        //Sostituire con switch
        if($exType == 'true/false'){
            return view('exercises.createTfEx', ['topic' => $topic, 'exercises' => $exercises]);
        } elseif ($exType == 'open'){
            return view('exercises.createOpenEx', ['topic' => $topic, 'exercises' => $exercises]);
        }elseif ($exType == 'close'){
            return view('exercises.createClosedEx', ['topic' => $topic, 'exercises' => $exercises]);
        }elseif ($exType == 'fill-in'){
            return view('exercises.createFillEx', ['topic' => $topic, 'exercises' => $exercises]);
        }
        return view('exercises.exercises', ['topic' => $topic, 'exercises' => $exercises]);
    }

    public function createTf($id) : View {
        $topic = Topic::find($id);    //ottimizzare?

        //chiudere in una funzione?
        $exercise = json_decode(Session::get('exerciseInit'));
        Session::forget('exerciseInit');

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

    public function createClosed($id) : View {
        $topic = Topic::find($id);    //ottimizzare?

        //chiudere in una funzione?
        $exercise = json_decode(Session::get('exerciseInit'));
        Session::forget('exerciseInit');

        $exercise = Exercise::create([
            'name' => $exercise->name,
            'description' => $exercise->description,
            'type' => $exercise->type,
            'points' => $exercise->points,
            'topicId' => $topic->id
        ]);
        $nAnswers = intval(Request()->get('answerNum'));
        for($i = 0; $i < $nAnswers; $i++){
            closedExElement::create([
                'position' => $i,
                'exerciseId' => $exercise->id,
                'content' => Request()->get('answer'.$i),
                'truth' => Request()->get('isTrue'.$i, false) == "1" ? true : false
            ]);
        }
        return $this->show($id);
    }

    public function createOpen($id) : View {
        $topic = Topic::find($id);    //ottimizzare?

        //chiudere in una funzione?
        $exercise = json_decode(Session::get('exerciseInit'));
        Session::forget('exerciseInit');

        $exercise = Exercise::create([
            'name' => $exercise->name,
            'description' => $exercise->description,
            'type' => $exercise->type,
            'points' => $exercise->points,
            'topicId' => $topic->id
        ]);

        openExElement::create([
            'exerciseId' => $exercise->id,
            'answer' => Request()->get('exAnswer'),
        ]);
        return $this->show($id);
    }
}
