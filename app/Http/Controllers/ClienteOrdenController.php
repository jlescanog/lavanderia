<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Orden;

class ClienteOrdenController extends Controller
{
    public function index()
    {
        $cliente = Auth::guard('clientes')->user();

        $ordenes = Orden::with(['detalles.prenda'])
            ->where('IdCliente', $cliente->idCliente)
            ->get()
            ->map(function ($orden) {
                return [
                    'id' => $orden->IdOrden,
                    'total' => $orden->PrecioTotal,
                    'estado' => $orden->Estado,
                    'fecha' => $orden->created_at ? $orden->created_at->format('d/m/Y H:i') : null,
                    'detalle_orden' => $orden->detalles->map(function ($detalle) {
                        return [
                            'nombre_prenda' => $detalle->prenda->TipoPrenda ?? 'Prenda eliminada',
                            'cantidad' => $detalle->Cantidad,
                            'peso' => $detalle->Peso,
                        ];
                    }),
                ];
            });

        return response()->json($ordenes);
    }
}
