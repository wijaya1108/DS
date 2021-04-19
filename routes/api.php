<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products',[ProductController::class, 'index']);
Route::get('/products/{id}',[ProductController::class, 'show']);
Route::post('/products',[ProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/products/{id}',[ProductController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/products/{id}',[ProductController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user',[UserController::class, 'index'])->middleware('auth:sanctum');
Route::put('/user/update',[UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/user/delete',[UserController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/user/all',[UserController::class, 'allUsers'])->middleware('auth:sanctum');