<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Auth homepage
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User Records page.
Route::get('/records', [App\Http\Controllers\HomeController::class, 'showRecords'])->name('records');
// Unsubscribe page.
Route::get('/unsubscribe', [App\Http\Controllers\HomeController::class, 'unsub'])->name('unsubscribe');
