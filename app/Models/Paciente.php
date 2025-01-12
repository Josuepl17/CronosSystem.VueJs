<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

   // protected $table = 'pacientes';

    protected $fillable = [
        'nome',
        'DataNascimento',
        'cpf',
        'email',
        'cidade',
        'bairro',
        'empresa_id',
        'telefone'
    ];

    public function medicos(){
        return $this->belongsToMany(Medico::class, 'medico_paciente', 'paciente_id', 'medico_id');
    }

    public function detalhespacientes (){
        return $this->hasOne(DetalhePaciente::class); //tem 1
    }


    public function tramites (){
        return $this->hasMany(Tramite::class); // tem muitos
    }

    public function consultas (){
        return $this->hasMany(ConsultaPaciente::class); // tem muitos
    }



    public function getDataNascimentottribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
