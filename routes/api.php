
<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PerfilMobileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvaliacaoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\AtendimentoController;
use App\Http\Controllers\Api\SuporteController;

// Usuário autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Teste da API
Route::get('/teste', function () {
    return response()->json([
        'sucesso' => true,
        'mensagem' => 'API do Vitalle funcionando!'
    ]);
});

// Login
Route::post('/login', [AuthController::class, 'login']);

// Rotas de avaliações e cuidadores
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [PerfilMobileController::class, 'mostrar']);
    Route::patch('/perfil', [PerfilMobileController::class, 'atualizar']);
    Route::put('/perfil/senha', [PerfilMobileController::class, 'senha']);

    // Suporte
    Route::post('/suporte', [SuporteController::class, 'armazenar']);

    // Pacientes
Route::get('/pacientes', [PacienteController::class, 'index']);
Route::post('/pacientes', [PacienteController::class, 'store']);
Route::put('/pacientes/{id}', [PacienteController::class, 'update']);
Route::delete('/pacientes/{id}', [PacienteController::class, 'destroy']);

// Atendimentos
Route::get('/atendimentos', [AtendimentoController::class, 'index']);
Route::post('/atendimentos', [AtendimentoController::class, 'store']);
Route::put('/atendimentos/{id}', [AtendimentoController::class, 'update']);

Route::patch('/atendimentos/{id}/cancelar', [AtendimentoController::class, 'cancelar']);
Route::patch('/atendimentos/{id}/iniciar', [AtendimentoController::class, 'iniciar']);
Route::patch('/atendimentos/{id}/concluir', [AtendimentoController::class, 'concluir']);


    // Listar avaliações
    Route::get('/avaliacoes', [AvaliacaoController::class, 'index']);

    // Listar cuidadores para o filtro
    Route::get('/cuidadores', [AvaliacaoController::class, 'cuidadores']);

    // Salvar avaliação
    Route::post('/avaliacoes', [AvaliacaoController::class, 'salvar']);

    // Excluir avaliação
    Route::delete('/avaliacoes/{id}', [AvaliacaoController::class, 'excluir']);

});
