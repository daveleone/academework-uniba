<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use Illuminate\View\View;
use App\Models\Topic;
use App\Models\Exercise;
use App\Models\tfExElement;
use App\Models\closedExElement;
use App\Models\openExElement;
use App\Models\fillExElement;
use Illuminate\Http\RedirectResponse;

class ExercisesController extends Controller
{
    public function show($id): View | RedirectResponse{
        $topic = Topic::find($id);
        if(!$topic){
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }
        $exercises = Exercise::where('topic_id', $topic->id)->get();
        return view('exercises.exercises',
        ['topic' => $topic, 'exercises' => $exercises]);
    }

    private function createExInit($topic) : Exercise{
        $exercise = json_decode(Session::get('exerciseInit'));
        Session::forget('exerciseInit');
        $exercise = Exercise::create([
            'name' => $exercise->name,
            'description' => $exercise->description,
            'type' => $exercise->type,
            'points' => $exercise->points,
            'topic_id' => $topic->id
        ]);
        return $exercise;
    }

    public function create($id) : View /* | RedirectResponse  boh */ {
        $topic = Topic::find($id);
        $exercises = Exercise::where('topic_id', $topic->id)->get();
        $exercise = [
            'name' => Request()->input('ExName'),
            'description' => Request()->input('ExDescription'),
            'type' => Request()->input('ExType'),
            'points' => Request()->input('ExPoints'),
            'topic_id' => $topic->id
        ];
        Session::put('exerciseInit', json_encode($exercise));
        $exType = Request()->input('ExType');
        switch($exType){
            case 'true/false':
                return view('exercises.createTfEx',
                ['topic' => $topic, 'exercises' => $exercises]);
                break;
            case 'open':
                return view('exercises.createOpenEx',
                ['topic' => $topic, 'exercises' => $exercises]);
                break;
            case 'close':
                return view('exercises.createClosedEx',
                ['topic' => $topic, 'exercises' => $exercises]);
                break;
            case 'fill-in':
                return view('exercises.createFillEx',
                ['topic' => $topic, 'exercises' => $exercises]);
                break;
            //default:
            //    return route('exercises.exercises',
            //    ['topic' => $topic, 'exercises' => $exercises]);
            //    break;
            }
    }

    public function createTf($id) : RedirectResponse {
        $topic = Topic::find($id);
        $exercise = $this->createExInit($topic);
        $nQuestions = intval(Request()->input('questionNum'));
        for($i = 0; $i < $nQuestions; $i++){
            tfExElement::create([
                'position' => $i,
                'exercise_id' => $exercise->id,
                'content' => Request()->input('question'.$i),
                'truth' => Request()->input('isTrue'.$i, false) == "1" ? true : false
            ]);
        }
        return to_route('topic.exercises', ['id' => $id]);
    }

    public function createClosed($id) : RedirectResponse {
        $topic = Topic::find($id);
        $exercise = $this->createExInit($topic);
        $nAnswers = intval(Request()->input('answerNum'));
        for($i = 0; $i < $nAnswers; $i++){
            closedExElement::create([
                'position' => $i,
                'exercise_id' => $exercise->id,
                'content' => Request()->input('answer'.$i),
                'truth' => Request()->input('isTrue', false) == $i ? true : false
            ]);
        }
        return to_route('topic.exercises', ['id' => $id]);
    }

    public function createOpen($id) : RedirectResponse {
        $topic = Topic::find($id);
        $exercise = $this->createExInit($topic);
        openExElement::create([
            'exercise_id' => $exercise->id,
            'answer' => Request()->input('exAnswer'),
        ]);
        return to_route('topic.exercises', ['id' => $id]);
    }

    public function createFill($id) : RedirectResponse {
        $topic = Topic::find($id);
        $exercise = $this->createExInit($topic);
        $nElements = intval(Request()->input('elemNum'));
        for($i = 0; $i < $nElements; $i++){
            fillExElement::create([
                'position' => $i,
                'exercise_id' => $exercise->id,
                'content' => Request()->input('element'.$i),
                'type' => Request()->input('elemType'.$i)
            ]);
        }
        return to_route('topic.exercises', ['id' => $id]);
    }

    public function showExercise($id) : View{
        $exercise = Exercise::find($id);
        switch($exercise->type){
            case 'true/false':
                return view('exercises.showTfEx', ['exercise' => $exercise]);
                break;
            case 'open':
                return view('exercises.showOpenEx', ['exercise' => $exercise]);
                break;
            case 'close':
                return view('exercises.showClosedEx', ['exercise' => $exercise]);
                break;
            case 'fill-in':
                return view('exercises.showFillEx', ['exercise' => $exercise]);
                break;
        }
    }

    public function delete($id) : RedirectResponse{
        $exercise = Exercise::find($id);
        $topicId = $exercise->topic->id;
        $exercise->delete();
        return to_route('topic.exercises', ['id' => $topicId]);
    }

    public function edit($id)  : RedirectResponse{
        $exercise = Exercise::find(Request()->input('exId'));
        $newName = Request()->input('exName');
        $newDesc = Request()->input('exDescription');
        $newPoints = Request()->input('exPoints');
        if ($newName and $newName != ''){
            $exercise->update(['name' => $newName]);
        }

        if ($newDesc and $newDesc != ''){
            $exercise->update(['description' => $newDesc]);
        }

        if ($newPoints and $newPoints != $exercise->points){
            $exercise->update(['points' => $newPoints]);
        }
        //ottimizzare?
        switch($exercise->type){
            case 'open':
                foreach ($exercise->elements as $element){
                    $newAnsw = Request()->input('exAnswer');
                    if ($newAnsw and $newAnsw != ''){
                        $element->update(['answer' => $newAnsw]);
                    }
                }
                break;
            case 'close':
                $nAns = Request()->input('answerNum');
                $nElem = $exercise->elements->count();
                if($nElem > $nAns){
                    $exercise->elements()->where('position', '>=', $nAns)->delete();
                    $nElem = $nAns;
                }elseif($nElem < $nAns){
                    for($i = $nElem; $i < $nAns; $i++){
                        $exercise->elements()->create([
                            'position' => $i,
                            'content' => Request()->input('exAnswer' . $i),
                            'truth' => Request()->input('isTrue', false) == $i ? true : false
                        ]);
                    }
                }
                foreach($exercise->elements()->where('position', '<', $nElem)->orderBy('position')->get() as $i => $element){
                    $element->update([
                        'position' => $i,
                        'content' => Request()->input('exAnswer' . $i),
                        'truth' => Request()->input('isTrue', false) == $i ? true : false
                    ]);
                }
                break;
                case 'true/false':
                    $nAns = Request()->input('questionNum');
                    $nElem = $exercise->elements->count();
                    if($nElem > $nAns){
                        $exercise->elements()->where('position', '>=', $nAns)->delete();
                        $nElem = $nAns;
                    }elseif($nElem < $nAns){
                        for($i = $nElem; $i < $nAns; $i++){
                            $exercise->elements()->create([
                                'position' => $i,
                                'content' => Request()->input('question' . $i),
                                'truth' => Request()->input('isTrue'.$i, false) == 1 ? true : false
                            ]);
                        }
                    }
                    foreach($exercise->elements()->where('position', '<', $nElem)->orderBy('position')->get() as $i => $element){
                        $element->update([
                            'position' => $i,
                            'content' => Request()->input('question' . $i),
                            'truth' => Request()->input('isTrue'.$i, false) == 1 ? true : false
                        ]);
                    }
                    break;
                    case 'fill-in':
                        $nAns = Request()->input('elemNum');
                        $nElem = $exercise->elements->count();
                        if($nElem > $nAns){
                            $exercise->elements()->where('position', '>=', $nAns)->delete();
                            $nElem = $nAns;
                        }elseif($nElem < $nAns){
                            for($i = $nElem; $i < $nAns; $i++){
                                $exercise->elements()->create([
                                    'position' => $i,
                                    'content' => Request()->input('element' . $i),
                                    'type' => Request()->input('elemType'.$i)
                                ]);
                            }
                        }
                        foreach($exercise->elements()->where('position', '<', $nElem)->orderBy('position')->get() as $i => $element){
                            $element->update([
                                'position' => $i,
                                'content' => Request()->input('element' . $i),
                                'type' => Request()->input('elemType'.$i)
                            ]);
                        }
                        break;

        }

        return to_route('exercise.show', ['id' => $id]);
    }
}
