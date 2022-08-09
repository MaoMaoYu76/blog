<?php

use App\Http\Controllers\Ninicontroller;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function(){
    Route::resource('posts',PostController::class)->except('index','show');
});
Route::resource('posts',PostController::class)->only('index','show');
Route::resource('category',CategoryController::class);

Route::get('/posts/tag/{tag}',[PostController::class,'postsTag'])->name('posts.tag');
Route::get('/posts/categoryg/{category}',[PostController::class,'postsCategory'])->name('posts.category');

Route::get('/trash',[PostController::class,'trash'])->name('trash.index');

Route::delete('/trash/{id}',[PostController::class,'trashDelete'])->name('trash.delete');
Route::get('/trash/{id}',[PostController::class,'trashRestore'])->name('trash.restore');


// Route::resource('posts',BlogController::class);
// Route::get('/posts',[Postscontroller::class,'index'])->name('blog.index');
// Route::post('/posts',[Postscontroller::class,'store'])->name('blog.store');
// Route::get('/posts/create',[Postscontroller::class,'create'])->name('blog.create');
// Route::get('/posts/edit/{id}',[Postscontroller::class,'edit'])->name('blog.edit');
// Route::get('/posts/show/{id}',[Postscontroller::class,'show'])->name('blog.show');
// Route::delete('/posts',[Postscontroller::class,'delete'])->name('blog.delete');
// Route::put('/posts',[Postscontroller::class,'update'])->name('blog.update');

// Route::get('/nini/create', [Ninicontroller::class,'create']);
// Route::get('/nini/store', [Ninicontroller::class,'store']);
// Route::get('/nini/{name?}', [Ninicontroller::class,'nini']);
// Route::post('/nini',[Ninicontroller::class,'store']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


