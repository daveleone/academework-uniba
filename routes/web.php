<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
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

Route::middleware(['auth', 'role:teacher'])->group(function () {
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

require __DIR__.'/auth.php';
