<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{uuid}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{uuid}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/{uuid}', [TaskController::class, 'findByUuid'])->name('tasks.findByUuid');

