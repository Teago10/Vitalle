<?php

use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitacaoSuporteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::view('/', 'inicio')->name('inicio');


// rotas do paciente

Route::get('/dashboard/paciente', [PacienteController::class, 'index'])->name('admin.paciente.index');

Route::get('/dashboard/cadastro', [PacienteController::class, 'create'])->name('profile.paciente.cadastrar');

Route::post('/dashboard/cadastro', [PacienteController::class, 'store'])->name('profile.paciente.armazenar');

Route::get('/dashboard/atendimento/cadastro', [AtendimentoController::class, 'create'])
    ->name('atendimento.cadastro');

Route::middleware('auth')->group(function () {

    // Exibir avaliações
    Route::get('/dashboard/avaliacao', [AvaliacaoController::class, 'index'])
        ->name('avaliacao.index');

    // Enviar avaliação
    Route::post('/dashboard/avaliacao/salvar', [AvaliacaoController::class, 'salvar'])
        ->name('avaliacao.salvar');

    // Excluir avaliação
    Route::delete('/dashboard/avaliacao/{id}', [AvaliacaoController::class, 'excluir'])
        ->name('avaliacao.excluir');
});

// Rotas de atendimento
Route::get('/dashboard/atendimento/cadastro', [AtendimentoController::class, 'create'])
    ->name('atendimento.cadastro');

Route::post('/dashboard/atendimento/cadastro', [AtendimentoController::class, 'store'])
    ->name('atendimento.armazenar');

Route::get('/dashboard/atendimento', [AtendimentoController::class, 'index'])
    ->name('atendimento.index');

// Editar atendimento
Route::get('/dashboard/atendimento/editar/{id}', [AtendimentoController::class, 'edit'])
    ->name('atendimento.editar');

// Salvar alterações
Route::put('/dashboard/atendimento/editar/{id}', [AtendimentoController::class, 'update'])
    ->name('atendimento.atualizar');

// Cancelar atendimento
Route::patch('/dashboard/atendimento/cancelar/{id}', [AtendimentoController::class, 'cancelar'])
    ->name('atendimento.cancelar');

Route::patch('/dashboard/atendimento/iniciar/{id}', [AtendimentoController::class, 'iniciar'])
    ->name('atendimento.iniciar');

//Concluir atendimento
Route::patch('/dashboard/atendimento/concluir/{id}', [AtendimentoController::class, 'concluir'])
    ->name('atendimento.concluir');



Route::get(
    '/dashboard/editar/{id}',
    [PacienteController::class, 'edit']
)->name('profile.paciente.editar');

Route::put(
    '/dashboard/editar/{id}',
    [PacienteController::class, 'update']
)->name('profile.paciente.atualizar');

Route::delete('/dashboard/cadastro/{id}', [PacienteController::class, 'destroy'])->name('profile.paciente.excluir');

// Suporte
Route::get('/dashboard/suporte', [SolicitacaoSuporteController::class, 'index'])
    ->name('suporte.index');

Route::post('/dashboard/suporte', [SolicitacaoSuporteController::class, 'armazenar'])
    ->name('suporte.armazenar');

// rotas padrão
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
