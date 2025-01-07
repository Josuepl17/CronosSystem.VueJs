<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DetalhePaciente extends Model
{
   // protected $table = 'detalhespaciente';
    
    protected $fillable = [
        'texto_principal',
        'arquivos',
        'date_cad',
        
        'date_pc',
        'date_uc',
        'date_pxc',

        'paciente_id',
        'empresa_id',
        'medico_id',

    ];
    use HasFactory;


    public function pacientes(){
        return $this->belongsTo(Paciente::class);
    }

    public function getDateAttribute($value)
    {
         return Carbon::parse($value)->format('d/m/Y');
 }
}
