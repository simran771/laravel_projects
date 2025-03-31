<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');

Route::get('/customer',[CustomerController::class,'index']);
Route::post('/customerstore',[CustomerController::class,'store']);

Route::get('/order',[OrderController::class,'index']);
Route::post('/orderstore',[OrderController::class,'store']);

Route::get('/customer-show',[CustomerController::class,'showCustomers']);

Route::post('/student-show',[StudentController::class,'store']);

Route::post('/course-show',[CourseController::class,'store']);