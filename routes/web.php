<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('create_post');
Route::get('/post/edit/{uuid}', [App\Http\Controllers\PostController::class, 'edit'])->name('edit_post');
Route::patch('/post/update/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('update_post');
Route::post('/post/delete/{uuid}', [App\Http\Controllers\PostController::class, 'destroy'])->name('delete_post');
Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('store_post');
Route::post('/post/store_comment', [App\Http\Controllers\PostController::class, 'store_comment'])->name('comment_post');
Route::get('/post/{url}', [App\Http\Controllers\PostController::class, 'show'])->name('show_post');

Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user_edit');
Route::patch('/user/update/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('user_update');
Route::get('/user/my_posts/{id}', [App\Http\Controllers\UserController::class, 'show_posts'])->name('user_posts');
Route::get('/user/my_favs/{id}', [App\Http\Controllers\UserController::class, 'show_favs'])->name('user_favs');
Route::get('/user/review_posts', [App\Http\Controllers\UserController::class, 'review_posts'])->name('user_review');
