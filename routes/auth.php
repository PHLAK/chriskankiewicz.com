<?php

use App\Http\Controllers\Auth;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application.
|
*/

Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Auth\LoginController::class, 'login']);

Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');

Route::post('password/email', [Auth\ForgotPassowordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset', [Auth\ForgotPassowordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/reset', [Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [Auth\ResetPasswordController::class, 'shoResetForm'])->name('password.reset');

Route::get('register', [Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [Auth\RegisterController::class, 'register']);
