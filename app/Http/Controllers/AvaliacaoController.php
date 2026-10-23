<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Cuidador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\UniqueConstraintViolationException;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $cuidadores = Cuidador::all();

        $avaliacoes = Avaliacao::with(['cuidador', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->get();

        $mediaGeral = $avaliacoes->avg('nota') ?? 0;

        $totalAvaliacoes = $avaliacoes->count();

        return view('avaliacao.avaliacao', compact(
            'cuidadores',
            'avaliacoes',
            'mediaGeral',
            'totalAvaliacoes'
        ));
    }

    public function salvar(Request $request)
    {
        $dados = $request->validate([
            'id_cuidador' => 'required|exists:cuidadores,id',
            'nota' => 'required|numeric|min:0.5|max:5',
            'comentario' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        if (!$userId) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Faça login para avaliar.'
            ], 401);
        }

        // Verifica se o usuário já avaliou este cuidador
        $jaAvaliou = Avaliacao::where(
            'id_cuidador',
            $dados['id_cuidador']
        )
        ->where('user_id', $userId)
        ->exists();

        if ($jaAvaliou) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você já avaliou este cuidador.'
            ], 409);
        }

        try {

            // Registra uma nova avaliação
            $avaliacao = Avaliacao::create([
                'id_cuidador' => $dados['id_cuidador'],
                'user_id' => $userId,
                'nota' => $dados['nota'],
                'comentario' => $dados['comentario'],
            ]);

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Avaliação enviada com sucesso!',
                'avaliacao_id' => $avaliacao->id
            ], 201);

        } catch (UniqueConstraintViolationException $erro) {

            // Trata tentativas simultâneas de avaliação
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você já avaliou este cuidador.'
            ], 409);
        }
    }

    public function excluir($id)
    {
        $avaliacao = Avaliacao::findOrFail($id);

        // Apenas o autor pode excluir
        if ($avaliacao->user_id !== Auth::id()) {
            abort(403, 'Você não pode excluir esta avaliação.');
        }

        $avaliacao->delete();

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Avaliação excluída com sucesso!'
        ]);
    }
}
