<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoPaciente extends Model
{
    use HasFactory;
    protected $table = 'arquivos_pacientes';

    protected $fillable = [
        'nome',
        'tipo',
        'conteudo',
        'paciente_id',
        'empresa_id',
    ];
}
