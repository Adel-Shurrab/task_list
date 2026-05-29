<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-method-1', function () {
    return view('about')->with('name', 'John Doe');
});

Route::get('/about-method-2', function () {
    return view('about', [
        'name' => 'Jane Smith',
    ]);
});

Route::get('/about-method-3', function () {
    $name = 'Mike Johnson';
    $email = 'mike@example.com';
    $age = 35;

    return view('about', compact('name', 'email', 'age'));
});

Route::get('/about', function () {
    return view('about')->with('name', 'Laravel Developer');
});

Route::get('/form', [FormController::class, 'show'])->name('form.show');
Route::post('/form', [FormController::class, 'store'])->name('form.store');
