<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//superadmin route

Route::get('/superadmin', function(){
    return view('superadmin');
})->name('superadmin')->middleware('superadmin');

//admin route

Route::get('/admin', function(){
    return view('admin');
})->name('admin')->middleware('admin');

//referee route

Route::get('/referee', function(){
    return view('referee');
})->name('referee')->middleware('referee');

//teamadmin route

Route::get('/teamadmin', function(){
    return view('teamadmin');
})->name('teamadmin')->middleware('teamadmin');

// normaluser route

Route::get('/normaluser', function(){
    return view('normaluser');
})->name('normaluser')->middleware('normaluser');



