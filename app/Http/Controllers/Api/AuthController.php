<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $usuario = User::where('email', $dados['email'])->first();

        if (!$usuario || !Hash::check($dados['password'], $usuario->password)) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'E-mail ou senha incorretos.',
            ], 401);
        }

        $token = $usuario->createToken('vitalle-mobile')->plainTextToken;

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Login realizado com sucesso!',
            'token' => $token,
            'usuario' => [
                'id' => $usuario->id,
                'nome' => $usuario->name,
                'email' => $usuario->email,
            ],
        ]);
    }
}
