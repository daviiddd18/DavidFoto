<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');
Route::get('/subir-imagen', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
Route::post('/comment/save', [App\Http\Controllers\CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
Route::get('/like/{image_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('like.delete');






