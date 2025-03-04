<?php

use App\Http\Controllers\TaskManagmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    // API Routes
    Route::get('/tasks', [TaskManagmentController::class, 'index'])->name('tasks-api-index');
    Route::post('/tasks', [TaskManagmentController::class, 'store'])->name('tasks-api-store');
    Route::get('/tasks/{id}', [TaskManagmentController::class, 'show'])->name('tasks-api-show');
    Route::put('/tasks/{id}', [TaskManagmentController::class, 'update'])->name('tasks-api-update');
    Route::post('/tasks/{id}/complete', [TaskManagmentController::class, 'complete'])->name('tasks-api-complete');
    Route::delete('/tasks/{id}', [TaskManagmentController::class, 'destroy'])->name('tasks-api-delete');
});
