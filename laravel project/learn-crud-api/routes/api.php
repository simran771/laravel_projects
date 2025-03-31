<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use app\Http\Controllers\CustomerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/get-posts",[PostController::class, 'getPosts']);
Route::post("/create-post",[PostController::class, 'createPost']);
Route::delete("/delete-posts/{id}",[PostController::class, 'deletePosts']);
Route::post("/update-post/{id}",[PostController::class, 'updatePost']);
// Route::patch("/patch-posts",[PostrController::class, 'getPosts']);
// Route::post("/create-post",[PostrController::class, 'createPost']);
Route::get("/get-customer",[CustomerController::class, 'getcustomer']);



