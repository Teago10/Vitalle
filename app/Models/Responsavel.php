<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    use HasFactory;

    protected $table = 'responsaveis';

    protected $fillable = [
        'user_id',
        'nome',
        'telefone',
        'cpf',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relacionamento com o usuário autenticado
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento com pacientes
    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_responsavel');
    }
}
