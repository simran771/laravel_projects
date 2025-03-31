<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\PostController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware(['auth:api', 'role:user'])->group(function(){
    Route::post('/create', [PostController::class, 'createPost']);
    Route::get('read', [PostController::class, 'Read']);
    Route::post('/update-post/{id}', [PostController::class, 'updatePost']);
    Route::post('/delete', [PostController::class, 'destroy']);
});


Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

