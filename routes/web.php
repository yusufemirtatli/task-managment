<?php

use App\Http\Controllers\TaskManagmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(\route('tasks-index'));
});

//******************************** AUTH MİDDLEWARE ****************************************
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
//********************************** MY ROUTES *******************************************
Route::get('/tasks',[TaskManagmentController::class,'index'])->name('tasks-index');
Route::get('/tasks/create', [TaskManagmentController::class, 'create'])->name('tasks-add');
Route::post('/tasks/store', [TaskManagmentController::class, 'store'])->name('tasks-store');
Route::get('/tasks/{id}/edit', [TaskManagmentController::class, 'edit'])->name('tasks-edit');
Route::put('/tasks/{id}/update', [TaskManagmentController::class, 'update'])->name('tasks-update');
Route::post('/tasks/{id}/complete', [TaskManagmentController::class, 'complete'])->name('tasks-complete');
Route::post('/tasks/{id}/delete', [TaskManagmentController::class, 'destroy'])->name('tasks-delete');

});
