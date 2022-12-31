<?php

use  Illuminate\Support\Facades\Route;
use  App\Http\Controllers\RegisterController;
use  App\Http\Controllers\SessionsController;
use  App\Http\Controllers\UsersController;
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


/*
Route::get('/', function () {
    return view('auth/login');
});

Route::get('/login', function () {
    return view('auth/login');
}); */
/*->middleware('auth'); */

Route::get('/recuperar', [RegisterController::class, 'create'])->name('recuperar.index');
  /*  ->middleware('guest') */


/*
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');
*/


/* Route::get('/login', [SessionsController::class, 'create'])->name('login.index');
   ->middleware('guest')  */


/*
Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');


Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin.index');
*/

Route::get('users/index', [UsersController::class, 'index'])->name('users.index');
Route::get('home', function(){
    return view('home');
});

