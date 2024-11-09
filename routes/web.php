<?php

use App\Http\Controllers\_SiteController;
use App\Http\Controllers\Admin\PriorityController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', _SiteController::class)->name('index');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::resource('/users', UserController::class)->except(['show'])->names('admin.users');

    Route::resource('/statuses', StatusController::class)->except(['show'])->names('admin.statuses');

    Route::resource('/priorities', PriorityController::class)->except(['show'])->names('admin.priorities');
});

Route::middleware('auth')->group(function () {

    Route::resource('/projects', ProjectController::class)->names('projects');
    Route::get('/projects/add-task/{project}/',[ProjectController::class,'addTask'])->name('projects.add-task');
    Route::post('/projects/add-task',[ProjectController::class,'saveTask'])->name('projects.save-task');

    Route::resource('/tasks', TaskController::class)->names('tasks');
    
    Route::get('/deadlines', [_SiteController::class,'deadLines'])->name('deadlines');
    
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [_SiteController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
