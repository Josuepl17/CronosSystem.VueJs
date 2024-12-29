<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaPaciente extends Model
{
    use HasFactory;

    protected $table = 'consulta_pacientes';

    protected $fillable = [
        'date',
        'hora',
        'paciente_id',
        'medico_id',
        'empresa_id',
        'nome_paciente',
        'nome_medico',
        'contato'
    ];



    // Acessor para formatar a data automaticamente ao recuperar
   // public function getDateAttribute($value)
  // {
    //    return Carbon::parse($value)->format('d/m/Y');
//}


}
