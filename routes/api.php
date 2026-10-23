
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvaliacaoController;

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

    // Listar avaliações
    Route::get('/avaliacoes', [AvaliacaoController::class, 'index']);

    // Listar cuidadores para o filtro
    Route::get('/cuidadores', [AvaliacaoController::class, 'cuidadores']);

    // Salvar avaliação
    Route::post('/avaliacoes', [AvaliacaoController::class, 'salvar']);

    // Excluir avaliação
    Route::delete('/avaliacoes/{id}', [AvaliacaoController::class, 'excluir']);

});
