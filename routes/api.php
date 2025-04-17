<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth:sanctum')->get('/user', function () {
    return Auth::user();  // Devuelve el usuario autenticado
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::apiResource('clientes', ClienteController::class);

    Route::apiResource('ordenes', OrdenController::class);
});

Route::post('/verify-email-code', [VerificationController::class, 'verify']);
