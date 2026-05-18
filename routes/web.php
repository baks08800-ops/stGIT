<?php

use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostUController;
use App\Http\Controllers\Admin\UserController;

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


Route::group(['prefix'=>'admin',], function(){
    Route::get('/',[MainController::class,'index'])->name('admin.index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/posts', PostController::class);
    Route::get('/register', [UserController::class,'create'])->name('register.create');
    Route::post('/register',[UserController::class, 'store'])->name('register.store');
});
Route::get('/',function(){
    return view('welcome');
})->name('home');
Route::get('/login',[UserController::class,'loginForm'])->name('login.create');
Route::post('/login',[UserController::class,'login'])->name('login');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/', [PostUController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostUController::class, 'show'])->name('posts.show');
Route::get('/', [PostUController::class,'index'])->name('home');
Route::get('/article/{slug}',[PostUController::class,'index'])->name('posts.single');
Route::get('/', [PostUController::class, 'index'])->name('home');
Route::get('/article/{slug}', [PostUController::class,'index'])->name('posts.single');
Route::get('category/{slug}', [CategoryController::class, 'show'])->name('categories.single');