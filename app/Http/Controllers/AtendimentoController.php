<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Cuidador;
use App\Models\Atendimento;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function index()
    {
        $atendimentos = Atendimento::with(['paciente', 'cuidador'])
            ->orderBy('data_atendimento', 'ASC')
            ->get();

        return view('atendimento.index', [
            'atendimentos' => $atendimentos
        ]);
    }

    public function create()
    {
        $pacientes = Paciente::orderBy('nome', 'ASC')->get();
        $cuidadores = Cuidador::orderBy('nome', 'ASC')->get();

        return view('atendimento.cadastro', [
            'pacientes' => $pacientes,
            'cuidadores' => $cuidadores
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required',
            'id_cuidador' => 'nullable',
            'data_atendimento' => 'required|date',
            'horario_inicio' => 'required',
            'horario_fim' => 'required',
            'tipo_jornada' => 'required',
            'valor' => 'required',
        ]);

        Atendimento::create([
            'id_paciente' => $request->id_paciente,
            'id_cuidador' => $request->id_cuidador,
            'data_atendimento' => $request->data_atendimento,
            'horario_inicio' => $request->horario_inicio,
            'horario_fim' => $request->horario_fim,
            'tipo_jornada' => $request->tipo_jornada,
            'valor' => str_replace(',', '.', str_replace('R$ ', '', $request->valor)),
            'status' => 'ABERTO',
        ]);

        return redirect()
            ->route('atendimento.cadastro')
            ->with('sucesso', 'Atendimento solicitado com sucesso!');
    }

    // Exibir formulário de edição
    public function edit($id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'ABERTO') {
            return redirect()
                ->route('atendimento.index')
                ->with('erro', 'Somente atendimentos abertos podem ser editados.');
        }

        $pacientes = Paciente::orderBy('nome')->get();
        $cuidadores = Cuidador::orderBy('nome')->get();

        return view('atendimento.editar', compact(
            'atendimento',
            'pacientes',
            'cuidadores'
        ));
    }

    // Salvar alterações
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_paciente' => 'required|exists:pacientes,id',
            'id_cuidador' => 'nullable|exists:cuidadores,id',
            'data_atendimento' => 'required|date',
            'horario_inicio' => 'required',
            'horario_fim' => 'required',
            'tipo_jornada' => 'required',
            'valor' => 'required',
        ]);

        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'ABERTO') {
            return redirect()
                ->route('atendimento.index')
                ->with('erro', 'Somente atendimentos abertos podem ser editados.');
        }

        $atendimento->update([
            'id_paciente' => $request->id_paciente,
            'id_cuidador' => $request->id_cuidador,
            'data_atendimento' => $request->data_atendimento,
            'horario_inicio' => $request->horario_inicio,
            'horario_fim' => $request->horario_fim,
            'tipo_jornada' => $request->tipo_jornada,
            'valor' => str_replace(',', '.', str_replace('R$ ', '', $request->valor)),
        ]);

        return redirect()
            ->route('atendimento.index')
            ->with('sucesso', 'Atendimento atualizado com sucesso!');
    }

    // Cancelar atendimento
    public function cancelar($id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'ABERTO') {
            return redirect()
                ->route('atendimento.index')
                ->with('erro', 'Somente atendimentos abertos podem ser cancelados.');
        }

        $atendimento->status = 'CANCELADO';
        $atendimento->save();

        return redirect()
            ->route('atendimento.index')
            ->with('sucesso', 'Atendimento cancelado com sucesso!');
    }

    // Iniciar atendimento
    public function iniciar($id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'ABERTO') {
            return redirect()
                ->route('atendimento.index')
                ->with('erro', 'Somente atendimentos abertos podem ser iniciados.');
        }

        $atendimento->status = 'EM_ANDAMENTO';
        $atendimento->save();

        return redirect()
            ->route('atendimento.index')
            ->with('sucesso', 'Atendimento iniciado com sucesso!');
    }

    // Concluir atendimento
    public function concluir($id)
    {
        $atendimento = Atendimento::findOrFail($id);

        if ($atendimento->status !== 'EM_ANDAMENTO') {
            return redirect()
                ->route('atendimento.index')
                ->with('erro', 'Somente atendimentos em andamento podem ser concluídos.');
        }

        $atendimento->status = 'CONCLUIDO';
        $atendimento->save();

        return redirect()
            ->route('atendimento.index')
            ->with('sucesso', 'Atendimento concluído com sucesso!');
    }
}
