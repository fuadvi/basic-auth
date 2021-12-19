<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/auth', [AuthController::class, 'auth']);
Route::get('/product', [ProductController::class, 'findAll']);
Route::get('/product/{product}', [ProductController::class, 'findOne']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/order', [OrderController::class, 'findAll'])->middleware('authorization');
Route::put('/order/{order}', [OrderController::class, 'update']);
Route::delete('/order/{order}', [OrderController::class, 'destroy']);
