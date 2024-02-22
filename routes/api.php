<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::middleware('auth:sanctum')->post('/follow/{followed_user_id}', [App\Http\Controllers\FollowerController::class, 'follow']);
Route::middleware('auth:sanctum')->delete('/unfollow/{followed_user_id}', [App\Http\Controllers\FollowerController::class, 'unfollow']);


