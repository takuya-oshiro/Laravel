<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/',[AuthController::class, 'show'])->name('showLogin');
Route::post('login',[AuthController::class, 'login'])->name('login');
Route::get('post',[PostController::class, 'create'])->name('createPost');
Route::post('post',[PostController::class, 'insert'])->name('insertPost');
Route::get('top',[TopController::class, 'show'])->name('showTop');
Route::get('apply',[UserController::class, 'showApply'])->name('showApply');
Route::post('apply',[UserController::class, 'applyEmail'])->name('applyEmail');
Route::get('applycheck',[UserController::class, 'tokenCheck'])->name('tokenCheck');
Route::post('registar',[UserController::class, 'registar'])->name('userRegistar');
Route::get('MyPage', [MyPageController::class, 'show'])->name('showMyPage');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('detail', [TopController::class, 'detail'])->name('showDetail');
Route::post('comment', [PostController::class, 'commentInsert'])->name('commentInsert');

Route::get('mypage/user', [MyPageController::class, 'showUserUpdate'])->name('showUserUpdate');
Route::put('mypage/user', [UserController::class, 'update'])->name('updateUser');

Route::get('mypage/post/edit/{post}',[PostController::class, 'showEdit'])->name('post.edit');
Route::post('mypage/post/edit/{post}',[PostController::class, 'update'])->name('post.update');