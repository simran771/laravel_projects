<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiddlewareController;





Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('get-connection-id', [MiddlewareController::class, 'get_connection_id']);
Route::post('request-otp', [MiddlewareController::class, 'request_otp']);
Route::post('register-customer', [MiddlewareController::class, 'register_customer']);
Route::post('login', [MiddlewareController::class, 'login']);