<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoSuporte extends Model
{
    protected $table = 'solicitacao_suportes';

    protected $fillable = [
        'nome',
        'assunto',
        'mensagem',
        'status',
    ];
}