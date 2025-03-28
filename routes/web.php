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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'detail'])->name('detail');
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
Route::post('/regist', [App\Http\Controllers\ProductController::class, 'registSubmit'])->name('submit');
Route::post('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');
