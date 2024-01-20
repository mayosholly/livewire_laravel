<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Livewire\ShowUsers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [CategoryController::class, 'index'])->name('category.index');
Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/add', [UserController::class, 'create'])->name('user.create');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/book', [BookController::class, 'index'])->name('book.index');

// Route::get('/user1', ShowUsers::class);
