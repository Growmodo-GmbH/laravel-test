<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/records', [RecordController::class, 'index'])->name('records')->middleware('auth');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/userSession', [LoginController::class, 'userSession'])->name('userSession');

// api routes
Route::post('/api/login', [LoginController::class, 'check'])->name('check');
Route::post('/api/register', [RegisterController::class, 'store'])->name('store');
Route::get('/api/records', [RecordController::class, 'userData'])->name('userData');
Route::put('/api/update/{id}', [RecordController::class, 'update'])->name('update');
Route::delete('/api/delete/{id}', [RecordController::class, 'delete'])->name('delete');
Route::post('/api/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/api/userSession', [LoginController::class, 'userSession'])->name('userSession');

