<?php

use App\Http\Controllers\BlogsController;
use Illuminate\Support\Facades\Route;
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

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('admin/blogs', [BlogsController::class, 'index'])->name('blog.index');

//route itujyana kuri ya create

Route::get('admin/blogs/create', [BlogsController::class, 'create'])->name('create.blogs');
Route::post('admin/blogs/create', [BlogsController::class, 'store'])->name('store.blogs');
Route::get('admin/blogs/{blog}/edit', [BlogsController::class, 'edit'])->name('edit.blogs');
Route::put('admin/blogs/{blog}/update', [BlogsController::class, 'update'])->name('update.blogs');
Route::get('admin/blogs/{blog}/delete', [BlogsController::class, 'destroy'])->name('delete.blogs');

//view for end users
Route::get('/', [BlogsController::class, 'homeBlogs'])->name('homeBlogs');