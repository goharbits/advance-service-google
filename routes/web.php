<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
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

Route::get('/test', function () {
    return view('welcome2');
});




Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // This will create routes for index, create, store, show, edit, update, and destroy actions
    Route::resource('projects', ProjectController::class);

    // Resource routes for TaskController
    // This will create routes for index, create, store, show, edit, update, and destroy actions
    Route::resource('tasks', TaskController::class);

    // Custom route to update task priority via a POST request
Route::post('update-task-priority', [TaskController::class, 'updateTaskPriority'])->name('update.task.priority');

});


require __DIR__.'/auth.php';