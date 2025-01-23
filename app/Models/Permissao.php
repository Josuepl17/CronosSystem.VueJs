<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    use HasFactory;
    protected $fillable = [
        'acessar_pacientes',
        'acessar_medicos',
        'acessar_consultas',
        'acessar_empresas',
        'acessar_atendentes',
        'inserir_paciente',
        'inserir_medico',
        'inserir_consulta',
        'inserir_empresa',
        'inserir_atendente',
        'editar_paciente',
        'editar_medico',
        'editar_empresa',
        'editar_atendente',
        'cancelar_consulta',
        'concluir_consulta',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $table = 'permissoes';
}
