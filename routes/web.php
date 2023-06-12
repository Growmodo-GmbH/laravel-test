<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
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
    return view('records');
});
// Route::resource('/records', RecordController::class);
Route::get('/records', [RecordController::class, 'index']);
Route::get('/delete/{id}', [RecordController::class, 'delete']);