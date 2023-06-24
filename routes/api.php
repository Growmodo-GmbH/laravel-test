<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->group(function() {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// Route::group(['middleware' => 'auth:api'], function () {
//     Route::get('/home', [UserController::class, 'show']);
// });

Route::get('/user', [UserController::class, 'show']);
Route::put('/edit/{user}', [UserController::class, 'edit']);
Route::delete('/delete/{user}', [UserController::class, 'delete']);