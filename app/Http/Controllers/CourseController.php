<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(): View
    {
        return view('courses');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first()->id;

        $course = new Course();
        $course->teacher_id = $teacher_id;
        $course->course_name = $request->name;
        $course->course_description = $request->description;
        $course->save();

        return redirect()->route('courses.show');
    }

    public function show(Request $request)
    {
        $user_id = $request->user()->id;
        $teacher_id = Teacher::where('user_id', $user_id)->first()->id;

        $courses = Course::where('teacher_id', $teacher_id)
            ->withCount('students')
            ->paginate(9);

        return view('my-courses', compact('courses'));
    }

    public function edit(Course $course)
    {
        return view('edit', compact('course'));
    }

    public function update(Course $course, Request $request)
    {
        $request->validate([
            'course_name' => 'min:2|max:7',
            'course_description' => 'max:255',
        ]);

        $course->course_name = $request->get('course_name');
        $course->course_description = $request->get('course_description');
        $course->save();

        return redirect()->route('courses.update', $course->id)->with('success', "Course updated successfuly!");
    }

    public function showQuizzes(Course $course)
    {
        $quizzes = $course->quizzes()->orderBy('created_at', 'desc')->paginate(5);

        return view('teacher.quizzes', compact('course', 'quizzes'));
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.show')->with('success', 'Course deleted successfully!');
    }
}
