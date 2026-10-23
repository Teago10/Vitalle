<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = [
        'id_cuidador',
        'user_id',
        'nota',
        'comentario',
    ];

    // Relacionamento com o cuidador avaliado
    public function cuidador()
    {
        return $this->belongsTo(Cuidador::class, 'id_cuidador');
    }

    // Relacionamento com o usuário que avaliou
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
