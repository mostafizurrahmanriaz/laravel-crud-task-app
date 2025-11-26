<?php

use App\Http\Controllers\TaskController;
use App\Models\task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tasks = task::paginate(5);
    return view('home', compact('tasks'));
});

Route::get('/tasks/filter', [TaskController::class, 'searchTask'])->name('task.search');

Route::resource('tasks', TaskController::class);