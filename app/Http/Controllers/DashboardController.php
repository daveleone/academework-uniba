<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\course_quiz;
use App\Models\CourseStudent;
use App\Models\GivenAnswer;
use App\Models\Mark;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        if(auth()->user()->isStudent()){
            $upcomingQuizzes = $this->studentUpcomingQuizzes();
            $nonRepeatableQuizzes = $this->studentLatestGrades();
            return view('dashboard', compact('upcomingQuizzes', 'nonRepeatableQuizzes'));
        }
        elseif (auth()->user()->isTeacher()) {
            $upcomingQuizzes = $this->teacherUpcomingQuizzes();
            $recentSubmissions = $this->teacherRecentSubmissions();
            return view('dashboard', compact('upcomingQuizzes', 'recentSubmissions'));
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

        foreach ($marks as $mark) {
            $mark->maxPoints = $mark->quiz->calculateMaxPoints();
        }

        return $marks;
    }


    private function teacherUpcomingQuizzes()
    {
        $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first()->id;
        $courses_id = Course::where('teacher_id', $teacher_id)->pluck('id');

        $quizzes = course_quiz::whereIn('course_id', $courses_id)
            ->whereNotNull('start_time')
            ->where('start_time', '>', Carbon::now())
            ->orderBy('start_time', 'asc')
            ->limit(5)
            ->paginate(2, ['*'], 'upcoming_page');

        return $quizzes;
    }

    private function teacherRecentSubmissions()
    {
        $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first()->id;
        $courses_id = Course::where('teacher_id', $teacher_id)->pluck('id');

        $submissions = Mark::whereHas('quiz.course_quiz', function($query) use ($courses_id) {
            $query->whereIn('course_id', $courses_id);
        })
            ->with(['student', 'quiz.course_quiz.course'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->paginate(2, ['*'], 'submissions_page');

        foreach ($submissions as $submission) {
            $submission->maxPoints = $submission->quiz->calculateMaxPoints();
        }

        return $submissions;
    }
}
