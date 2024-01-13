<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ExercisesController;

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

Route::middleware('auth', 'role:teacher')->group(function(){
    Route::get('/teacher-dashboard', function () {
        return view('dashboard-teacher');
    })->name('td');
    Route::get('/subjects', [SubjectsController::class, 'show']);
    Route::post('/subjects', [SubjectsController::class, 'create'])->name('subject.create');

    Route::get('/subject/{id}', [TopicsController::class, 'show'])->name('subject.topics');
    Route::post('/subject/{id}', [TopicsController::class, 'create'])->name('topic.create');

    Route::get('/exercises/{id}', [ExercisesController::class, 'show'])->name('topic.exercises');
});

require __DIR__.'/auth.php';
