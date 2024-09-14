<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Quiz;
use App\Models\exercise_quiz;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\course_quiz;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class QuizzesController extends Controller
{
    public function index(): View
    {
        $quizzes = Quiz::where('creator_id', Auth::user()->id)->get();
        return view('quizzes.quizzes', ['quizzes' => $quizzes]);
    }

    public function create(): RedirectResponse
    {
        try {

             $data = request()->validate([
                'QuizName' => 'required',
                'QuizDescription' => 'required',
            ]);

            Quiz::create([
                'name' => $data['QuizName'],
                'description' => $data['QuizDescription'],
                'creator_id' => Auth::user()->id
            ]);
            session()->flash('success', Request()->input('QuizName') . ' created');
        } catch(\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return to_route('quiz.index');
    }

    public function delete(): RedirectResponse
    {
        try {
            Quiz::destroy(Request()->input('quizId'));
            session()->flash('success', 'Quiz deleted');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return to_route('quiz.index');
    }

    public function edit() : RedirectResponse
    {
        $quiz = Quiz::find(Request()->input('quizId'));
        if (!$quiz) {
            session()->flash('error', 'quiz not found');
            return to_route('quiz.index');
        }

        try{
            $newName = Request()->input('quizName' . $quiz->id);
            $newDesc = Request()->input('quizDesc' . $quiz->id);

            if ($newName and $newName != '') {
                $quiz->update(['name' => $newName]);
            }

            if ($newDesc and $newDesc != '') {
                $quiz->update(['description' => $newDesc]);
            }
            session()->flash('success', 'quiz updated');

        } catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return to_route('quiz.index');
    }


    public function addExercise() : RedirectResponse
    {
        $data = Request()->all();
        $quizzesId = [];
        foreach($data as $key => $val){
            if(strpos($key, "checkbox-quiz-") === 0 and is_numeric($val))
                array_push($quizzesId, $val);
        }

        $exId = $data['exId'];

        if($quizzesId and is_numeric($exId)){
            try {
                foreach($quizzesId as $quizId){
                    exercise_quiz::create([
                       'quiz_id' => $quizId,
                       'exercise_id' => $exId
                    ]);
                }
                session()->flash('success', 'Exercise added to quiz');
            } catch(\Exception $e){
                session()->flash('error', $e->getMessage());
            }
        } else {
            session()->flash('error', 'Addition to quiz failed');
        }
        return to_route('quiz.index');
    }

    public function removeEx($id) : RedirectResponse
    {
        try {
            exercise_quiz::where('quiz_id', $id)
                ->where('exercise_id', Request()->input('exId'))
                ->delete();
            session()->flash('success', 'Exercise removed');
        } catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return to_route('quiz.show', ['id' => $id]);
    }

    public function show($id) : View
    {
        $quiz = Quiz::find($id);
        $courses = Course::whereNotIn('id', function($query) use ($id) {
            $query->select('course_id')
                  ->from('course_quiz')
                  ->where('quiz_id', $id);
        })
            ->where('teacher_id', Auth::user()->id)
            ->get();
        return view('quizzes.show', ['quiz' => $quiz, 'courses' => $courses]);
    }


    public function addToCourse() : RedirectResponse
    {
        $data = Request()->all();
        $coursesId = [];
        foreach($data as $key => $val){
            if(strpos($key, "checkbox-course-") === 0 and is_numeric($val))
                array_push($coursesId, $val);
        }

        $quizId = $data['quizId'];

        if(!$quizId or !is_numeric($quizId))
            return to_route('quiz.index');

        $time = $data["time"];
        $date = $data["date"];
        $offset = $data["offset"];
        $repeatable = array_key_exists("repeatable", $data) ? true : false;
        $datetimeString = null;
        $datetime = null;

        if($time and $date and $offset) //TODO controllare offset
        {
            // Creazione della stringa di data e ora
            $datetimeString = $date . ' ' . $time;

            // Calcolo dell'offset
            $hours = intdiv($offset, 60);
            $minutes = abs($offset % 60);
            $offsetString = sprintf('%+03d:%02d', $hours, $minutes);

            // Creazione dell'oggetto Carbon
            $datetime = Carbon::createFromFormat('m/d/Y H:i P', $datetimeString . ' ' . $offsetString);
        }

        if($coursesId){
            try {
                foreach($coursesId as $courseId){
                    course_quiz::create([
                        'quiz_id' => $quizId,
                        'course_id' => $courseId,
                        'repeatable' => $repeatable,
                        'duration_minutes' => $data['time_limit'],
                        'start_time' => $datetime
                    ]);
                }
                session()->flash('success', 'Exercise added to quiz');
            } catch(\Exception $e){
                session()->flash('error', $e->getMessage());
            }
        } else {
            session()->flash('error', 'Addition to quiz failed');
        }

        return to_route('quiz.show', ['id' => $quizId]);
    }


    public function downloadPdf($id)
    {
    $quiz = Quiz::with(['exercises'])->findOrFail($id);
    $pdf = PDF::loadView('quizzes.pdf', compact('quiz'));
    return $pdf->download($quiz->name . '.pdf');
    }

}

