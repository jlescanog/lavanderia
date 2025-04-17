<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correoElectronico' => 'required|string|email|max:255|unique:clientes',
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $cliente  = Cliente::create([
            'nombre' => $request->nombre,
            'correoElectronico' => $request->correoElectronico,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($cliente);

        return response()->json(['message' => 'Cliente registrado exitosamente!'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correoElectronico' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $cliente = Cliente::where('correoElectronico', $credentials['correoElectronico'])->first();

        Auth::login($cliente);

        return response()->json([
            'Cliente' => $cliente,
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Desconectado con éxito']);
    }
}
