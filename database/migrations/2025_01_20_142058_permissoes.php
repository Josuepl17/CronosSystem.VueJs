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
            $table->timestamps();
        });

        // Inserindo dados automaticamente
        $permissoes = [
            'acessar_pacientes' => 'Acessar Pacientes',
            'acessar_medicos' => 'Acessar Médicos',
            'acessar_consultas' => 'Acessar Consultas',
            'acessar_empresas' => 'Acessar Empresas',
            'acessar_atendentes' => 'Acessar Atendentes',
            'inserir_paciente' => 'Inserir Paciente',
            'inserir_medico' => 'Inserir Médico',
            'inserir_consulta' => 'Inserir Consulta',
            'inserir_empresa' => 'Inserir Empresa',
            'inserir_atendente' => 'Inserir Atendente',
            'editar_paciente' => 'Editar Paciente',
            'editar_medico' => 'Editar Médico',
            'editar_empresa' => 'Editar Empresa',
            'editar_atendente' => 'Editar Atendente',
            'cancelar_consulta' => 'Cancelar Consulta',
            'concluir_consulta' => 'Concluir Consulta'
        ];

        foreach ($permissoes as $chave => $descricao) {
            DB::table('permissoes')->insert([
                'descricao' => $descricao,
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
