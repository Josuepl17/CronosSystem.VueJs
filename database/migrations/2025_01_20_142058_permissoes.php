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
            $table->string('descricao');
            $table->timestamps();
        });

        // Inserindo dados automaticamente
        $permissoes = [
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
            'concluir_consulta'
        ];

        foreach ($permissoes as $permissao) {
            DB::table('permissoes')->insert([
                'descricao' => $permissao,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
