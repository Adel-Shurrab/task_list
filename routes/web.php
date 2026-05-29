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
    $tasks = DB::table('tasks')->get();

    return view('tasks', compact('tasks'));
});

Route::get('/edit/{id}', function (int $id) {
    $tasks = DB::table('tasks')->get();
    $task = DB::table('tasks')->where('id', $id)->first();

    if (!$task) {
        abort(404);
    }

    return view('tasks', compact('tasks', 'task'));
});

Route::post('/update', function (Request $request) {
    $request->validate([
        'id' => 'required|integer|exists:tasks,id',
        'name' => 'required|string|max:255',
    ]);

    DB::table('tasks')
        ->where('id', $request->input('id'))
        ->update([
            'name' => $request->input('name'),
            'updated_at' => now(),
        ]);

    return redirect('/tasks')->with('success', 'Task updated successfully.');
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

    return redirect('tasks')->with('success', 'Task created successfully.');
});

Route::post('/delete/{id}', function (int $id) {
    DB::table('tasks')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Task deleted successfully.');
});

Route::get('/form', [FormController::class, 'show'])->name('form.show');
Route::post('/form', [FormController::class, 'store'])->name('form.store');
