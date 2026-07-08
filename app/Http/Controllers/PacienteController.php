<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Responsavel;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paciente = Paciente::all();
        return view('paciente', ['paciente' => $paciente]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $responsavel = Responsavel::orderBy('nome', 'ASC')->pluck('nome', 'id');

        return view('cadastro', [
            'responsaveis' => $responsavel,
            'paciente' => new Paciente()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_responsavel'      => 'required|exists:responsaveis,id',
            'nome'                => 'required|string|max:150',
            'data_nascimento'     => 'required|date',
            'comorbidade'         => 'nullable|string|max:200',
            'condicao_fisica'     => 'nullable|string|max:200',
            'usa_fraldas'         => 'nullable|boolean',
            'medicacao'           => 'nullable|string|max:200',
            'horario_medicacao'   => 'nullable|string|max:100',
            'rua'                 => 'required|string|max:200',
            'numero'              => 'required|string|max:20',
            'complemento'         => 'nullable|string|max:100',
            'bairro'              => 'required|string|max:100',
            'cidade'              => 'required|string|max:100',
            'estado'              => 'required|string|max:50',
            'cep'                 => 'required|string|max:10',
            'email'               => 'required|email|max:70|unique:pacientes,email',
        ]);

        $paciente = new Paciente();

        $paciente->id_responsavel     = $request->id_responsavel;
        $paciente->nome               = $request->nome;
        $paciente->data_nascimento    = $request->data_nascimento;
        $paciente->comorbidade        = $request->comorbidade;
        $paciente->condicao_fisica    = $request->condicao_fisica;
        $paciente->usa_fraldas        = $request->has('usa_fraldas');
        $paciente->medicacao          = $request->medicacao;
        $paciente->horario_medicacao  = $request->horario_medicacao;
        $paciente->rua                = $request->rua;
        $paciente->numero             = $request->numero;
        $paciente->complemento        = $request->complemento;
        $paciente->bairro             = $request->bairro;
        $paciente->cidade             = $request->cidade;
        $paciente->estado             = $request->estado;
        $paciente->cep                = $request->cep;
        $paciente->email              = $request->email;

        
        $paciente->save();

        return redirect()->route('admin.paciente.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
