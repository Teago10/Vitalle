<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SolicitacaoSuporte;
use Illuminate\Http\Request;

class SuporteController extends Controller
{
    public function armazenar(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'assunto' => 'required|string|max:200',
            'mensagem' => 'required|string',
        ]);

        $solicitacao = SolicitacaoSuporte::create($dados);

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Solicitação enviada com sucesso!',
            'id' => $solicitacao->id,
        ], 201);
    }
}
