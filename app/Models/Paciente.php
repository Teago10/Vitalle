<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    public function responsavel()
    {
        return $this->belongsTo(Responsavel::class, 'id_responsavel');
    }
}
