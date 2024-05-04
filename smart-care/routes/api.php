<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Mobile\MealScheduleController;
use App\Http\Controllers\Api\StudentRequestController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('student/login', [AuthController::class, 'studentLogin']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('students', 'StudentController');
    
    Route::get('/manager', function (Request $request) {
        return new ManagerResource($request->user());
    });

    Route::get('/meal-schedules/current', [MealScheduleController::class, 'getCurrentWeek']);
    Route::get('/meal-schedules/next', [MealScheduleController::class, 'getNextWeek']);

    // Route::prefix('student-requests')->group(function () {
    //     Route::post('/', [StudentRequestController::class, 'store']);
    //     Route::get('/', [StudentRequestController::class, 'index'])->middleware('permission:student_requests.view');
    //     Route::get('/{id}', [StudentRequestController::class, 'show'])->middleware('permission:student_requests.view');
    //     Route::put('/{id}', [StudentRequestController::class, 'update'])->middleware('permission:student_requests.update');
    //     Route::delete('/{id}', [StudentRequestController::class, 'destroy'])->middleware('permission:student_requests.delete');
    // });
});
