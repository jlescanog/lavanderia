<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Orden::with([
            'cliente',
            'detalles.prenda',
            'detalles.servicioLavado',
            'detalles.servicioPlanchado'
        ]);

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('FechaOrden', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('FechaOrden', '<=', $request->fecha_fin);
        }

        $ordenes = $query->get()->map(function ($orden) {
            $detallesAgrupados = [];

            foreach ($orden->detalles as $detalle) {
                $key = $detalle->prenda_id . '-' . $detalle->cantidad . '-' . $detalle->color;

                if (!isset($detallesAgrupados[$key])) {
                    $detallesAgrupados[$key] = [
                        'prenda' => $detalle->prenda->nombre,
                        'cantidad' => $detalle->cantidad,
                        'color' => $detalle->color,
                        'servicio_lavado' => null,
                        'servicio_planchado' => null,
                    ];
                }

                if ($detalle->tipo_servicio === 'lavado') {
                    $detallesAgrupados[$key]['servicio_lavado'] = $detalle->servicio->nombre;
                }

                if ($detalle->tipo_servicio === 'planchado') {
                    $detallesAgrupados[$key]['servicio_planchado'] = $detalle->servicio->nombre;
                }
            }

            $orden->detalles = array_values($detallesAgrupados);
            return $orden;
        });

        return response()->json($ordenes);
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

        if ($request->expectsJson()) {
            Log::info("✅ Recibiendo JSON:", $request->all());
        } else {
            Log::warning("⚠️ Recibí algo que no es JSON");
        }
        // Validación básica del JSON
        $request->validate([
            'orden.cliente_id' => 'required|exists:clientes,idCliente',
            'orden.tipo_documento_id' => 'required|exists:tipos_documentos,IdTipoDocumento',
            'orden.total' => 'required|numeric',
            'orden.detalle_orden' => 'required|array|min:1',
            'orden.pago.metodo_pago' => 'required|string',
            'orden.pago.monto_pagado' => 'required|numeric',
            'orden.pago.estado' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Crear la orden
            $orden = Orden::create([
                'IdCliente' => $request->orden['cliente_id'],
                'IdEmpleado' => 1, // Ajusta esto según tu sistema de usuarios
                'FechaOrden' => now(),
                'Estado' => 'pendiente',
                'PrecioTotal' => $request->orden['total'],
                'ACuenta' => $request->orden['pago']['monto_pagado'],
                'Saldo' => $request->orden['total'] - $request->orden['pago']['monto_pagado'],
            ]);

            // Crear los detalles (ahora uno solo por prenda)
            foreach ($request->orden['detalle_orden'] as $detalle) {

                DetalleOrden::create([
                    'IdOrden' => $orden->IdOrden,
                    'IdPrenda' => $detalle['prenda_id'],
                    'Cantidad' => $detalle['cantidad'],
                    'Peso' => $detalle['peso'],
                    'IdServicioLavado' => $detalle['servicio_lavado_id'],
                    'IdServicioPlanchado' => $detalle['servicio_planchado_id'],
                ]);
            }

            // Guardar el pago
            Pago::create([
                'IdOrden' => $orden->IdOrden,
                'MetodoPago' => $request->orden['pago']['metodo_pago'],
                'MontoPagado' => $request->orden['pago']['monto_pagado'],
                'Estado' => $request->orden['pago']['estado'],
                'IdTipoDocumento' => $request->orden['tipo_documento_id'],
                'NumDocumento' => $request->orden['pago']['num_documento'],
                'FechaPago' => now()
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Orden registrada correctamente',
                'orden_id' => $orden->IdOrden
            ], 201);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'error' => 'Error al guardar la orden',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


    public function obtenerPendientes()
    {
        $ordenes = Orden::with(['detalles'])
            ->where('estado', 'pendiente')
            ->get();

        return response()->json($ordenes);
    }

    public function actualizarEstado(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);
        $orden->Estado = $request->estado;
        $orden->save();

        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'nuevo_estado' => $orden->Estado
        ]);
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
    public function destroy($id)
    {
        $orden = Orden::find($id);
        if ($orden) {
            $orden->delete();
            return response()->json(['message' => 'Orden eliminada correctamente']);
        } else {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }
    }
}
