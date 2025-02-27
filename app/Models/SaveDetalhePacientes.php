<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveDetalhePacientes extends Model
{
    use HasFactory;

    protected $table = 'save_detalhe_pacientes';

    protected $fillable = [
        'texto_principal',
        'empresa_id',
        'paciente_id',
        'medico_id',
    ];
}
