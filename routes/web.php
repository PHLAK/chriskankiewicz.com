<?php

use App\Http\Controllers;
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

Route::view('/', 'index')->name('index');

Route::get('/experience', Controllers\ExperienceController::class)->name('experience');
Route::get('/projects', Controllers\ProjectsController::class)->name('projects');
Route::get('/education', Controllers\EducationController::class)->name('education');
Route::get('/accomplishments', Controllers\AccomplishmentsController::class)->name('accomplishments');

Route::name('blog.')->prefix('blog')->group(function (): void {
    Route::get('/', [Controllers\BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [Controllers\BlogController::class, 'post'])->name('post');
});

Route::get('/dashboard', [Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::view('/docs', 'docs')->name('docs');
