<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ConsultaPaciente;

class Medico extends Model
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
        'senha',
    ];


    public function pacientes(){
        return $this->belongsToMany(Paciente::class, 'medico_paciente', 'medico_id', 'paciente_id');
    }

    public function empresas(){
        return $this->belongsTo(Empresa::class);
    }

    public function consultas() {
        return $this->hasMany(ConsultaPaciente::class, 'medico_id', 'id');
    }
    
}
