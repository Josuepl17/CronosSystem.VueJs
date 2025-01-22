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
        'acessar_empresa',
        'acessar_atendentes',
        'inserir_paciente',
        'inserir_medicos',
        'inserir_consultas',
        'inserir_empresa',
        'inserir_atendentes',
        'editar_paciente',
        'editar_medicos',
        'editar_consultas',
        'editar_empresa',
        'editar_atendentes',
        'cancelar_consulta',
        'concluir_consulta',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $table = 'permissoes';
}
