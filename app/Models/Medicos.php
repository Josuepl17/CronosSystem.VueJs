<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    use HasFactory;


    protected $fillable = [
        'nome',
        'cpf',
        'crp',
        'especialidade',
        'telefone',
        'email',
        'endereco',
        'cidade',
        'bairro',
        'empresa_id',
    ];


    public function paciente(){
        return $this->belongsToMany(Pacientes::class, 'pacientes', 'paciente_id', 'medico_id');
    }
    
}
