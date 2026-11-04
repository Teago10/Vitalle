<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Atendimento;
use App\Models\Paciente;
use App\Models\Cuidador;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function index()
    {
        $atendimentos = Atendimento::with([
            'paciente:id,nome',
            'cuidador:id,nome',
        ])
            ->orderBy('data_atendimento', 'asc')
            ->get();

        return response()->json([
            'sucesso' => true,
            'atendimentos' => $atendimentos,
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id',
            'id_cuidador' => 'nullable|exists:cuidadores,id',
            'data_atendimento' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fim' => 'required|date_format:H:i',
            'tipo_jornada' => 'required|in:12h_dia,12h_noite,6h,cuidado_avulso',
            'valor' => 'required|numeric|min:0',
        ]);

        $dados['status'] = 'ABERTO';

        $atendimento = Atendimento::create($dados);
        $atendimento->load(['paciente:id,nome', 'cuidador:id,nome']);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Atendimento solicitado com sucesso!',
            'atendimento' => $atendimento,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'ABERTO') {
            return response()->json([
                'mensagem' => 'Somente atendimentos abertos podem ser editados.',
            ], 422);
        }

        $dados = $request->validate([
            'id_paciente' => 'required|exists:pacientes,id',
            'id_cuidador' => 'nullable|exists:cuidadores,id',
            'data_atendimento' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
            'horario_fim' => 'required|date_format:H:i',
            'tipo_jornada' => 'required|in:12h_dia,12h_noite,6h,cuidado_avulso',
            'valor' => 'required|numeric|min:0',
        ]);

        $atendimento->update($dados);
        $atendimento->load(['paciente:id,nome', 'cuidador:id,nome']);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Atendimento atualizado com sucesso!',
            'atendimento' => $atendimento,
        ]);
    }

    public function cancelar($id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'ABERTO') {
            return response()->json([
                'mensagem' => 'Somente atendimentos abertos podem ser cancelados.',
            ], 422);
        }

        $atendimento->update(['status' => 'CANCELADO']);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Atendimento cancelado com sucesso!',
        ]);
    }

    public function iniciar($id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'ABERTO') {
            return response()->json([
                'mensagem' => 'Somente atendimentos abertos podem ser iniciados.',
            ], 422);
        }

        $atendimento->update(['status' => 'EM_ANDAMENTO']);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Atendimento iniciado com sucesso!',
        ]);
    }

    public function concluir($id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'EM_ANDAMENTO') {
            return response()->json([
                'mensagem' => 'Somente atendimentos em andamento podem ser concluídos.',
            ], 422);
        }

        $atendimento->update(['status' => 'CONCLUIDO']);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Atendimento concluído com sucesso!',
        ]);
    }
}
