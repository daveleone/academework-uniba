<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Topic;
use App\Models\Exercise;
use App\Models\tfExElement;
use App\Models\closedExElement;
use App\Models\openExElement;
use App\Models\fillExElement;
use App\Models\Quiz;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ExercisesController extends Controller
{
    public function show($id): View | RedirectResponse
    {
        $topic = Topic::join('subjects', 'subjects.id', '=', 'topics.subject_id')
            ->where('topics.id', $id)
            ->where('subjects.teacher_id', Auth::user()->id)
            ->first();
        if (!$topic) {
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }
        $exercises = Exercise::where('topic_id', $topic->id)->get();
        return view(
            'exercises.exercises',
            ['topic' => $topic, 'exercises' => $exercises]
        );
    }

    private function createExInit($topic): Exercise | RedirectResponse
    {
        try {
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
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return to_route('topic.exercises', ['id' => $topic->id]);
        }
    }

    public function create($id): View | RedirectResponse
    {

        $topic = Topic::join('subjects', 'subjects.id', '=', 'topics.subject_id')
            ->where('topics.id', $id)
            ->where('subjects.teacher_id', Auth::user()->id)
            ->first();

        if (!$topic) {
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }

        $data = request()->validate([
            'ExName' => 'required',
            'ExDescription' => 'required',
            'ExType' => 'required',
            'ExPoints' => 'required|integer',
        ]);

        $exercise = [
            'name' => $data['ExName'],
            'description' => $data['ExDescription'],
            'type' => $data['ExType'],
            'points' => $data['ExPoints'],
            'topic_id' => $topic->id
        ];

        Session::put('exerciseInit', json_encode($exercise));
        switch ($data['ExType']) {
            case 'true/false':
                return view(
                    'exercises.createTfEx',
                    ['topic' => $topic]
                );
                break;
            case 'open':
                return view(
                    'exercises.createOpenEx',
                    ['topic' => $topic]
                );
                break;
            case 'close':
                return view(
                    'exercises.createClosedEx',
                    ['topic' => $topic]
                );
                break;
            case 'fill-in':
                return view(
                    'exercises.createFillEx',
                    ['topic' => $topic]
                );
                break;
            default:
                session()->flash('error', 'Invalid type');
                return to_route(
                    'topic.exercises',
                    ['id' => $id]
                );
                break;
        }
    }

    public function createTf($id): RedirectResponse
    {
        $topic = Topic::join('subjects', 'subjects.id', '=', 'topics.subject_id')
            ->where('topics.id', $id)
            ->where('subjects.teacher_id', Auth::user()->id)
            ->first();

        if (!$topic) {
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }

        $exercise = $this->createExInit($topic);

        if (!$exercise) {
            session()->flash('error', 'Exercise initialization failed');
            return to_route('topic.exercises', ['id' => $id]);
        }

        $nQuestions = intval(Request()->input('questionNum'));

        try {
            for ($i = 0; $i < $nQuestions; $i++) {
                tfExElement::create([
                    'position' => $i,
                    'exercise_id' => $exercise->id,
                    'content' => Request()->input('question' . $i),
                    'truth' => Request()->input('isTrue' . $i, false) == "1" ? true : false
                ]);
            }
            session()->flash('success', $exercise->name . ' created');
        } catch (\Exception $e) {
            $exercise->delete();
            session()->flash('error', $e->getMessage());
        }
        return to_route('topic.exercises', ['id' => $id]);
    }

    public function createClosed($id): RedirectResponse
    {
        $topic = Topic::join('subjects', 'subjects.id', '=', 'topics.subject_id')
            ->where('topics.id', $id)
            ->where('subjects.teacher_id', Auth::user()->id)
            ->first();

        if (!$topic) {
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }

        $exercise = $this->createExInit($topic);

        if (!$exercise) {
            session()->flash('error', 'Exercise initialization failed');
            return to_route('topic.exercises', ['id' => $id]);
        }

        $nAnswers = intval(Request()->input('answerNum'));

        try {
            for ($i = 0; $i < $nAnswers; $i++) {
                closedExElement::create([
                    'position' => $i,
                    'exercise_id' => $exercise->id,
                    'content' => Request()->input('answer' . $i),
                    'truth' => Request()->input('isTrue', false) == $i ? true : false
                ]);
            }
            session()->flash('success', $exercise->name . ' created');
        } catch (\Exception $e) {
            $exercise->delete();
            session()->flash('error', $e->getMessage());
        }

        return to_route('topic.exercises', ['id' => $id]);
    }

    public function createOpen($id): RedirectResponse
    {
        $topic = Topic::join('subjects', 'subjects.id', '=', 'topics.subject_id')
            ->where('topics.id', $id)
            ->where('subjects.teacher_id', Auth::user()->id)
            ->first();

        if (!$topic) {
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }

        $exercise = $this->createExInit($topic);

        if (!$exercise) {
            session()->flash('error', 'Exercise initialization failed');
            return to_route('topic.exercises', ['id' => $id]);
        }

        try {
            openExElement::create([
                'exercise_id' => $exercise->id,
                'answer' => Request()->input('exAnswer'),
            ]);
            session()->flash('success', $exercise->name . ' created');
        } catch (\Exception $e) {
            $exercise->delete();
            session()->flash('error', $e->getMessage());
        }

        return to_route('topic.exercises', ['id' => $id]);
    }

    public function createFill($id): RedirectResponse
    {
        $topic = Topic::join('subjects', 'subjects.id', '=', 'topics.subject_id')
            ->where('topics.id', $id)
            ->where('subjects.teacher_id', Auth::user()->id)
            ->first();

        if (!$topic) {
            session()->flash('error', 'Topic not found');
            return to_route('subject.show');
        }

        $exercise = $this->createExInit($topic);

        if (!$exercise) {
            session()->flash('error', 'Exercise initialization failed');
            return to_route('topic.exercises', ['id' => $id]);
        }

        $nElements = intval(Request()->input('elemNum'));
        try {
            for ($i = 0; $i < $nElements; $i++) {
                fillExElement::create([
                    'position' => $i,
                    'exercise_id' => $exercise->id,
                    'content' => Request()->input('element' . $i),
                    'type' => Request()->input('elemType' . $i)
                ]);
            }
            session()->flash('success', $exercise->name . ' created');
        } catch (\Exception $e) {
            $exercise->delete();
            session()->flash('error', $e->getMessage());
        }


        return to_route('topic.exercises', ['id' => $id]);
    }

    public function showExercise($id): RedirectResponse | View
    {
        $exercise = Exercise::with(['topic.subject'])
            ->where('id', $id)
            ->whereHas('topic.subject', function ($query) {
                $query->where('teacher_id', Auth::user()->id);
            })
            ->first();

        if (!$exercise) {
            session()->flash('error', 'Exercise not found');
            return to_route('subject.show');
        }

        // $quizzes = Quiz::where('creator_id', Auth::user()->id)->get();


        $quizzes = Quiz::whereNotIn('id', function($query) use ($id){
            $query->select('quiz_id')
                  ->from('exercise_quiz')
                  ->where('exercise_id', $id);
        })
            ->where('creator_id', Auth::user()->id)
            ->get();

        switch ($exercise->type) {
            case 'true/false':
                return view('exercises.showTfEx', ['exercise' => $exercise, 'quizzes' => $quizzes]);
                break;
            case 'open':
                return view('exercises.showOpenEx', ['exercise' => $exercise, 'quizzes' => $quizzes]);
                break;
            case 'close':
                return view('exercises.showClosedEx', ['exercise' => $exercise, 'quizzes' => $quizzes]);
                break;
            case 'fill-in':
                return view('exercises.showFillEx', ['exercise' => $exercise, 'quizzes' => $quizzes]);
                break;
            default:
                session()->flash('error', 'Invalid type');
                return to_route(
                    'topic.exercises',
                    ['id' => $id]
                );
                break;
        }
    }

    public function delete($id): RedirectResponse
    {
        $exercise = Exercise::with(['topic.subject'])
            ->where('id', $id)
            ->whereHas('topic.subject', function ($query) {
                $query->where('teacher_id', Auth::user()->id);
            })
            ->first();

        if (!$exercise) {
            session()->flash('error', 'Exercise not found');
            return to_route('subject.show');
        }
        try {
            $topicId = $exercise->topic->id;
            $exercise->delete();
            session()->flash('success', 'Exercise deleted');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return to_route('subject.show');
        }
        return to_route('topic.exercises', ['id' => $topicId]);
    }


    public function edit($id): RedirectResponse
    {
        $exercise = Exercise::with(['topic.subject'])
            ->where('id', $id)
            ->whereHas('topic.subject', function ($query) {
                $query->where('teacher_id', Auth::user()->id);
            })
            ->first();

        if (!$exercise) {
            session()->flash('error', 'Exercise not found');
            return to_route('subject.show');
        }

        $newName = Request()->input('exName');
        $newDesc = Request()->input('exDescription');
        $newPoints = Request()->input('exPoints');
        if ($newName and $newName != '') {
            $exercise->update(['name' => $newName]);
        }

        if ($newDesc and $newDesc != '') {
            $exercise->update(['description' => $newDesc]);
        }

        if ($newPoints and $newPoints != $exercise->points) {
            $exercise->update(['points' => $newPoints]);
        }

        try {
            switch ($exercise->type) {
                case 'open':
                    foreach ($exercise->elements as $element) {
                        $newAnsw = Request()->input('exAnswer');
                        if ($newAnsw and $newAnsw != '') {
                            $element->update(['answer' => $newAnsw]);
                        }
                    }
                    break;
                case 'close':
                    $nAns = Request()->input('answerNum');
                    $nElem = $exercise->elements->count();
                    if ($nElem > $nAns) {
                        $exercise->elements()->where('position', '>=', $nAns)->delete();
                        $nElem = $nAns;
                    } elseif ($nElem < $nAns) {
                        for ($i = $nElem; $i < $nAns; $i++) {
                            $exercise->elements()->create([
                                'position' => $i,
                                'content' => Request()->input('exAnswer' . $i),
                                'truth' => Request()->input('isTrue', false) == $i ? true : false
                            ]);
                        }
                    }
                    foreach ($exercise->elements()->where('position', '<', $nElem)->orderBy('position')->get() as $i => $element) {
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
                    if ($nElem > $nAns) {
                        $exercise->elements()->where('position', '>=', $nAns)->delete();
                        $nElem = $nAns;
                    } elseif ($nElem < $nAns) {
                        for ($i = $nElem; $i < $nAns; $i++) {
                            $exercise->elements()->create([
                                'position' => $i,
                                'content' => Request()->input('question' . $i),
                                'truth' => Request()->input('isTrue' . $i, false) == 1 ? true : false
                            ]);
                        }
                    }
                    foreach ($exercise->elements()->where('position', '<', $nElem)->orderBy('position')->get() as $i => $element) {
                        $element->update([
                            'position' => $i,
                            'content' => Request()->input('question' . $i),
                            'truth' => Request()->input('isTrue' . $i, false) == 1 ? true : false
                        ]);
                    }
                    break;
                case 'fill-in':
                    $nAns = Request()->input('elemNum');
                    $nElem = $exercise->elements->count();
                    if ($nElem > $nAns) {
                        $exercise->elements()->where('position', '>=', $nAns)->delete();
                        $nElem = $nAns;
                    } elseif ($nElem < $nAns) {
                        for ($i = $nElem; $i < $nAns; $i++) {
                            $exercise->elements()->create([
                                'position' => $i,
                                'content' => Request()->input('element' . $i),
                                'type' => Request()->input('elemType' . $i)
                            ]);
                        }
                    }
                    foreach ($exercise->elements()->where('position', '<', $nElem)->orderBy('position')->get() as $i => $element) {
                        $element->update([
                            'position' => $i,
                            'content' => Request()->input('element' . $i),
                            'type' => Request()->input('elemType' . $i)
                        ]);
                    }
                    break;
            }
            session()->flash('success', 'Exercise updated');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return to_route('exercise.show', ['id' => $id]);
    }
}
