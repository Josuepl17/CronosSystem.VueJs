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
        'cpf',
        'email',
        'cidade',
        'password',
        'bairro',
        'empresa_id'
    ];

    public function medicos(){
        return $this->belongsToMany(Medicos::class, 'medico_paciente', 'paciente_id', 'medico_id');
    }
}
