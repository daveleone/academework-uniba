<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentCoursesController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\EmailController;
use App\Mail\ClassEmail;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
});

Route::middleware('auth', 'role:student')->group(function () {
    Route::controller(StudentCoursesController::class)->group(function () {
        Route::get('/student/classes', 'show')->name('student.show');
        Route::get('/student/classes/{courses}/exercises', 'retrieve_quiz')->name('student.exercises');
        Route::get('/student/classes/{courses}/exercises/{quiz}/start', 'exercises')->name('student.exam');
        Route::post('/student/classes/{courses}/exercises/{quiz}/submit', 'submitExam')->name('student.submitExam');
        Route::get('/student/course/{course}/details', 'studentClassDetails')->name('student.class_details');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/student/course/{course}/details/{student}/{quiz}/review', 'changeVote')->name('student.reviewVote');
    });
});

Route::middleware('auth', 'role:teacher')->group(function () {  // TODO: implementare redirect per insegnanti/studenti
    Route::controller(SubjectsController::class)->group(function () {
        Route::get('/subjects', 'show')->name('subject.show');
        Route::post('/subjects', 'create')->name('subject.create');
        Route::put('/subjects', 'edit')->name('subject.edit');
        Route::delete('/subjects', 'delete')->name('subject.delete');
    });

    Route::controller(TopicsController::class)->group(function () {
        Route::get('/subject/{id}', 'show')->name('subject.topics');
        Route::post('/subject/{id}', 'create')->name('topic.create');
        Route::put('/subject/{id}', 'edit')->name('topic.edit');
        Route::delete('/subject/{id}', 'delete')->name('topic.delete');
    });

    Route::controller(ExercisesController::class)->group(function () {
        Route::get('/topic/{id}', 'show')->name('topic.exercises');
        Route::post('/exercise-creator', 'create')->name('exercise.createInit');
        Route::get('/exercise-creator', 'creatorRedirect');
        Route::post('/true-false-creator/{id}', 'createTf')->name('exercise.createTf');
        Route::post('/closed-creator/{id}', 'createClosed')->name('exercise.createClosed');
        Route::post('/open-creator/{id}', 'createOpen')->name('exercise.createOpen');
        Route::post('/fill-creator/{id}', 'createFill')->name('exercise.createFill');

        Route::get('/exercises', 'index')->name('exercise.index');
        Route::get('/exercise/{id}', 'showExercise')->name('exercise.show');
        Route::delete('/exercise/{id}', 'delete')->name('exercise.delete');
        Route::put('/exercise/{id}', 'edit')->name('exercise.edit');
    });

    Route::controller(QuizzesController::class)->group(function () {
        Route::get('/quizzes', 'index')->name('quiz.index');
        Route::delete('/quizzes', 'delete')->name('quiz.delete');
        Route::put('/quizzes', 'edit')->name('quiz.edit');
        Route::get('/quiz/{id}', 'show')->name('quiz.show');
        Route::post('/quizzes', 'create')->name('quiz.create');
        Route::post('/add-to-quiz', 'addExercise')->name('quiz.addExercise');
        Route::post('/add-to-course', 'addToCourse')->name('quiz.addToCourse');
        Route::delete('/quiz/{id}', 'removeEx')->name('quiz.removeEx');
        Route::get('/quiz/{id}/download', 'downloadPdf')->name('quiz.download');
        Route::delete('/classes/{course}/quizzes/{quiz}', 'removeFromCourse')->name('quiz.remove');
    });

    Route::controller(CourseController::class)->group(function () {
        Route::get('/create-course', 'index')->name('courses.index');
        Route::post('/create-course', 'store')->name('courses.store');
        Route::get('/classes', 'show')->name('courses.show');
        Route::get('/classes/{course}', 'edit')->name('courses.edit');
        Route::put('/classes/{course}', 'update')->name('courses.update');
        Route::delete('/classes/{course}', 'destroy')->name('courses.destroy');
        Route::get('/classes/{course}/quizzes', 'showQuizzes')->name('courses.quizzes');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/student/{course}', 'show')->name('student');
        Route::put('/student/{course}', 'store')->name('student.store');
        Route::delete('/courses/{course}/student/{student}', 'delete')->name('student.delete');
        Route::get('/courses/{course}/student/{student}', 'details')->name('student.details');
        Route::get('/courses/{course}/student/{student}/{quiz}/review', 'changeVote')->name('student.changeVote');
        Route::put('/courses/{course}/student/{student}/{quiz}/review', 'updateVote')->name('student.updateVote');
    });

    Route::get('locale/{lang}',[LocaleController::class,'setLocale']);
    // non serve perchè ho integrato in quizzesconteoller Route::get('send-mail',[EmailController::class, 'ClassEmail']);
});

Route::get('locale/{lang}',[LocaleController::class,'setLocale']);

require __DIR__ . '/auth.php';
