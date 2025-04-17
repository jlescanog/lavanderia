<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages/home');
    });

    Route::get('/formOrders', function () {
        return view('pages/formOrders');
    });

    Route::get('/managementOrders', function () {
        return view('pages/managementOrders');
    });

    Route::get('/api/user', function () {
        return response()->json(Auth::user());
    });
});

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

Route::get('/register', function () {
    return view('auth/register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/prendaForm', function () {
    return view('pages/prendaForm');
});
