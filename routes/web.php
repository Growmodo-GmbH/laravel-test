<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WelcomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('/records', RecordController::class);
Route::get('/', [WelcomeController::class, 'index'])->name('welcome')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/records', [RecordController::class, 'index'])->name('records')->middleware('auth');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/userSession', [LoginController::class, 'userSession'])->name('userSession');

Route::post('/api/login', [LoginController::class, 'check'])->name('check');
Route::post('/api/register', [RegisterController::class, 'store'])->name('store');
Route::get('/api/records', [RecordController::class, 'userData'])->name('userData');
Route::put('/api/update/{id}', [RecordController::class, 'update'])->name('update');
Route::delete('/api/delete/{id}', [RecordController::class, 'delete'])->name('delete');
Route::post('/api/logout', [LoginController::class, 'logout'])->name('logout');

