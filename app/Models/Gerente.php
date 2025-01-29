<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gerente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco',
        'cidade',
        'bairro',
        'empresa_id',
    ];

    protected $table = 'gerentes';
}
