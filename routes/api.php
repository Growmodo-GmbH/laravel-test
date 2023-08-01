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


Route::post('/login', 'LoginController@authenticate');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout',   'LogoutController@logout');
});
Route::post('/auth', 'AuthenticateController@authenticate')->middleware('auth:sanctum');
Route::post('/register', 'RegisterController@register');
Route::get('/admin/user', 'UserController@getUsers')->middleware('auth:sanctum');
Route::get('/admin/user/{id}', 'UserController@getUserByID')->middleware('auth:sanctum');
Route::get('/admin/users', 'UserController@get')->middleware('auth:sanctum');
Route::post('/delete/{id}', 'UserController@deleteUser');
Route::post('/update/{id}', 'UserController@editUser')->middleware('auth:sanctum');
