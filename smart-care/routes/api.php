<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Mobile\MealScheduleController;
use App\Http\Resources\ManagerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/manager', function (Request $request) {
    return new ManagerResource($request->user());
});

Route::post('login', [AuthController::class, 'login']);
Route::post('student/login', [AuthController::class, 'studentLogin']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);

Route::get('/meal-schedules/current', [MealScheduleController::class, 'getCurrentWeek']);
Route::get('/meal-schedules/next', [MealScheduleController::class, 'getNextWeek']);
