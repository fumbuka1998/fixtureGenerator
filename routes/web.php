<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\http\Controllers\BoardMemberController;

/*BoardMemberController
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
Route::get('/superadmin', [LoginController::class])->name('superadmin')->middleware('superadmin');
// Route::get('/superadmin', function(){
//     return view('superadmin');
// })->name('superadmin')->middleware('superadmin');

//admin route && and the board members

Route::get('/admin', [LoginController::class])->name('admin')->middleware('admin');
Route::get('/addBoardMember', [BoardMemberController::class, 'index'])->name('addboardMember');
Route::get('fetchmember', [BoardMemberController::class, 'fetchStudents']);
Route::post('memberstore', [BoardMemberController::class, 'store']);
Route::get('edit-member/{id}', [BoardMemberController::class, 'edit']);
Route::put('update_member/{id}', [BoardMemberController::class, 'update']);
Route::delete('delete-member/{id}', [BoardMemberController::class, 'deleteMember']);

// Route::get('/admin', function(){
//     return view('admin');
// })->name('admin')->middleware('admin');

//referee route

Route::get('/referee', function () {
    return view('referee');
})->name('referee')->middleware('referee');

//teamadmin route

Route::get('/teamadmin', function () {
    return view('teamadmin');
})->name('teamadmin')->middleware('teamadmin');

// normaluser route

Route::get('/normaluser', function () {
    return view('normaluser');
})->name('normaluser')->middleware('normaluser');
