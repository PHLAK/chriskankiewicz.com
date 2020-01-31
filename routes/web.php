<?php

use App\Http\Controllers;
use Canvas\Http\Middleware\ViewThrottle;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Controllers\IndexController::class)->name('index');

Route::prefix('blog')->group(function () {
    Route::get('/', [Controllers\BlogController::class, 'getPosts'])->name('blog.index');
    Route::get('{slug}', [
        Controllers\BlogController::class, 'findPostBySlug'
    ])->middleware(ViewThrottle::class)->name('blog.post');
    Route::get('tag/{slug}', [Controllers\BlogController::class, 'getPostsByTag'])->name('blog.tag');
    Route::get('topic/{slug}', [Controllers\BlogController::class, 'getPostsByTopic'])->name('blog.topic');
});

Route::get('/dashboard', [Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::view('/docs', 'docs')->name('docs');
