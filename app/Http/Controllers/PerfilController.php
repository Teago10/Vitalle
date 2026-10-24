<?php

namespace App\Http\Controllers;

use App\Models\Cuidador;
use App\Models\Responsavel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PerfilController extends Controller
{
    /**
     * Exibe o formulário para completar o perfil.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $usuario = $request->user();

        // Administradores não precisam completar perfil.
        if ($usuario->tipo_usuario === 'admin') {
            return redirect()->route('dashboard');
        }

        // Impede o preenchimento de um segundo perfil.
        if ($this->perfilExiste($usuario)) {
            return redirect()->route('dashboard');
        }

        abort_unless(
            in_array($usuario->tipo_usuario, ['cuidador', 'responsavel'], true),
            403
        );

        return view('perfil.completar', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Valida e salva o perfil do usuário autenticado.
     */
    public function store(Request $request): RedirectResponse
    {
        $usuario = $request->user();

        abort_unless(
            in_array($usuario->tipo_usuario, ['cuidador', 'responsavel'], true),
            403
        );

        if ($this->perfilExiste($usuario)) {
            return redirect()->route('dashboard');
        }

        $ehCuidador = $usuario->tipo_usuario === 'cuidador';

        // Os cuidadores podem deixar o endereço vazio.
        // Os responsáveis precisam preencher o endereço.
        $regraEndereco = $ehCuidador ? 'nullable' : 'required';

        $dados = $request->validate([
            'telefone' => [
                'required',
                'string',
                'max:20',
            ],

            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('cuidadores', 'cpf'),
                Rule::unique('responsaveis', 'cpf'),
            ],

            'qualificacao' => [
                'nullable',
                'string',
                'max:150',
            ],

            'rua' => [
                $regraEndereco,
                'string',
                'max:200',
            ],

            'numero' => [
                $regraEndereco,
                'string',
                'max:20',
            ],

            'complemento' => [
                'nullable',
                'string',
                'max:' . ($ehCuidador ? 50 : 100),
            ],

            'bairro' => [
                $regraEndereco,
                'string',
                'max:100',
            ],

            'cidade' => [
                $regraEndereco,
                'string',
                'max:100',
            ],

            'estado' => [
                $regraEndereco,
                'string',
                'max:50',
            ],

            'cep' => [
                $regraEndereco,
                'string',
                'max:10',
            ],
        ]);

        DB::transaction(function () use ($usuario, $dados, $ehCuidador) {

            $perfil = [
                'user_id' => $usuario->id,
                'nome' => $usuario->name,
                'email' => $usuario->email,
                'telefone' => $dados['telefone'],
                'cpf' => $dados['cpf'],
                'rua' => $dados['rua'] ?? null,
                'numero' => $dados['numero'] ?? null,
                'complemento' => $dados['complemento'] ?? null,
                'bairro' => $dados['bairro'] ?? null,
                'cidade' => $dados['cidade'] ?? null,
                'estado' => $dados['estado'] ?? null,
                'cep' => $dados['cep'] ?? null,
            ];

            if ($ehCuidador) {

                $perfil['qualificacao'] = $dados['qualificacao'] ?? null;

                Cuidador::create($perfil);

            } else {

                Responsavel::create($perfil);

            }
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Seu cadastro foi concluído com sucesso!');
    }

    /**
     * Verifica se o usuário já possui um perfil.
     */
    private function perfilExiste($usuario): bool
    {
        return match ($usuario->tipo_usuario) {
            'cuidador' => $usuario->cuidador()->exists(),
            'responsavel' => $usuario->responsavel()->exists(),
            default => false,
        };
    }
}
