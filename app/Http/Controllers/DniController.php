<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DniController extends Controller
{
    public function consultarDni(Request $request)
    {
        $request->validate([
            'numero' => 'required|digits:8',
        ]);

        $numero = $request->numero;
        $token = env('RENIEC_API_TOKEN', 'apis-token-14561.IYteIbJWL9xZJRzglrhctzQNWLGXWIbt');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get("https://api.apis.net.pe/v2/reniec/dni?numero={$numero}");

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json([
                    'error' => 'No se pudo encontrar información con ese DNI',
                    'details' => $response->body()
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al consultar el DNI',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
