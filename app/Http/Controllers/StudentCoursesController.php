<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\course_quiz;
use App\Models\CourseStudent;
use App\Models\Quiz;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentCoursesController extends Controller
{
    public function show(Request $request)
    {
        $user_id = $request->user()->id;
        $student_id = Student::where('user_id', $user_id)->value('id');
        $courses_id = CourseStudent::where('student_id', $student_id)->pluck('course_id');
        $courses = Course::whereIn('id', $courses_id)->get();

        return view('student.courses', compact('courses'));
    }

    public function retrieve_quiz(Request $request, Course $course)
    {
        $course_id = $course->value('id');
        $user_id = Auth::id();
        $student_id = Student::where('user_id', $user_id)->value('id');

        $isEnrolled = CourseStudent::where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('student.show')->with('error', 'You are not enrolled in this course.');
        }

        $courseQuizzes = course_quiz::where('course_id', $course_id)->get();

        // FIXARE PROBABILMENTE SI PUO FARE MEGLIO
//        $quizzes = [];
//        foreach ($courseQuizzes as $courseQuiz) {
//            $quiz = Quiz::find($courseQuiz->quiz_id);
//            if ($quiz) {
//                $quizzes[] = [
//                    'quiz' => $quiz,
//                    'start_time' => $courseQuiz->start_time ? Carbon::parse($courseQuiz->start_time) : null,
//                    'duration_minutes' => $courseQuiz->duration_minutes,
//                    'repeatable' => $courseQuiz->repeatable
//                ];
//            }
//        }

        // da rivedere la tabella course_quiz, spostare start_time, duration_time, repeatable direttamente nella tabella quizzes
        $quizzes = Quiz::whereIn('id', function($query) use ($course_id) {
            $query->select('quiz_id')
                ->from('course_quiz')
                ->where('course_id', $course_id);
        })->get();

        return view('student.exercises', compact('course', 'quizzes'));
    }
}
