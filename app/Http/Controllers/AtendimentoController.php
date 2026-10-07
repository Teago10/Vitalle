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
}