<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuidador extends Model
{
    protected $table = 'cuidadores';

    protected $fillable = [
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

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'id_cuidador');
    }
}
