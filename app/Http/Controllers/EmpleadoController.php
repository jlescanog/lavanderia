<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Log;

class EmpleadoController extends Controller
{
    /**
     * Obtener la lista de todos los empleados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $empleados = Empleado::all();
            return response()->json($empleados);
        } catch (\Exception $e) {
            Log::error('Error al obtener empleados: ' . $e->getMessage());
            return response()->json(
                ['error' => 'Error al obtener la lista de empleados', 'mensaje' => $e->getMessage()], 
                500
            );
        }
    }
}
