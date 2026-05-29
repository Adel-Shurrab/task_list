<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about')->with('name', 'Adel Shurrab');
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/edit/{id}', [TaskController::class, 'edit']);
Route::post('/update/{id}', [TaskController::class, 'update']);
Route::post('/create', [TaskController::class, 'create']);
Route::post('/delete/{id}', [TaskController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/edit/{id}', [UserController::class, 'edit']);
Route::post('/users/update/{id}', [UserController::class, 'update']);
Route::post('/users/create', [UserController::class, 'create']);
Route::post('/users/delete/{id}', [UserController::class, 'destroy']);

Route::get('/form', [FormController::class, 'show'])->name('form.show');
Route::post('/form', [FormController::class, 'store'])->name('form.store');
