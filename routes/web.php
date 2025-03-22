<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TaskController::class, 'index']);
Route::resource('tasks', TaskController::class);
Route::get('/recycle-bin', [TaskController::class, 'recycleBin'])->name('tasks.recycleBin');
Route::post('/tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
Route::delete('/tasks/{task}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');
