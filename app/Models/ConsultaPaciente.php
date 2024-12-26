<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaPaciente extends Model
{
    use HasFactory;

    protected $table = 'consulta_pacientes';

    protected $fillable = [
        'date',
        'hora',
        'paciente_id',
        'medico_id',
        'empresa_id',
        'nome_paciente',
        'nome_medico',
        'contato'
    ];
}
