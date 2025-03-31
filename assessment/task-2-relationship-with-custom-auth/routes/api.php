<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CartItemController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('get-connection-id', [AuthController::class, 'get_connection_id']);
Route::post('request-otp', [AuthController::class, 'request_otp']);
Route::post('register-customer', [AuthController::class, 'register_customer']);
Route::post('login', [AuthController::class, 'login']);

Route::post('/order', [OrderController::class, 'placeOrder']);

Route::get('/customer',[CustomerController::class,'indexC']);
Route::post('/customerstore',[CustomerController::class,'storeC']);

Route::get('/product',[ProductController::class,'indexproduct']);
Route::post('/productstore',[ProductController::class,'store']);

Route::post('/place-order', [OrderController::class, 'place_order']);
Route::post('/cancel-order', [OrderController::class, 'cancelOrder']);
Route::post('/list-order', [OrderController::class, 'listOrders']);
Route::post('/order-detail', [OrderController::class, 'orderDetail']);

Route::post('/list-product', [ProductController::class, 'listProducts']);
Route::post('/get-product-detail', [ProductController::class, 'getProductDetail']);




