<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about')->with('name', 'Adel Shurrab');
});

Route::get('/tasks', function () {
    $tasks = DB::table('tasks')->orderBy('created_at', 'desc')->get();

    return view('tasks', compact('tasks'));
});

Route::post('/create', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    DB::table('tasks')->insert([
        'name' => $request->input('name'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect('/tasks')->with('success', 'Task created successfully.');
});

Route::get('/form', [FormController::class, 'show'])->name('form.show');
Route::post('/form', [FormController::class, 'store'])->name('form.store');
