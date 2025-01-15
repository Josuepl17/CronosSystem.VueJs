<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatoriosPaciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_documento',
        'prescricao',
        'paciente_id',
        'medico_id',
        'empresa_id',
    ];

    protected $table = 'relatorios_pacientes';
    
}
