<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAddressController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/printmy', [CustomerAddressController::class, 'index']);
