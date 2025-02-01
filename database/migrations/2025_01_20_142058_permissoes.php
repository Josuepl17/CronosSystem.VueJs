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
            'inserir_paciente' => ['Inserir Paciente', 'form/paciente'],
            'editar_paciente' => ['Editar Paciente', 'editar/paciente/{id}'],
            'acessar_atendentes' => ['Acessar Atendentes', 'atendentes'],
            'inserir_atendente' => ['Inserir Atendente', 'form/atendentes'],
            'editar_atendente' => ['Editar Atendente', 'edit/atendentes/{id}'],
            'acessar_consultas' => ['Acessar Consultas', 'consultas'],
            'inserir_consulta' => ['Inserir Consulta', 'form/consultas'],
            'apagar_consulta' => ['Apagar Consulta', 'delete/consulta/{id}'],
            'cancelar_consulta' => ['Cancelar Consulta', 'cancelar/consulta'],
            'concluir_consulta' => ['Concluir Consulta', 'concluir/consulta/{id}'],
            'acessar_profissional' => ['Acessar Médicos', 'medicos'],
            'inserir_profissional' => ['Inserir Médico', 'form/medicos'],
            'editar_profissional' => ['Editar Médico', 'edit/medico/{id}'],

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
