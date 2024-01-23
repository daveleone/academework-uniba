<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request, Course $course){
        $request->validate([
            'selected_students' => 'array|required',
            'selected_students.*' => 'exists:students,id',
        ]);

        // Get the array of selected student IDs
        $selectedStudentIds = $request->input('selected_students');

        // Loop through the selected students
        foreach ($selectedStudentIds as $studentId) {
            $courseStudent = new CourseStudent();
            $courseStudent->course_id = $course->id;
            $courseStudent->student_id = $studentId;
            $courseStudent->save();
        }

        return redirect()->route('students', $course->id);
    }

    public function show(Course $course){
        $students = Student::whereDoesntHave('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->get();

        return view('students', compact('course', 'students'));
    }

}
