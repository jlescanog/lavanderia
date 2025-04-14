<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::apiResource('clientes', ClienteController::class);

    Route::apiResource('ordenes', OrdenController::class);
});

Route::post('/verify-email-code', [VerificationController::class, 'verify']);
