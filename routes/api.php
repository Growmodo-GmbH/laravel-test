<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Authenticate;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AuthenticateController;


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


// Default

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('posts', 'APIUserController@index');

// Route For Login

Route::post('/login', [LoginController::class, 'authenticate']);

// Route For Logout
Route::group(['middleware' => ['auth:sanctum']], function() {
  Route::post('logout',   [LogoutController::class, 'logout']);
});

// Route For Getting Single-User
Route::post('/auth', [AuthenticateController::class, 'auth'])->middleware('auth:sanctum');

// Route For Registration
Route::post('/register', [RegisterController::class, 'store']);

// Route For Getting Authenticated User
Route::get('/admin/user', [UserController::class, 'getUser'])->middleware('auth:sanctum');

// Route For Getting User By ID
Route::get('/admin/user/{id}', [UserController::class, 'getUserByID'])->middleware('auth:sanctum');

// Route For Getting All Users Except The Authenticated User
Route::get('/admin/users', [UserController::class, 'get'])->middleware('auth:sanctum');

// Route For Getting All Users
Route::post('/delete/{id}', [UserController::class, 'deleteUser']);

Route::post('/update/{id}', [UserController::class, 'editUser'])->middleware('auth:sanctum');


