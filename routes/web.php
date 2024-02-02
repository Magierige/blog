<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\userControler;
use App\Http\Controllers\userLikeController;

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

Route::get('/', function () {
    return view('welcome');
});
route::get('/test', [userControler::class, 'catRight']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //route::get('/categories', [categoryController::class, 'index'])->name('categories');
    route::get('/categories', [categoryController::class, 'test'])->name('categories');
    route::get('/categories/category', [blogController::class, 'blogs'])->name('category');
    route::get('/blog', [blogController::class, 'blog'])->name('blog');
    route::get('/catpage', [categoryController::class, 'catPage'])->name('catPage');
    route::get('/categories/create', [categoryController::class, 'form'])->name('createForm');
    route::post('/categories/create', [categoryController::class, 'create'])->name('create');
    route::get('/categories/edit', [categoryController::class, 'edit'])->name('editForm');
    route::post('/categories/edit', [categoryController::class, 'update'])->name('edit');
    route::get('/help', [categoryController::class, 'help'])->name('help');

    route::get('/blog/create', [blogController::class, 'form'])->name('blogCreateForm');
    route::post('/blog/create', [blogController::class, 'create'])->name('blogCreate');
    route::get('/blog/edit', [blogController::class, 'edit'])->name('blogEditForm');
    route::post('/blog/edit', [blogController::class, 'update'])->name('blogEdit');
    route::post('/blog/like', [userLikeController::class, 'like'])->name('like');
});

use App\Http\Controllers\home;
route::get('/home', [home::class, 'index']);

use App\Http\Controllers\mailController;
Route::get('/send-mail', [mailController::class, 'index']);
