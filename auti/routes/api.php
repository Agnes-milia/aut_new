<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//public route
Route::post('/auth/login', [AuthController::class, 'login']);
//protected route
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/auth/register', [AuthController::class, 'register'])->middleware('restrictRole:admin');
    Route::get('/users', [PostController::class, 'index'])->middleware('restrictRole:admin');
    Route::get('/users/{id}', [PostController::class, 'show'])->middleware('restrictRole:admin');
    Route::put('/users/{id}', [PostController::class, 'update'])->middleware('restrictRole:moderator');
});
