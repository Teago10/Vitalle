<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Cuidador;

class Atendimento extends Model
{
    protected $table = 'atendimentos';

    protected $fillable = [
        'id_paciente',
        'id_cuidador',
        'data_atendimento',
        'horario_inicio',
        'horario_fim',
        'tipo_jornada',
        'valor',
        'status',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function cuidador()
    {
        return $this->belongsTo(Cuidador::class, 'id_cuidador');
    }
}