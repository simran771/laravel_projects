<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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
    //Route::get('/master', function () {
      //  return view('layouts.master');
   // });


Route::get('/student/register', [StudentController::class, 'register'])->name('student.register');
Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/editupdate/{id}', [StudentController::class, 'update'])->name('student.update');
//Route::post('/student/destroy', [StudentController::class, 'destroy'])->name('student.destroy');
Route::get('/list', [StudentController::class, 'list'])->name('student.list');

});

require __DIR__.'/auth.php';

   
