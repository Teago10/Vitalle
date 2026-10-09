<?php
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// rotas do paciente

Route::get('/dashboard/paciente', [PacienteController::class, 'index'])->name('admin.paciente.index');

Route::get('/dashboard/cadastro', [PacienteController::class, 'create'])->name('profile.paciente.cadastrar');

Route::post('/dashboard/cadastro', [PacienteController::class, 'store'])->name('profile.paciente.armazenar');

Route::get('/dashboard/atendimento/cadastro', [AtendimentoController::class, 'create'])
    ->name('atendimento.cadastro');

    Route::get('/dashboard/avaliacao', [AvaliacaoController::class, 'index'])
    ->name('avaliacao.index');

Route::post('/dashboard/avaliacao/salvar', [AvaliacaoController::class, 'salvar'])
    ->name('avaliacao.salvar');


    Route::get('/dashboard/atendimento', [AtendimentoController::class, 'index'])
    ->name('atendimento.index');

Route::post('/dashboard/atendimento/cadastro', [AtendimentoController::class, 'store'])
    ->name('atendimento.armazenar');

Route::get('/dashboard/atendimento/cadastro', [AtendimentoController::class, 'create'])
    ->name('atendimento.cadastro');

Route::get('/dashboard/editar/{id}', 
[PacienteController::class, 'edit'])->name('profile.paciente.editar');

Route::put('/dashboard/editar/{id}', 
[PacienteController::class, 'update'])->name('profile.paciente.atualizar');

Route::delete('/dashboard/cadastro/{id}', [PacienteController::class, 'destroy'])->name('profile.paciente.excluir');

// rotas padrão
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
