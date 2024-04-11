<?php

use App\Http\Controllers\Api\v1\ApplicantController;
use App\Http\Controllers\Api\v1\EmployeeController;
use App\Http\Controllers\Api\v1\JobController;
use App\Models\Applicant;
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

Route::prefix('v1')->middleware('force.json')->group(function(){
    Route::get('/jobs', [JobController::class, 'jobs']);
    Route::get('/jobs/{id}', [JobController::class, 'job']);

    Route::post('/apply/register', [ApplicantController::class, 'apply']);
    Route::post('/apply/login', [ApplicantController::class, 'login']);
    
    Route::middleware('auth.applicant')->group(function(){
        Route::post('apply/job', [ApplicantController::class, 'applyJob']);
        Route::post('apply/documents', [ApplicantController::class, 'documents']);
        Route::get('apply/view/status', [ApplicantController::class, 'status']);
        Route::get('apply/view/job', [ApplicantController::class, 'getJob']);
        Route::post('apply/logout', [ApplicantController::class, 'logout']);
    });

    Route::post('/employee/login', [EmployeeController::class, 'login']);
    Route::middleware('auth.employee')->group(function(){
        Route::get('/employee/schedules', [EmployeeController::class, 'schedules']);
        Route::get('/employee/profile', [EmployeeController::class, 'profile']);
        Route::get('/employee/attendance', [EmployeeController::class, 'attendance']);
        Route::post('/employee/attendance/time-in', [EmployeeController::class, 'time_in']);
        Route::post('/employee/attendance/time-out', [EmployeeController::class, 'time_out']);
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
