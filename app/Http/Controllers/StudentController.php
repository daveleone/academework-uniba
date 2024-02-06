<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function store(Request $request, Course $course)
    {
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

    public function show(Course $course)
    {
        $students = Student::whereDoesntHave('courses', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })->paginate(3);

        return view('students', compact('course', 'students'));
    }

    public function search(Request $request, Course $course)
    {
        $search = $request->get('query');

        if ($request->ajax()) {
            $students = Student::whereNotIn('id', function ($query) use ($course) {
                $query->select('student_id')->from('course_student')->where('course_id', $course->id);
            })->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%');
            })->get();

            $output = '';

            if (count($students) > 0) {
                if (count($students) > 0) {
                    $output = '<ul class="list-group">';
                    foreach ($students as $row) {
                        $output .= '<li class="list-group-item">' . $row->user->name . '</li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">' . 'No results' . '</li>';
                }
                return $output;
            }
        }

        return view('students', compact('course', 'students'));
    }
}
