<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento_Paciente extends Model
{
    use HasFactory;

    protected $table = 'medicamento_pacientes';

    protected $fillable = [
        'medicamento',
        'paciente_id',
        'medico_id',
        'paciente_id',
        'empresa_id',

    ];
}
