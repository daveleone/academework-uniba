<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\course_quiz;
use App\Models\CourseStudent;
use App\Models\GivenAnswer;
use App\Models\Mark;
use App\Models\Quiz;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        if(auth()->user()->isStudent()){
            $quizzes = $this->studentUpcomingQuizzes();
            $nonRepeatableQuizzes = $this->studentLatestGrades();
            return view('dashboard', compact('quizzes', 'nonRepeatableQuizzes'));
        }
        elseif (auth()->user()->isTeacher()) {
            return view('dashboard');
        }
    }

    private function studentUpcomingQuizzes()
    {
        $user_id = Auth::user()->id;
        $student_id = Student::where('user_id', $user_id)->first()->id;
        $courses_id = CourseStudent::where('student_id', $student_id)->pluck('course_id');

        $quizzes = course_quiz::whereIn('course_id', $courses_id)
            ->whereNotNull('start_time')
            ->where('repeatable', 0)
            ->orderBy('start_time', 'asc')
            ->paginate(2, ['*'], 'upcoming_page');

        return $quizzes;
    }

    private function studentLatestGrades()
    {
        $user_id = Auth::user()->id;
        $student_id = Student::where('user_id', $user_id)->first()->id;
        $courses_id = CourseStudent::where('student_id', $student_id)->pluck('course_id');

        $marks = Mark::whereHas('quiz.course_quiz', function($query) use ($courses_id) {
            $query->whereIn('course_id', $courses_id);
        })
            ->where('student_id', $student_id)
            ->with(['quiz.course_quiz.course'])
            ->orderByDesc('created_at')
            ->orderByDesc('mark')
            ->paginate(2, ['*'], 'marks');

        return $marks;
    }
}
