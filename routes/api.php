<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::prefix('tasks')->middleware('auth:sanctum')->group(function () {
    Route::resource('', TasksController::class);
    Route::get('/status/{status}', [TasksController::class, 'getStatusTasks']);
    Route::get('/priority/{priority}', [TasksController::class, 'getPeriorityTasks']);
    Route::post('/{task}/mark_completed', [TasksController::class, 'markAsCompleted']);
    Route::post('/{task}/mark_inprogress', [TasksController::class, 'markAsinProgress']);
});

Route::prefix('expenses')->middleware('auth:sanctum')->group(function () {
    Route::resource('', ExpensesController::class);
    Route::get('/{expenses}', [ExpensesController::class, 'show']);
    Route::put('/{expenses}', [ExpensesController::class, 'update']);
    Route::delete('/{expenses}', [ExpensesController::class, 'destroy']);
});
