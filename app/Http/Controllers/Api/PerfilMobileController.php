<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class PerfilMobileController extends Controller
{
    public function mostrar(Request $request)
    {
        $user = $request->user();
        return response()->json(['sucesso' => true, 'usuario' => [
            'id' => $user->id, 'nome' => $user->name, 'email' => $user->email,
            'tipo_usuario' => $user->tipo_usuario,
        ]]);
    }

    public function atualizar(Request $request)
    {
        $user = $request->user();
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);
        $user->fill($dados);
        if ($user->isDirty('email')) $user->email_verified_at = null;
        $user->save();
        return $this->mostrar($request);
    }

    public function senha(Request $request)
    {
        $dados = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        $user = $request->user();
        $user->password = Hash::make($dados['password']);
        $user->save();
        return response()->json(['sucesso' => true, 'mensagem' => 'Senha atualizada com sucesso.']);
    }
}
