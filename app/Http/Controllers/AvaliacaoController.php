<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Cuidador;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
  
    public function index()
{
    $cuidadores = Cuidador::all();

    $avaliacoes = Avaliacao::all()->keyBy('id_cuidador');

    return view('avaliacao.avaliacao', compact('cuidadores', 'avaliacoes'));
}


    public function salvar(Request $request)
    {
        $request->validate([
            'id_cuidador' => 'required|exists:cuidadores,id',
            'nota' => 'required|numeric|min:0.5|max:5',
        ]);


        Avaliacao::updateOrCreate(
    [
        'id_cuidador' => $request->id_cuidador,
    ],
    [
        'nota' => $request->nota,
    ]
);


        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Avaliação salva com sucesso!'
        ]);
    }
}