<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentCoursesController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TopicsController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role:student')->group(function () {
    Route::controller(StudentCoursesController::class)->group(function () {
        Route::get('/student/my-courses', 'show')->name('student.show');
    });
});

Route::middleware('auth', 'role:teacher')->group(function () {  // TODO: implementare redirect per insegnanti/studenti
    Route::get('/teacher-dashboard', function () {
        return view('dashboard-teacher');
    })->name('td');

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
        Route::post('/exercise-creator/{id}', 'create')->name('exercise.createInit');
        Route::post('/true-false-creator/{id}', 'createTf')->name('exercise.createTf');
        Route::post('/closed-creator/{id}', 'createClosed')->name('exercise.createClosed');
        Route::post('/open-creator/{id}', 'createOpen')->name('exercise.createOpen');
        Route::post('/fill-creator/{id}', 'createFill')->name('exercise.createFill');

        Route::get('/exercise/{id}', 'showExercise')->name('exercise.show');
        Route::delete('/exercise/{id}', 'delete')->name('exercise.delete');
        Route::put('/exercise/{id}', 'edit')->name('exercise.edit');
    });

    Route::controller(QuizzesController::class)->group(function () {
        Route::get('/quizzes', 'index')->name('quiz.index');
        Route::post('/quizzes', 'create')->name('quiz.create');
        Route::post('/add-to-quiz', 'addExercise')->name('quiz.addExercise');
    });

    Route::controller(CourseController::class)->group(function () {
        Route::get('/create-course', 'index')->name('courses.index');
        Route::post('/create-course', 'store')->name('courses.store');
        Route::get('/my-courses', 'show')->name('courses.show');
        Route::get('/my-courses/{course}', 'edit')->name('courses.edit');
        Route::put('/my-courses/{course}', 'update')->name('courses.update');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/student/{course}', 'show')->name('student');
        Route::put('/student/{course}', 'store')->name('student.store');
        Route::get('/student/{course}/search', 'search')->name('student.search');
        Route::delete('/courses/{course}/student/{student}', 'delete')->name('student.delete');
    });
});

require __DIR__ . '/auth.php';
