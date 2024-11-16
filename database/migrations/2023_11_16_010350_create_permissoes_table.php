<?php

use App\Models\Permissoes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Criação da tabela de permissões
        Schema::create('permissoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique(); // Nome da permissão
            $table->string('description')->nullable(); // Descrição da permissão
            $table->timestamps();
        });
    
        $permissions = [
            ['nome' => 'adm', 'description' => 'Visualiza Tudo'],
            ['nome' => 'medico', 'description' => 'Inserir registros do paciente'],
            ['nome' => 'atendente', 'description' => 'Cadastra pacientes, medicos'],
        ];
    
        foreach ($permissions as $permission) {
            Permissoes::create($permission);
        }



        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissoes');
    }
};
