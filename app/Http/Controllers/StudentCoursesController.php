<?php

namespace App\Http\Controllers;

use App\Models\ClosedAnsElement;
use App\Models\closedExElement;
use App\Models\Course;
use App\Models\course_quiz;
use App\Models\CourseStudent;
use App\Models\Exercise;
use App\Models\exercise_quiz;
use App\Models\FillAnsElement;
use App\Models\fillExElement;
use App\Models\GivenAnswer;
use App\Models\Mark;
use App\Models\OpenAnsElement;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\TfAnsElement;
use App\Models\tfExElement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentCoursesController extends Controller
{
    public function show(Request $request)
    {
        $user_id = $request->user()->id;
        $student_id = Student::where('user_id', $user_id)->value('id');
        $courses_id = CourseStudent::where('student_id', $student_id)->pluck('course_id');
        $courses = Course::whereIn('id', $courses_id)->paginate(9);

        return view('student.courses', compact('courses'));
    }

    public function retrieve_quiz(Request $request, $id)
    {

        $course = Course::find($id);
        $course_id = Course::find($id)->id;
        $user_id = Auth::id();
        $student_id = Student::where('user_id', $user_id)->value('id');
        $exam_taken = [];

        $isEnrolled = CourseStudent::where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->exists();

        $repeatable = $course->quizzes()->pluck('repeatable', 'quiz_id');

        $marks = Mark::where('student_id', $student_id)
            ->whereIn('quiz_id', $course->quizzes->pluck('id'))
            ->pluck('mark', 'quiz_id');
        $quizzes = $course->quizzes()->paginate(6);

        foreach ($quizzes as $quiz)
        {
            $quiz_id = $quiz->id;
            $is_repeatable = $repeatable[$quiz_id] ?? 0;
            $mark_exists = isset($marks[$quiz_id]);
            $exam_taken[$quiz_id] = $mark_exists && !$is_repeatable;
        }

        if (!$isEnrolled) {
            return redirect()->route('student.show')->with('error', 'You are not enrolled in this course.');
        }


        return view('student.exercises', compact('course', 'quizzes', 'exam_taken'));
    }

    public function studentClassDetails(Course $course)
    {
        $user_id = Auth::id();
        $student = Student::where('user_id', $user_id)->firstOrFail();
        $teacher = $course->teacher->user;
        $averageGrade = $student->averageGradeForCourse($course->id);
        $courseId = $course->id;

        $nonRepeatableQuizzes = Mark::whereHas('quiz', function($query) use ($courseId) {
            $query->whereHas('courses', function($subQuery) use ($courseId) {
                $subQuery->where('course_id', $courseId)
                    ->where('course_quiz.repeatable', false);
            });
        })->paginate(3, ['*'], 'nonRepeatableQuizzes');

        $repeatableQuizzes = Mark::whereHas('quiz', function($query) use ($courseId) {
            $query->whereHas('courses', function($subQuery) use ($courseId) {
                $subQuery->where('course_id', $courseId)
                    ->where('course_quiz.repeatable', true);
            });
        })->paginate(3, ['*'], 'repeatableQuizzes');

        return view('student.class_details', compact('course', 'teacher', 'averageGrade', 'nonRepeatableQuizzes', 'repeatableQuizzes'));
    }

    public function exercises($course, $quiz)
    {
        $course = Course::findOrFail($course);
        $quiz = Quiz::findOrFail($quiz);
        $user_id = Auth::id();
        $student_id = Student::where('user_id', $user_id)->value('id');

        // Check if the student is enrolled in the course
        $isEnrolled = CourseStudent::where('student_id', $student_id)
            ->where('course_id', $course->id)
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('student.show')->with('error', 'You are not enrolled in this course.');
        }

        $courseQuiz = $course->quizzes()->where('quiz_id', $quiz->id)->first();

        if (!$courseQuiz) {
            return redirect()->route('student.exercises', ['courses' => $course->id])->with('error', 'This quiz is not associated with the course.');
        }

        $start_time = null;

        // Check if the quiz has started
        $now = Carbon::now();
        if($courseQuiz->pivot->start_time != null){
            $start_time = Carbon::parse($courseQuiz->pivot->start_time);
        }

        if($now->lte($start_time) && $start_time != null)
        {
            return redirect()->route('student.exercises', ['courses' => $course->id])->with('error', 'This quiz has not started yet.');
        }

        // Check if the student has already started the quiz
        $sessionKey = "quiz_start_time_{$quiz->id}_{$student_id}";
        $quizStartTime = Session::get($sessionKey);

        if (!$quizStartTime) {
            // If the quiz hasn't been started, set the start time
            $quizStartTime = $now;
            Session::put($sessionKey, $quizStartTime);
        }

        $remainingTime = null;
        if ($courseQuiz->pivot->duration_minutes) {
            $endTime = Carbon::parse($quizStartTime)->addMinutes($courseQuiz->pivot->duration_minutes);
            $remainingTime = $now->diffInSeconds($endTime, false);

            if ($remainingTime <= 0) {
                return $this->submitExam(new Request(), $course->id, $quiz->id);
            }
        }

        $exercise_id = $quiz->exercises()->pluck('exercise_id');
        $exercises = Exercise::whereIn('id', $exercise_id)->get();

        return view('student.exam', compact('exercises', 'course', 'quiz', 'remainingTime'));
    }


    public function submitExam(Request $request, $course_id, $quiz_id)
    {
        $user_id = Auth::id();
        $student_id = Student::where('user_id', $user_id)->value('id');

        $sessionKey = "quiz_start_time_{$quiz_id}_{$student_id}";
        $quizStartTime = Session::get($sessionKey);
        $courseQuiz = Course::find($course_id)->quizzes()->where('quiz_id', $quiz_id)->first();

        $timeUp = false;
        $submissionTime = Carbon::now();

        if ($quizStartTime && $courseQuiz->pivot->duration_minutes) {
            $quizStartTime = Carbon::parse($quizStartTime);
            $endTime = $quizStartTime->copy()->addMinutes($courseQuiz->pivot->duration_minutes);
            if ($submissionTime->gt($endTime)) {
                $timeUp = true;
            }
        }

        $exercise_ids = exercise_quiz::where('quiz_id', $quiz_id)->pluck('exercise_id');
        $exercises = Exercise::whereIn('id', $exercise_ids)->get();

        $totalScore = 0;

        foreach ($exercises as $exercise) {

            $givenAnswer = GivenAnswer::create([
                'student_id' => $student_id,
                'quiz_id' => $quiz_id,
                'exercise_id' => $exercise->id,
            ]);

            switch ($exercise->type) {
                case 'true/false':
                    $this->saveTfAnswer($request, $givenAnswer, $exercise);
                    break;
                case 'open':
                    $this->saveOpenAnswer($request, $givenAnswer, $exercise);
                    break;
                case 'close':
                    $this->saveClosedAnswer($request, $givenAnswer, $exercise);
                    break;
                case 'fill-in':
                    $this->saveFillAnswer($request, $givenAnswer, $exercise);
                    break;
            }

            if (!$timeUp) {
                $givenAnswer->save();
                $totalScore += $this->calculateScore($givenAnswer, $exercise, $student_id);
            }
        }

        if ($courseQuiz->pivot->repeatable) {
            $mark = Mark::where('student_id', $student_id)
                ->where('quiz_id', $quiz_id)
                ->first();

            if ($mark) {
                $mark->mark = $totalScore;
                $mark->save();
            } else {
                Mark::create([
                    'student_id' => $student_id,
                    'quiz_id' => $quiz_id,
                    'mark' => $totalScore
                ]);
            }
        } else {
            Mark::create([
                'student_id' => $student_id,
                'quiz_id' => $quiz_id,
                'mark' => $totalScore
            ]);
        }

        Session::forget($sessionKey);

        if ($timeUp) {
            return redirect()->route('student.exercises', ['courses' => $course_id])
                ->with('warning', "Time's up. The exam has been submitted!");
        } else {
            return redirect()->route('student.exercises', ['courses' => $course_id])
                ->with('success', 'Exam submitted successfully!');
        }
    }


    private function saveTfAnswer(Request $request, GivenAnswer $givenAnswer, Exercise $exercise)
    {
        foreach ($exercise->elements as $element) {
            TfAnsElement::create([
                'answer_id' => $givenAnswer->id,
                'ex_elem_id' => $element->id,
                'content' => $request->input("tf_{$exercise->id}_{$element->id}") == "1",
            ]);
        }
    }

    private function saveOpenAnswer(Request $request, GivenAnswer $givenAnswer, Exercise $exercise)
    {
        OpenAnsElement::create([
            'answer_id' => $givenAnswer->id,
            'ex_elem_id' => $exercise->elements->first()->id,
            'content' => $request->input("open_{$exercise->id}"),
        ]);
    }

    private function saveClosedAnswer(Request $request, GivenAnswer $givenAnswer, Exercise $exercise)
    {
        $selectedAnswer = $request->input("closed_{$exercise->id}");
        foreach ($exercise->elements as $element) {
            ClosedAnsElement::create([
                'answer_id' => $givenAnswer->id,
                'ex_elem_id' => $element->id,
                'content' => $element->id == $selectedAnswer,
            ]);
        }
    }

    private function saveFillAnswer(Request $request, GivenAnswer $givenAnswer, Exercise $exercise)
    {
        foreach ($exercise->elements as $element) {
            if($element->type == 'input') {
                FillAnsElement::create([
                    'answer_id' => $givenAnswer->id,
                    'ex_elem_id' => $element->id,
                    'content' => $request->input("fill_{$exercise->id}_{$element->id}"),
                ]);
            }
        }
    }

    private function calculateScore(GivenAnswer $givenAnswer, Exercise $exercise, $student_id)
    {
        $score = 0;

        switch ($exercise->type) {
            case 'true/false':
                $score = $this->calculateTfScore($givenAnswer, $exercise, $student_id);
                break;
            case 'open':
                $score = 0;
                break;
            case 'close':
                $score = $this->calculateClosedScore($givenAnswer, $exercise, $student_id);
                break;
            case 'fill-in':
                $score = $this->calculateFillScore($givenAnswer, $exercise, $student_id);
                break;
        }

        return $score;
    }

    private function calculateTfScore(GivenAnswer $givenAnswer, Exercise $exercise, $student_id)
    {
        $points = Exercise::where('id', $exercise->id)->value('points');
        $truthElements = TfExElement::where('exercise_id', $exercise->id)->get();
        $tfAnswers = TfAnsElement::where('answer_id', $givenAnswer->id)->get();
        $score = $points / $truthElements->count();
        $answerCount = 0;

        foreach ($truthElements as $element) {

            $answer = $tfAnswers->firstWhere('ex_elem_id', $element->id);

            if ($answer) {
                if ($element->truth == $answer->content) {
                    $answerCount++;
                }
            }
        }

        return $score * $answerCount;
    }

    private function calculateClosedScore(GivenAnswer $givenAnswer, Exercise $exercise, $student_id)
    {
        $score = 0;

        $points = Exercise::where('id', $exercise->id)->value('points');
        $closedAnswer = ClosedAnsElement::where('answer_id', $givenAnswer->id)->where('content', 1)->value('ex_elem_id');
        $truth = closedExElement::where('id', $closedAnswer)->value('truth');

        if($truth)
        {
            $score = $points;
        }

        return $score;
    }

    private function calculateFillScore(GivenAnswer $givenAnswer, Exercise $exercise, $student_id)
    {
        $points = Exercise::where('id', $exercise->id)->value('points');
        $fillExElements = FillExElement::where('exercise_id', $exercise->id)
            ->where('type', 'input')
            ->get();

        $answerCount = 0;

        $score = $points / $fillExElements->count();

        $fillAnswers = FillAnsElement::where('answer_id', $givenAnswer->id)->get();

        foreach ($fillExElements as $element)
        {
            $answer = $fillAnswers->firstWhere('ex_elem_id', $element->id);


            if ($answer)
            {
                if (preg_replace("/[^A-zÀ-ú0-9]+/", "", strtolower($element->content)) == preg_replace("/[^A-zÀ-ú0-9]+/", "", strtolower($answer->content)))
                {
                    $answerCount++;
                }
            }
        }

        return $score * $answerCount;

    }
}
