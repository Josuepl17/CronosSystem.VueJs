<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramites extends Model
{
    protected $table = 'tramites';

    protected $fillable = [
        'titulo',
        'descricao',
        'paciente_id',
        'empresa_id',
        'medico_id',

    ];
    use HasFactory;
}
