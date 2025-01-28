<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->id();
            $table->string('chave');
            $table->string('descricao');
            $table->string('rota');
            $table->timestamps();
        });

        // Inserindo dados automaticamente
        $permissoes = [
            'acessar_pacientes' => ['Acessar Pacientes', 'pacientes'],
            'acessar_medicos' => ['Acessar Médicos', 'medicos'],
            'acessar_consultas' => ['Acessar Consultas', 'consultas'],
            'acessar_atendentes' => ['Acessar Atendentes', 'atendentes'],
            'inserir_paciente' => ['Inserir Paciente', 'form/paciente'],
            'inserir_medico' => ['Inserir Médico', 'form/medicos'],
            'inserir_consulta' => ['Inserir Consulta', 'form/consultas'],
            'inserir_atendente' => ['Inserir Atendente', 'form/atendentes'],
            'editar_paciente' => ['Editar Paciente', 'editar/paciente/{id}'],
            'editar_medico' => ['Editar Médico', 'edit/medico/{id}'],
            'editar_atendente' => ['Editar Atendente', 'edit/atendentes/{id}'],
            'cancelar_consulta' => ['Cancelar Consulta', 'cancelar/consulta'],
            'concluir_consulta' => ['Concluir Consulta', 'concluir/consulta/{id}'],
            'apagar_consulta' => ['Apagar Consulta', 'delete/consulta/{id}'],
        ];

        foreach ($permissoes as $chave => $valor) {
            DB::table('permissoes')->insert([
                'descricao' => $valor[0],
                'rota' => $valor[1],
                'chave' => $chave,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }        } 
       

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
