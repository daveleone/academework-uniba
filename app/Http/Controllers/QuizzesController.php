<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Quiz;
use App\Models\exercise_quiz;
use Illuminate\Support\Facades\Auth;

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
}
