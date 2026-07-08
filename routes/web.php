<?php

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



// rotas padrão
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
