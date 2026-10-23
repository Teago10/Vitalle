<?php

namespace App\Http\Controllers;

use App\Models\SolicitacaoSuporte;
use Illuminate\Http\Request;

class SolicitacaoSuporteController extends Controller
{
    public function index()
    {
        $solicitacoes = SolicitacaoSuporte::latest()->get();

        return view('suporte_page.suporte', [
            'solicitacoes' => $solicitacoes
        ]);
    }

    public function armazenar(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'assunto' => 'required|string|max:200',
            'mensagem' => 'required|string',
        ]);

        SolicitacaoSuporte::create($dados);

        return redirect()
            ->route('suporte.index')
            ->with('sucesso', 'Solicitação enviada com sucesso!');
    }
}
