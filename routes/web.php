<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();
//HOME
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USUARIOS
Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');
Route::get('/perfil/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('/gente/{search?}', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/follows', [App\Http\Controllers\FollowerController::class, 'index'])->name('user.followers');
Route::get('/follow/{followed_user_id}', [App\Http\Controllers\FollowerController::class, 'follow'])->name('follow.save');
Route::get('/unfollow/{followed_user_id}', [App\Http\Controllers\FollowerController::class, 'unfollow'])->name('follow.delete');

//IMÁGENES
Route::get('/subir-imagen', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
Route::get('/image/delete/{id}', [App\Http\Controllers\ImageController::class, 'delete'])->name('image.delete');
Route::get('/image/edit/{id}', [App\Http\Controllers\ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update', [App\Http\Controllers\ImageController::class, 'update'])->name('image.update');

//COMENTARIOS
Route::post('/comment/save', [App\Http\Controllers\CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');

//LIKES
Route::get('/like/{image_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('like.delete');
Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes');

//Footer
Route::get('/faqs', [App\Http\Controllers\FooterController::class, 'faqs'])->name('footer.faqs');
Route::get('/aboutus', [App\Http\Controllers\FooterController::class, 'about'])->name('footer.about');








