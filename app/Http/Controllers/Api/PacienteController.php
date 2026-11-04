<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $usuario = $request->user();

        $consulta = Paciente::with('responsavel')
            ->orderBy('nome', 'asc');

        if ($usuario->tipo_usuario === 'responsavel') {
            $responsavel = $usuario->responsavel;

            if (!$responsavel) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Perfil de responsável não encontrado.',
                ], 403);
            }

            $consulta->where('id_responsavel', $responsavel->id);
        } elseif ($usuario->tipo_usuario !== 'admin') {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você não tem permissão para listar pacientes.',
            ], 403);
        }

        $pacientes = $consulta->get();

        return response()->json([
            'sucesso' => true,
            'total' => $pacientes->count(),
            'pacientes' => $pacientes,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $usuario = $request->user();

        if ($usuario->tipo_usuario !== 'responsavel') {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Somente responsáveis podem cadastrar pacientes.',
            ], 403);
        }

        $responsavel = $usuario->responsavel;

        if (!$responsavel) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Complete seu perfil de responsável antes de cadastrar pacientes.',
            ], 403);
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'data_nascimento' => 'required|date',
            'comorbidade' => 'nullable|string|max:200',
            'condicao_fisica' => 'nullable|string|max:200',
            'usa_fraldas' => 'nullable|boolean',
            'medicacao' => 'nullable|string|max:200',
            'horario_medicacao' => 'nullable|string|max:100',
            'rua' => 'required|string|max:200',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:50',
            'cep' => 'required|string|max:10',
            'email' => 'required|email|max:70|unique:pacientes,email',
        ]);

        $paciente = new Paciente();

        // O vínculo é definido pelo usuário autenticado.
        $paciente->id_responsavel = $responsavel->id;

        $paciente->nome = $dados['nome'];
        $paciente->data_nascimento = $dados['data_nascimento'];
        $paciente->comorbidade = $dados['comorbidade'] ?? null;
        $paciente->condicao_fisica = $dados['condicao_fisica'] ?? null;
        $paciente->usa_fraldas = $dados['usa_fraldas'] ?? false;
        $paciente->medicacao = $dados['medicacao'] ?? null;
        $paciente->horario_medicacao = $dados['horario_medicacao'] ?? null;
        $paciente->rua = $dados['rua'];
        $paciente->numero = $dados['numero'];
        $paciente->complemento = $dados['complemento'] ?? null;
        $paciente->bairro = $dados['bairro'];
        $paciente->cidade = $dados['cidade'];
        $paciente->estado = $dados['estado'];
        $paciente->cep = $dados['cep'];
        $paciente->email = $dados['email'];

        $paciente->save();

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Paciente cadastrado com sucesso!',
            'paciente' => $paciente->load('responsavel'),
        ], 201);
    }
    
public function update(Request $request, string $id): JsonResponse
{
    $usuario = $request->user();

    $paciente = Paciente::findOrFail($id);

    if ($usuario->tipo_usuario === 'responsavel') {
        $responsavel = $usuario->responsavel;

        if (!$responsavel || $paciente->id_responsavel !== $responsavel->id) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você não tem permissão para editar este paciente.',
            ], 403);
        }
    } elseif ($usuario->tipo_usuario !== 'admin') {
        return response()->json([
            'sucesso' => false,
            'mensagem' => 'Você não tem permissão para editar pacientes.',
        ], 403);
    }

    $dados = $request->validate([
        'nome' => 'required|string|max:150',
        'data_nascimento' => 'required|date',
        'comorbidade' => 'nullable|string|max:200',
        'condicao_fisica' => 'nullable|string|max:200',
        'usa_fraldas' => 'nullable|boolean',
        'medicacao' => 'nullable|string|max:200',
        'horario_medicacao' => 'nullable|string|max:100',
        'rua' => 'required|string|max:200',
        'numero' => 'required|string|max:20',
        'complemento' => 'nullable|string|max:100',
        'bairro' => 'required|string|max:100',
        'cidade' => 'required|string|max:100',
        'estado' => 'required|string|max:50',
        'cep' => 'required|string|max:10',
        'email' => 'required|email|max:70|unique:pacientes,email,' . $paciente->id,
    ]);

    foreach ($dados as $campo => $valor) {
        $paciente->{$campo} = $valor;
    }

    $paciente->usa_fraldas = $dados['usa_fraldas'] ?? false;

    $paciente->save();

    return response()->json([
        'sucesso' => true,
        'mensagem' => 'Paciente atualizado com sucesso!',
        'paciente' => $paciente->load('responsavel'),
    ]);
}

public function destroy(Request $request, string $id): JsonResponse
{
    $usuario = $request->user();

    $paciente = Paciente::findOrFail($id);

    if ($usuario->tipo_usuario === 'responsavel') {
        $responsavel = $usuario->responsavel;

        if (!$responsavel || $paciente->id_responsavel !== $responsavel->id) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você não tem permissão para excluir este paciente.',
            ], 403);
        }
    } elseif ($usuario->tipo_usuario !== 'admin') {
        return response()->json([
            'sucesso' => false,
            'mensagem' => 'Você não tem permissão para excluir pacientes.',
        ], 403);
    }

    // Impede a exclusão de pacientes com atendimentos vinculados.
    if ($paciente->atendimentos()->exists()) {
        return response()->json([
            'sucesso' => false,
            'mensagem' => 'Este paciente possui atendimentos vinculados e não pode ser excluído.',
        ], 409);
    }

    $paciente->delete();

    return response()->json([
        'sucesso' => true,
        'mensagem' => 'Paciente excluído com sucesso!',
    ]);
}

}
