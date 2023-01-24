<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;

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

Route::get('/', [PostController::class, 'index']);
Route::get('/make-post', [PostController::class, 'makePost']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/user/{id}', [UserController::class, 'user']);
Route::get('/post/{id}', [PostController::class, 'post']);

Route::post('/editPost/{id}', [PostController::class, 'editPost'])->name('editPost');
Route::post('/submitEditPost/{id}', [PostController::class, 'submitEditPost'])->name('submitEditPost');
Route::post('/savePost', [PostController::class, 'savePost'])->name('savePost');
Route::delete('/deletePost/{id}', [PostController::class, 'deletePost'])->name('deletePost');

Route::post('/likePost/{postId}', [LikeController::class, 'likePost'])->name('likePost');
Route::post('/dislikePost/{postId}', [LikeController::class, 'dislikePost'])->name('dislikePost');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);


// Route::post('register', [AuthController::class, 'register'])->name('register');
