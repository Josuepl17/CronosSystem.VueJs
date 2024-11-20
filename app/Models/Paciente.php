<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

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
        return $this->belongsToMany(Medico::class, 'medico_paciente', 'paciente_id', 'medico_id');
    }

    public function detalhespacientes (){
        return $this->hasMany(DetalhePaciente::class);
    }


    public function tramites (){
        return $this->hasMany(Tramite::class);
    }

}
