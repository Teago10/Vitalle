<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Cuidador;
use Illuminate\Http\Request;
use Illuminate\Database\UniqueConstraintViolationException;

class AvaliacaoController extends Controller
{
    // Listar avaliações e calcular estatísticas
    public function index(Request $request)
    {
        $avaliacoes = Avaliacao::with(['cuidador', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->get();

        $usuarioId = $request->user()?->id;

        $resultado = $avaliacoes->map(function ($avaliacao) use ($usuarioId) {
            return [
                'id' => $avaliacao->id,
                'id_cuidador' => $avaliacao->id_cuidador,
                'nome_cuidador' => $avaliacao->cuidador?->nome,
                'qualificacao' => $avaliacao->cuidador?->qualificacao,
                'nota' => (float) $avaliacao->nota,
                'comentario' => $avaliacao->comentario,
                'autor' => $avaliacao->usuario?->name ?? 'Usuário',
                'user_id' => $avaliacao->user_id,
                'minha_avaliacao' => $usuarioId !== null
                    && (int) $avaliacao->user_id === (int) $usuarioId,
                'data' => $avaliacao->created_at?->format('d/m/Y'),
            ];
        });

        return response()->json([
            'sucesso' => true,
            'media_geral' => round((float) ($avaliacoes->avg('nota') ?? 0), 1),
            'total_avaliacoes' => $avaliacoes->count(),
            'avaliacoes' => $resultado,
        ]);
    }

    // Listar cuidadores para o filtro do Flutter
    public function cuidadores()
    {
        $cuidadores = Cuidador::orderBy('nome')->get();

        $resultado = $cuidadores->map(function ($cuidador) {
            return [
                'id' => $cuidador->id,
                'nome' => $cuidador->nome,
                'qualificacao' => $cuidador->qualificacao,
            ];
        });

        return response()->json([
            'sucesso' => true,
            'cuidadores' => $resultado,
        ]);
    }

    // Publicar uma avaliação
    public function salvar(Request $request)
    {
        $dados = $request->validate([
            'id_cuidador' => ['required', 'exists:cuidadores,id'],
            'nota' => [
                'required',
                'numeric',
                'min:0.5',
                'max:5',
                function ($attribute, $value, $fail) {
                    if (fmod((float) $value * 2, 1.0) != 0.0) {
                        $fail('A nota deve variar de 0,5 em 0,5.');
                    }
                },
            ],
            'comentario' => ['required', 'string', 'max:1000'],
        ]);

        $usuarioId = $request->user()->id;

        // Impede que o mesmo usuário avalie
        // o mesmo cuidador mais de uma vez
        $jaAvaliou = Avaliacao::where('id_cuidador', $dados['id_cuidador'])
            ->where('user_id', $usuarioId)
            ->exists();

        if ($jaAvaliou) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você já avaliou este cuidador.',
            ], 409);
        }

        try {
            $avaliacao = Avaliacao::create([
                'id_cuidador' => $dados['id_cuidador'],
                'user_id' => $usuarioId,
                'nota' => $dados['nota'],
                'comentario' => $dados['comentario'],
            ]);

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Avaliação enviada com sucesso!',
                'avaliacao_id' => $avaliacao->id,
            ], 201);

        } catch (UniqueConstraintViolationException $erro) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você já avaliou este cuidador.',
            ], 409);
        }
    }

    // Excluir uma avaliação
    public function excluir(Request $request, $id)
    {
        $avaliacao = Avaliacao::findOrFail($id);

        // Apenas o autor pode excluir
        if ((int) $avaliacao->user_id !== (int) $request->user()->id) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Você não pode excluir esta avaliação.',
            ], 403);
        }

        $avaliacao->delete();

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Avaliação excluída com sucesso!',
        ]);
    }
}
