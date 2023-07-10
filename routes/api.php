<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test', function(){
    return "hello world";
});

Route::group(['prefix' => 'un_auth'], function(){
    Route::post('/register', [App\Http\Controllers\Authentication\AuthenticationController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\Authentication\AuthenticationController::class, 'login']);
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['prefix' => 'user'], function(){
        Route::get('/get_all_users', [App\Http\Controllers\User\UserController::class, 'get_all_users']);
        Route::patch('/update_user_record/{id?}', [App\Http\Controllers\User\UserController::class, 'update_user_record']);
        Route::delete('/delete_record/{id?}', [App\Http\Controllers\User\UserController::class, 'delete_record']);
    });
});