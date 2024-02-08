<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

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
    return view('dashboard/index');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', UserController::class);
Route::resource('label',LabelController::class);
Route::resource('category', CategoryController::class);
Route::resource('ticket',TicketController::class);
Route::resource('comment', CommentController::class);
Route::post('/', [CommentController::class, 'store'])->name('comment.store');
Route::put('/{comment}', [CommentController::class, 'update'])->name('comment.update');
// Route::put('/comments/{comment}', CommentController::class,'update')->name('comment.update');

