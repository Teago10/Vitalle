<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Exibe a tela de cadastro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Registra um novo usuário no Vitalle.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados enviados pelo formulário.
        $dados = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],

            // Apenas responsável ou cuidador.
            // Administrador não pode ser criado pelo cadastro público.
            'tipo_usuario' => [
                'required',
                Rule::in(['responsavel', 'cuidador']),
            ],
        ]);

        // Criação do usuário.
        $user = User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password']),
            'tipo_usuario' => $dados['tipo_usuario'],
        ]);

        // Dispara o evento de registro.
        event(new Registered($user));

        // Realiza o login automaticamente.
        Auth::login($user);

        // Redireciona para o dashboard.
        return redirect(route('dashboard', absolute: false));
    }
}
