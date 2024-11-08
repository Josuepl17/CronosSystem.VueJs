<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramites_Pacientes extends Model
{
    protected $table = 'tramites_pacientes';

    protected $fillable = [
        'titulo',
        'descricao',
        'paciente_id',
        'empresa_id',

    ];
    use HasFactory;
}
