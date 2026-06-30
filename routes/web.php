<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuidadorController;
use App\Http\Controllers\ResponsavelController;

Route::get('/', function () {
    return view('cadastro');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/cadastro/cuidador', [CuidadorController::class, 'store'])
    ->name('cuidador.store');

Route::post('/cadastro/responsavel', [ResponsavelController::class, 'store'])
    ->name('responsavel.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cadastro', function () {
        return view('auth.cadastro');
    })->name('cadastro');
});

require __DIR__ . '/auth.php';
