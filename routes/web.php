<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\http\Controllers\BoardMemberController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MatchReportController;

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
// Route::get('/addBoardMember', [BoardMemberController::class, 'index'])->name('addboardMember');
// Route::get('fetchmember', [BoardMemberController::class, 'fetchStudents']);
// Route::post('memberstore', [BoardMemberController::class, 'store']);
// Route::get('edit-member/{id}', [BoardMemberController::class, 'edit']);
// Route::put('update_member/{id}', [BoardMemberController::class, 'update']);
// Route::delete('delete-member/{id}', [BoardMemberController::class, 'deleteMember']);

//routes for boardmember management
Route::get('/addBoardMember', [BoardMemberController::class, 'index'])->name('addboardMember');
Route::post('/store', [BoardMemberController::class, 'store'])->name('store');
Route::get('/fetchall', [BoardMemberController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete/id', [BoardMemberController::class, 'delete'])->name('delete');
Route::get('/edit', [BoardMemberController::class, 'edit'])->name('edit');
Route::post('/update', [BoardMemberController::class, 'update'])->name('update');

// Route::get('/admin', function(){
//     return view('admin');
// })->name('admin')->middleware('admin');

//referee route

Route::get('/addReferee', [RefereeController::class, 'index'])->name('addReferees');
Route::post('/store', [RefereeController::class, 'store'])->name('store');
Route::get('/fetchall', [RefereeController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete/id', [RefereeController::class, 'delete'])->name('delete');
Route::get('/edit', [RefereeController::class, 'edit'])->name('edit');
Route::post('/update', [RefereeController::class, 'update'])->name('update');

// Route::get('/referee', function () {
//     return view('referee');
// })->name('referee')->middleware('referee');

//teamadmin route


Route::get('/addTeam', [TeamController::class, 'index'])->name('addSportTeams');
Route::post('/store', [TeamController::class, 'store'])->name('store');
Route::get('/fetchall', [TeamController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete/id', [TeamController::class, 'delete'])->name('delete');
Route::get('/edit', [TeamController::class, 'edit'])->name('edit');
Route::post('/update', [TeamController::class, 'update'])->name('update');

// Route::get('/teamadmin', function () {
//     return view('teamadmin');
// })->name('teamadmin')->middleware('teamadmin');



//stadium managements route

Route::get('/addStadium', [StadiumController::class, 'index'])->name('addStadiums');
Route::post('/store', [StadiumController::class, 'store'])->name('store');
Route::get('/fetchall', [StadiumController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete/id', [StadiumController::class, 'delete'])->name('delete');
Route::get('/edit', [StadiumController::class, 'edit'])->name('edit');
Route::post('/update', [StadiumController::class, 'update'])->name('update');



// normaluser route

Route::get('/normaluser', function () {
    return view('normaluser');
})->name('normaluser')->middleware('normaluser');


//routes to generete and display all the matches

Route::get('/matches', [MatchController::class, 'index'])->name('matchgenerator');


//routes to display the match report

Route::get('matchreport', [MatchReportController::class, 'index'])->name('matchReport');