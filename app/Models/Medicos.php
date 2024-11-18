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


    public function pacientes(){
        return $this->belongsToMany(Pacientes::class, 'medico_paciente', 'medico_id', 'paciente_id');
    }
    
}
