<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico_Paciente extends Model
{
    use HasFactory;
    protected $table = 'medico_paciente';

    protected $fillable = [
        'paciente_id',
        'medico_id',
        'empresa_id',
    ];


}
