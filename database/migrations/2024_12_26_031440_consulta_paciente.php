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
        Schema::create('consulta_pacientes', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->time('horainicial')->format('H:i');
            $table->time('horafinal')->format('H:i');
            $table->string('nome_paciente');
            $table->string('nome_medico');
            $table->string('contato');
            $table->enum('status', ['Agendado', 'Cancelado', 'Concluido'])->default('Agendado');
            $table->string('motivo_status')->nullable();

            
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');


            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
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
