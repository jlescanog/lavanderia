<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'IdCliente' => 'required|exists:clientes,id',
            'IdEmpleado' => 'required|exists:empleados,id',
            'FechaOrden' => 'required|date',
            'Estado' => 'required|string',
            'PrecioTotal' => 'required|numeric',
            'ACuenta' => 'required|numeric',
            'Saldo' => 'required|numeric',
        ]);

        // Crear nueva orden
        $orden = Orden::create([
            'IdCliente' => $request->IdCliente,
            'IdEmpleado' => $request->IdEmpleado,
            'FechaOrden' => $request->FechaOrden,
            'Estado' => $request->Estado,
            'PrecioTotal' => $request->PrecioTotal,
            'ACuenta' => $request->ACuenta,
            'Saldo' => $request->Saldo,
        ]);

        return response()->json(['message' => 'Orden creada con éxito', 'orden' => $orden], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
