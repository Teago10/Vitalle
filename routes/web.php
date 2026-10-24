<?php

use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitacaoSuporteController;
use App\Http\Middleware\VerificarPerfilCompleto;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/

Route::view('/', 'inicio')->name('inicio');

/*
|--------------------------------------------------------------------------
| Completar perfil
|--------------------------------------------------------------------------
|
| Estas rotas exigem autenticação, mas não exigem
| perfil completo. Isso evita redirecionamentos infinitos.
|
*/

Route::middleware('auth')->group(function () {

    Route::get('/perfil/completar', [PerfilController::class, 'create'])
        ->name('perfil.completar');

    Route::post('/perfil/completar', [PerfilController::class, 'store'])
        ->name('perfil.salvar');

});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware([
        'auth',
        'verified',
        VerificarPerfilCompleto::class,
    ])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rotas protegidas do sistema
|--------------------------------------------------------------------------
|
| O usuário precisa estar autenticado e possuir
| um perfil completo para acessar estas páginas.
|
*/

Route::middleware([
    'auth',
    VerificarPerfilCompleto::class,
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Pacientes
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard/paciente', [
        PacienteController::class,
        'index',
    ])->name('admin.paciente.index');

    Route::get('/dashboard/cadastro', [
        PacienteController::class,
        'create',
    ])->name('profile.paciente.cadastrar');

    Route::post('/dashboard/cadastro', [
        PacienteController::class,
        'store',
    ])->name('profile.paciente.armazenar');

    Route::get('/dashboard/editar/{id}', [
        PacienteController::class,
        'edit',
    ])->name('profile.paciente.editar');

    Route::put('/dashboard/editar/{id}', [
        PacienteController::class,
        'update',
    ])->name('profile.paciente.atualizar');

    Route::delete('/dashboard/cadastro/{id}', [
        PacienteController::class,
        'destroy',
    ])->name('profile.paciente.excluir');

    /*
    |--------------------------------------------------------------------------
    | Atendimentos
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard/atendimento/cadastro', [
        AtendimentoController::class,
        'create',
    ])->name('atendimento.cadastro');

    Route::post('/dashboard/atendimento/cadastro', [
        AtendimentoController::class,
        'store',
    ])->name('atendimento.armazenar');

    Route::get('/dashboard/atendimento', [
        AtendimentoController::class,
        'index',
    ])->name('atendimento.index');

    Route::get('/dashboard/atendimento/editar/{id}', [
        AtendimentoController::class,
        'edit',
    ])->name('atendimento.editar');

    Route::put('/dashboard/atendimento/editar/{id}', [
        AtendimentoController::class,
        'update',
    ])->name('atendimento.atualizar');

    Route::patch('/dashboard/atendimento/cancelar/{id}', [
        AtendimentoController::class,
        'cancelar',
    ])->name('atendimento.cancelar');

    Route::patch('/dashboard/atendimento/iniciar/{id}', [
        AtendimentoController::class,
        'iniciar',
    ])->name('atendimento.iniciar');

    Route::patch('/dashboard/atendimento/concluir/{id}', [
        AtendimentoController::class,
        'concluir',
    ])->name('atendimento.concluir');

    /*
    |--------------------------------------------------------------------------
    | Avaliações
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard/avaliacao', [
        AvaliacaoController::class,
        'index',
    ])->name('avaliacao.index');

    Route::post('/dashboard/avaliacao/salvar', [
        AvaliacaoController::class,
        'salvar',
    ])->name('avaliacao.salvar');

    Route::delete('/dashboard/avaliacao/{id}', [
        AvaliacaoController::class,
        'excluir',
    ])->name('avaliacao.excluir');

    /*
    |--------------------------------------------------------------------------
    | Suporte
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard/suporte', [
        SolicitacaoSuporteController::class,
        'index',
    ])->name('suporte.index');

    Route::post('/dashboard/suporte', [
        SolicitacaoSuporteController::class,
        'armazenar',
    ])->name('suporte.armazenar');

    /*
    |--------------------------------------------------------------------------
    | Configurações da conta
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [
        ProfileController::class,
        'edit',
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update',
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy',
    ])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Autenticação Laravel Breeze
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
