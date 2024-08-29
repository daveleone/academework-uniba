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

class QuizzesController extends Controller
{
    public function index(): View
    {
        $quizzes = Quiz::where('creator_id', Auth::user()->id)->get();
        return view('quizzes.quizzes', ['quizzes' => $quizzes]);
    }

    public function create(): View
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
        return $this->index();
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

    public function show($id) : View
    {
        $quiz = Quiz::find($id);
        $courses = Course::where('teacher_id', Auth::user()->id)->get(); //TODO: escludere i corsi a cui il quiz è già assegnato
        return view('quizzes.show', ['quiz' => $quiz, 'courses' => $courses]);
    }


    public function addToCourse() : View
    {
        $data = Request()->all();
        $coursesId = [];
        foreach($data as $key => $val){
            if(strpos($key, "checkbox-course-") === 0 and is_numeric($val))
                array_push($coursesId, $val);
        }

        // Per debug
        // echo "<h1>";
        // echo $data['time'];
        // echo "<br>";
        // echo $data['date'];
        // echo "<br>";
        // echo $data['offset'];
        // echo "<br>";
        // echo "</h1>";
        
        $quizId = $data['quizId'];

        $time = $data["time"];
        $date = $data["date"];
        $offset = $data["offset"];

        $repeatable = false;
        if(array_key_exists("repeatable", $data))
            $repeatable = true;
        
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
        
        if($coursesId and is_numeric($quizId)){
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
        return $this->show($quizId);
    }
}
