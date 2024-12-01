<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'list'])->name('tasks');
    Route::get('/task/{task}', [TaskController::class, 'viewTask'])->name('task');
    Route::post('/task/{task}', [TaskController::class, 'startTask'])->name('task');
    Route::get('/usertasks', [TaskController::class, 'userTasks'])->name('userTasks');

    Route::get('/usertask/{task}', [TaskController::class, 'userTask'])->name('userTask');

    Route::get('/createtask', [TaskController::class, 'viewCreateTask'])->name('createTask');
    Route::post('/createtask', [TaskController::class, 'createTask'])->name('createTask');

    Route::post('/updatestatus/{task}', [TaskController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/rejecttask/{task}', [TaskController::class, 'rejectTask'])->name('rejectTask');

    Route::get('/updatetask/{task}', [TaskController::class, 'viewUpdateTask'])->name('updateTask');
    Route::post('/updatetask/{task}', [TaskController::class, 'updateTask'])->name('updateTask');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
