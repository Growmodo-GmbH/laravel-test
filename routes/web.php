<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
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
    return view('pages.HomePage');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function (){
    Route:: get ('/pages/user/edit',[PagesController::class,'editUser'])->name('edit.user');
Route:: get ('/pages/user/create',[PagesController::class,'create'])->name('create.user');
Route:: get ('/pages/users',[PagesController::class,'users'])->name('user');
Route:: get ('/welcome',[PagesController::class,'index'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');
});