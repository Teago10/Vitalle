<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuidador extends Model
{
    protected $table = 'cuidadores';

    protected $fillable = [
        'user_id',
        'nome',
        'telefone',
        'cpf',
        'avaliacao_media',
        'qualificacao',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'email',
        'password',
        'complemento',
    ];

    protected $hidden = [
        'password',
    ];

    // Relacionamento com o usuário autenticado
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento com atendimentos
    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'id_cuidador');
    }
}
