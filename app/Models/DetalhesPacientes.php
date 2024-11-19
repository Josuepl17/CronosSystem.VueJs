<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalhesPacientes extends Model
{
    protected $table = 'detalhespaciente';
    
    protected $fillable = [
        'texto_principal',
        'arquivos',
        'paciente_id',
        'empresa_id',
        'medico_id',

    ];
    use HasFactory;


    public function pacientes(){
        return $this->belongsTo(Pacientes::class);
    }
}
