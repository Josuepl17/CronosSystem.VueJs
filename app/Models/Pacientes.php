<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'DataNascimento',
        'Medico',
        'cpf',
        'email',
        'cidade',
        'password',
        'bairro',
        'empresa_id'
    ];
}
