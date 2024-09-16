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
use App\Models\Exercise;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Teacher;

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
            // Quiz::destroy(Request()->input('quizId'));

            Quiz::where('creator_id', Auth::user()->id)
                ->where('id', Request()
                ->input('quizId'))
                ->first()
                ->delete();
            
            session()->flash('success', 'Quiz deleted');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return to_route('quiz.index');
    }

    public function edit() : RedirectResponse
    {
        $quiz = Quiz::where('creator_id', Auth::user()->id)
            ->where('id', Request()
            ->input('quizId'))
            ->first();
        
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

        $exId = array_key_exists("exId", $data) ? intval($data["exId"]) : null;

        $exercise = Exercise::with(['topic.subject'])
            ->where('id', $exId)
            ->whereHas('topic.subject', function ($query) {
                $query->where('teacher_id', Auth::user()->id);
            })
            ->first();

        if($quizzesId and $exercise){
            try {
                foreach($quizzesId as $quizId){
                    
                    $quiz = Quiz::where('creator_id', Auth::user()->id)
                        ->where('id', $quizId)
                        ->first();                    

                    if($quiz){
                        exercise_quiz::create([
                           'quiz_id' => $quizId,
                           'exercise_id' => $exId
                        ]);
                    } 
                }
                session()->flash('success', 'Exercise added to quiz');
            } catch(\Exception $e){
                session()->flash('error', $e->getMessage());
            }
        } else {
            session()->flash('error', 'Addition to quiz failed');
        }
        return to_route('exercise.show', ['id' => $exId]);
    }

    public function removeEx($id) : RedirectResponse
    {
        try {
            $quiz = Quiz::where('creator_id', Auth::user()->id)
                ->where('id', $id)
                ->first();                    

            if($quiz){
                exercise_quiz::where('quiz_id', $id)
                    ->where('exercise_id', Request()->input('exId'))
                    ->delete();
                session()->flash('success', 'Exercise removed');
            }
        } catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return to_route('quiz.show', ['id' => $id]);
    }

    public function show($id) : View
    {
        $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first()->id;
        $quiz = Quiz::where('creator_id', Auth::user()->id)
            ->where('id', $id)
            ->first();                    

        $courses = Course::whereNotIn('id', function($query) use ($id) {
            $query->select('course_id')
                  ->from('course_quiz')
                  ->where('quiz_id', $id);
        })
            ->where('teacher_id', $teacher_id)
            ->get();

        return view('quizzes.show', ['quiz' => $quiz, 'courses' => $courses]);
    }


    public function addToCourse() : RedirectResponse
    {
        $data = Request()->all();
        $user_id = Auth::user()->id;
        $coursesId = [];
        foreach($data as $key => $val){
            if(strpos($key, "checkbox-course-") === 0 and is_numeric($val))
                array_push($coursesId, $val);
        }
        
        $quizId = array_key_exists("quizId", $data) ? $data["quizId"] : null;

        $quiz = Quiz::where('creator_id', $user_id)
            ->where('id', $quizId)
            ->first();                    

        if(!$quiz)
            return to_route('quiz.index');

        $time = array_key_exists("time", $data) ? $data["time"] : null;
        $date = array_key_exists("date", $data) ? $data["date"] : null;
        $offset = array_key_exists("offset", $data) ? $data["offset"] : null;

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
                $teacher_id = Teacher::where('user_id', $user_id)->first()->id;
                $userCourses = Course::where('teacher_id', $teacher_id)->pluck('id')->toArray();
                foreach($coursesId as $courseId){
                    if(in_array($courseId, $userCourses)){
                        course_quiz::create([
                            'quiz_id' => $quizId,
                            'course_id' => $courseId,
                            'repeatable' => $repeatable,
                            'duration_minutes' => $data['time_limit'],
                            'start_time' => $datetime
                        ]);
                    }
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


    public function removeFromCourse(Course $course, Quiz $quiz)
    {
        $courseTeacher = $course->teacher;
        if($courseTeacher->user_id == Auth::user()->id)
            $course->quizzes()->detach($quiz->id);
        else
            return redirect()->back()->with('error', 'Teacher permission required.');
        return redirect()->back()->with('success', 'Quiz successfully removed.');
    }

    public function downloadPdf($id)
    {
        $quiz = Quiz::with(['exercises'])->where('creator_id', Auth::user()->id)->findOrFail($id);
        $pdf = PDF::loadView('quizzes.pdf', compact('quiz'));
        return $pdf->download($quiz->name . '.pdf');
    }

}

