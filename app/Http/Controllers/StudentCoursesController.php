<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Http\Request;

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
}
