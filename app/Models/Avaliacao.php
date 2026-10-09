<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = [
        'id_cuidador',
        'nota',
    ];

    public function cuidador()
    {
        return $this->belongsTo(Cuidador::class, 'id_cuidador');
    }
}
