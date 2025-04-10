<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrdenController;
use Illuminate\Support\Facades\Route;

Route::apiResource('clientes', ClienteController::class);

Route::post('/ordenes', [OrdenController::class, 'store']);
