<?php

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
        Schema::create('permissoes', function (Blueprint $table) {
            $table->id();

            $table->boolean('acessar_pacientes')->default(false);
            $table->boolean('acessar_medicos')->default(false);
            $table->boolean('acessar_consultas')->default(false);
            $table->boolean('acessar_empresa')->default(false);
            $table->boolean('acessar_atendentes')->default(false);

            $table->boolean('inserir_paciente')->default(false);
            $table->boolean('inserir_medico')->default(false);
            $table->boolean('inserir_consulta')->default(false);
            $table->boolean('inserir_empresa')->default(false); // a fazer
            $table->boolean('inserir_atendente')->default(false);


            $table->boolean('editar_paciente')->default(false);
            $table->boolean('editar_medico')->default(false);
            $table->boolean('editar_consulta')->default(false);
            $table->boolean('editar_empresa')->default(false); // a fazer
            $table->boolean('editar_atendente')->default(false);

            $table->boolean('cancelar_consulta')->default(false);
            $table->boolean('concluir_consulta')->default(false);
            $table->boolean('apagar_consulta')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
