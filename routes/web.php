<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\blogController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    route::get('/categories', [categoryController::class, 'index'])->name('categories');
    route::get('/category', [blogController::class, 'blogs'])->name('category');
    route::get('/blog', [blogController::class, 'blog'])->name('blog');
});

use App\Http\Controllers\home;
route::get('/home', [home::class, 'index']);

use App\Http\Controllers\mailController;
Route::get('/send-mail', [mailController::class, 'index']);
