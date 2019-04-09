<?php

use App\Http\Controllers;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('education', Controllers\EducationController::class);
Route::apiResource('experience', Controllers\ExperienceController::class);
Route::apiResource('project', Controllers\ProjectController::class);
Route::apiResource('skill', Controllers\SkillController::class);
