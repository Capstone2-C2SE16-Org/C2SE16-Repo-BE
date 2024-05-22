<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Mobile\ClassroomController;
use App\Http\Controllers\Mobile\ContactBookController;
use App\Http\Controllers\Mobile\LearningScheduleController;
use App\Http\Controllers\Mobile\MealScheduleController;
use App\Http\Controllers\Mobile\StudentRequestController;
use App\Http\Controllers\Web\MealScheduleController as WebMealScheduleController;
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
    Route::get('/manager', function (Request $request) {
        return new ManagerResource($request->user());
    });

    Route::prefix('meal-schedules')->group(function () {
        Route::get('/current', [MealScheduleController::class, 'getCurrentWeek']);
        Route::get('/', [WebMealScheduleController::class, 'index'])->middleware('permission:meal_schedules.view');
        Route::post('/', [WebMealScheduleController::class, 'store'])->middleware('permission:meal_schedules.create');
        Route::put('/{id}', [WebMealScheduleController::class, 'update'])->middleware('permission:meal_schedules.update');
        Route::delete('/{id}', [WebMealScheduleController::class, 'destroy'])->middleware('permission:meal_schedules.delete');
    });

    Route::prefix('student-requests')->group(function () {
        Route::post('/', [StudentRequestController::class, 'store']);
        Route::get('/', [StudentRequestController::class, 'index'])->middleware('permission:student_requests.view');
        Route::get('/{id}', [StudentRequestController::class, 'show'])->middleware('permission:student_requests.view');
        Route::put('/{id}', [StudentRequestController::class, 'update'])->middleware('permission:student_requests.update');
        Route::delete('/{id}', [StudentRequestController::class, 'destroy'])->middleware('permission:student_requests.delete');
    });

    Route::prefix('classrooms')->group(function () {
        Route::get('/', [ClassroomController::class, 'index'])->middleware('permission:classrooms.view');;
        Route::get('/{classroomId}', [ClassroomController::class, 'show'])->middleware('permission:classrooms.view');;
        Route::get('/{classroomId}/students', [ClassroomController::class, 'listStudents'])->middleware('permission:classrooms.view');
        Route::get('/{classroomId}/students/{studentId}', [ClassroomController::class, 'getStudentDetails'])->middleware('permission:classrooms.view');
        Route::patch('/{classroomId}/students/{studentId}/contact-book', [ClassroomController::class, 'updateContactBook'])->middleware('permission:classrooms.manage');
        Route::post('/{classroomId}/assign-teacher', [ClassroomController::class, 'assignTeacher'])->middleware(['permission:classrooms.manage']);
        Route::get('/{classroomId}/schedules', [ClassroomController::class, 'getClassroomSchedule']);
        Route::get('/{classroomId}/details', [ClassroomController::class, 'getClassroom']);
        //Lich Hoc
        Route::get('/{classroomId}/schedules/current', [ClassroomController::class, 'getCurrentWeek']);
        Route::post('/{classroomId}/schedules', [LearningScheduleController::class, 'store'])->middleware(['per mission:learning_schedules.create']);
        Route::put('/{classroomId}/schedules/{id}', [LearningScheduleController::class, 'update'])->middleware('permission:learning_schedules.update');
        Route::delete('/{classroomId}/schedules/{id}', [LearningScheduleController::class, 'destroy'])->middleware('permission:learning_schedules.delete');
    });

    Route::get('/contact-books/my', [ContactBookController::class, 'myContactBook']);
});
