<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $course = new Course();
        $course->teacher_id = $request->user()->id;
        $course->course_name = $request->name;
        $course->course_description = $request->description;
        $course->save();

        return redirect()->route('courses.show');
    }

    public function show(Request $request)
    {
        $teacher_id = $request->user()->id;

        $courses = Course::where('teacher_id', $teacher_id)->get();

        return view('my-courses', compact('courses'));
    }

    public function edit(Course $course)
    {
        return view('edit', compact('course'));
    }

    public function update(Course $course, Request $request)
    {
        $request->validate([
            'course_name' => 'min:2|max:5',
            'course_description' => 'max:255',
        ]);

        $course->course_name = $request->get('course_name');
        $course->course_description = $request->get('course_description');
        $course->save();

        return redirect()->route('courses.update', $course->id)->with('success', "Course updated successfuly!");
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.show')->with('success', 'Course deleted successfully!');
    }
}
