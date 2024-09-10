<?php

namespace App\Http\Controllers;

use App\Models\ClosedAnsElement;
use App\Models\closedExElement;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Exercise;
use App\Models\FillAnsElement;
use App\Models\fillExElement;
use App\Models\GivenAnswer;
use App\Models\Mark;
use App\Models\OpenAnsElement;
use App\Models\openExElement;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\TfAnsElement;
use App\Models\tfExElement;
use App\Models\User;
use Illuminate\Http\Request;

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

        // Loop through the selected student
        foreach ($selectedStudentIds as $studentId) {
            $courseStudent = new CourseStudent();
            $courseStudent->course_id = $course->id;
            $courseStudent->student_id = $studentId;
            $courseStudent->save();
        }

        return redirect()->route('student', $course->id);
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
                $query->where('name', 'LIKE', '%'.$search.'%')->orWhere('email', 'LIKE', '%'.$search.'%');
            })->paginate(3);

            if (count($students) > 0) {
                $output = view('auth.partials.student_table', compact('students'));
            }

            return $output;
        }

        return view('student', compact('course', 'students'));
    }

    public function details(Course $course, Student $student)
    {
        $quizzes = $course->quizzes()->where('repeatable', false)->get();

        $marks = Mark::where('student_id', $student->id)
            ->whereIn('quiz_id', $quizzes->pluck('id'))
            ->get();

        $averageGrade = $marks->avg('mark');

        return view('student.details', compact('course', 'student', 'quizzes', 'marks', 'averageGrade'));
    }

    public function changeVote(Course $course, Student $student, Quiz $quiz)
    {
        $exercises = $quiz->exercises()->get();

        $fillAnswer = null;
        $tfAnswer = null;
        $openAnswer = null;
        $closeAnswer = null;

        $mark = Mark::where('student_id', $student->id)
            ->where('quiz_id', $quiz->id)
            ->first();

        foreach ($exercises as $exercise) {

            $matchAnswer = [
                'student_id' => $student->id,
                'quiz_id' => $quiz->id,
                'exercise_id' => $exercise->id,
            ];

            switch ($exercise->type) {
                case 'true/false':
                    $tfAnswer = $this->retrieveTfAnswer($matchAnswer);
                    break;
                case 'open':
                    $openAnswer = $this->retrieveOpenAnswer($matchAnswer);
                    break;
                case 'close':
                    $closeAnswer = $this->retrieClosedAnswer($matchAnswer);
                    break;
                case 'fill-in':
                    $fillAnswer = $this->retrieveFillAnswer($matchAnswer);
                    break;
            }
        }

        return view('student.change-vote', compact('exercises', 'student', 'quiz', 'fillAnswer', 'tfAnswer', 'openAnswer', 'closeAnswer', 'mark', 'course'));
    }

    private function retrieveFillAnswer($matchAnswer)
    {
        $answer = GivenAnswer::where($matchAnswer)->value('id');
        return FillAnsElement::where('answer_id', $answer)->get();
    }

    private function retrieveTfAnswer($matchAnswer)
    {
        $answer = GivenAnswer::where($matchAnswer)->value('id');
        return TfAnsElement::where('answer_id', $answer)->get();
    }

    private function retrieveOpenAnswer($matchAnswer)
    {
        $answer = GivenAnswer::where($matchAnswer)->value('id');
        return OpenAnsElement::where('answer_id', $answer)->get();
    }

    private function retrieClosedAnswer($matchAnswer)
    {
        $answer = GivenAnswer::where($matchAnswer)->value('id');
        return ClosedAnsElement::where('answer_id', $answer)->get();
    }

    public function updateVote(Request $request, Course $course, Student $student, Quiz $quiz)
    {
        $validatedData = $request->validate([
            'mark' => 'required|numeric|min:0|max:' . $quiz->exercises->sum('points'),
        ]);

        $mark = Mark::where('student_id', $student->id)
            ->where('quiz_id', $quiz->id)
            ->firstOrFail();


        $mark->mark = $validatedData['mark'];
        $mark->save();

        return redirect()->back()->with('success', 'Voto aggiornato con successo.');
    }


    public function delete(Course $course, Student $student)
    {
        $course->students()->detach($student->id);
        return redirect()->back()->with('success', 'Student removed from course successfully.');
    }
}
