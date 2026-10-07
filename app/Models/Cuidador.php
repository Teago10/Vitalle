<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuidador extends Model
{
    protected $table = 'cuidadores';

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'id_cuidador');
    }
}