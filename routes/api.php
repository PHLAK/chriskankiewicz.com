<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('accomplishment', Api\AccomplishmentController::class);
Route::apiResource('education', Api\EducationController::class);
Route::apiResource('experience', Api\ExperienceController::class);
Route::apiResource('project', Api\ProjectController::class);
Route::apiResource('skill', Api\SkillController::class);

Route::apiResource('post', Api\PostController::class);
