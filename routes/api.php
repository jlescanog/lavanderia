<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DniController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteOrdenController;

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('ordenes', OrdenController::class);

Route::get('/ordenes/pendientes', [OrdenController::class, 'obtenerPendientes']);

Route::put('/ordenes/{id}/estado', [OrdenController::class, 'actualizarEstado']);

Route::delete('/ordenes/{id}', [OrdenController::class, 'destroy']);

Route::middleware(['web', 'auth:clientes'])->get('/cliente/ordenes', [ClienteOrdenController::class, 'index']);

// Ruta para consultar DNI
Route::get('/consultar-dni', [DniController::class, 'consultarDni']);

// Rutas para exportación
Route::get('/exportar/ordenes/excel', [ExportController::class, 'exportarOrdenesExcel']);
Route::get('/exportar/ordenes/pdf', [ExportController::class, 'exportarOrdenesPDF']);
