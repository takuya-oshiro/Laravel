<?php

//use App\Http\Kernel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\UserCheckMiddleware;
//use App\Http\Middleware\Authenticate;
//use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', [AuthController::class, 'show'])->name('showLogin');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('post', [PostController::class, 'create'])->name('createPost');
Route::post('post', [PostController::class, 'insert'])->name('insertPost');
Route::get('top', [TopController::class, 'show'])->name('showTop');
Route::get('apply', [UserController::class, 'showApply'])->name('showApply');
Route::post('apply', [AuthController::class, 'applyEmail'])->name('applyEmail');
Route::get('applycheck', [AuthController::class, 'tokenCheck'])->name('tokenCheck');
Route::post('registar', [UserController::class, 'registar'])->name('userRegistar');
Route::get('mypage/posts', [MyPageController::class, 'posts'])->name('myPage.Posts');
Route::get('mypage.comments', [MyPageController::class, 'comments'])->name('myPage.Comments');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('detail/{post}', [TopController::class, 'detail'])->name('showDetail');
Route::post('comment', [PostController::class, 'commentInsert'])->name('commentInsert');


Route::get('mypage/user', [MyPageController::class, 'showUserUpdate'])->name('showUserUpdate');
Route::put('mypage/user', [UserController::class, 'update'])->name('updateUser');

Route::get('mypage/post/edit/{post}', [MyPageController::class, 'showEdit'])->name('post.edit');
Route::put('mypage/post/edit/{post}', [MyPageController::class, 'update'])->name('post.update');
Route::delete('mypage/post/{post}',   [MyPageController::class, 'delete'])->name('post.delete');


Route::get('mypage/comment/edit/{comment}',      [MyPageController::class, 'showCommentEdit'])->name('comment.edit');
Route::put('mypage/comment/edit/{comment}',      [MyPageController::class, 'commentUpdate'])->name('comment.update');
Route::delete('mypage/comment/delete/{comment}', [MyPageController::class, 'commentDelete'])->name('comment.delete');

Route::get('admin',      [AdminController::class, 'show'])->name('admin');
Route::get('admin/user', [AdminController::class, 'showUser'])->name('adminUser');
Route::get('admin/post', [AdminController::class, 'showPost'])->name('adminPost');
