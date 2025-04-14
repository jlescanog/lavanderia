<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('pages/app');
})->name('login');


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages/app');
    });
});
