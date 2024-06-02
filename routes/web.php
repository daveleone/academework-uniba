<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\StudentController;
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

Route::middleware('auth', 'role:teacher')->group(function () {  // implementare redirect per insegnanti/studenti
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
        Route::get('/quiz/{id}', 'show')->name('quizzes.show');
    });

    // Here route accessible only to teachers
    Route::get('/create-course', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/create-course', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/my-courses', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/my-courses/{course}', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/my-courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    // Route::put('/my-courses/{course}/students', [CourseController::class, 'addStudent'])->name('courses.students');
    Route::get('/students/{course}', [StudentController::class, 'show'])->name('students');
    Route::put('/students/{course}', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{course}/search', [StudentController::class, 'search'])->name('students.search');
});

require __DIR__ . '/auth.php';
