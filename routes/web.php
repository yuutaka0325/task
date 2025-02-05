<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;






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
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
//Route::get('/index', [App\Http\Controllers\ProductController::class, 'posts.index'])->name('posts.index');
Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'detail'])->name('detail');
//Route::post('/detail/{id}', [App\Http\Controllers\ProductController::class, 'detail'])->name('detail');
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
//Route::post('/edit/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('e');
Route::post('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
Route::post('/regist', [App\Http\Controllers\ProductController::class, 'registSubmit'])->name('submit');
Route::post('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');
//Route::get('/show/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('show');
//Route::get('/regist',[App\Http\Controllers\HomeController::class, 'registSubmit'])->name('regist');
//Route::get('/regist',[App\Http\Controllers\HomeController::class, 'registSubmit'])->name('submit');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
