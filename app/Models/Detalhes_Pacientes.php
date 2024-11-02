<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalhes_Pacientes extends Model
{
    protected $table = 'detalhes_pacientes';
    protected $fillable = [
        'texto_principal',
        'paciente_id',
        'empresa_id',

    ];
    use HasFactory;
}
