<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
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

Route::get('/user', [UserController::class, 'user']);
Route::post('/user-by-token', [UserController::class, 'userByToken']);

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', RegisterController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UsersController::class, 'users']);
    Route::delete('/users/delete/user/{user}', [UsersController::class, 'deleteUser']);
    Route::post('/users/create-user', [UsersController::class, 'createUser']);
    Route::patch('/users/update-user/{user}', [UsersController::class, 'updateUser']);
    Route::post('/users/toggle-subscribe', [UserController::class, 'toggleSubscribe']);
});
