<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TimeLogController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::apiResource('/clients', ClientController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::apiResource('/projects', ProjectController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

    Route::apiResource('time-logs', TimeLogController::class);

    Route::get('/time-logs/report', [TimeLogController::class, 'report']);
    Route::post('/time-logs/start', [TimeLogController::class, 'startLog']);
    Route::post('/time-logs/end', [TimeLogController::class, 'endLog']);
    Route::get('/time-logs/export-pdf', [TimeLogController::class, 'exportPdf']);
});
