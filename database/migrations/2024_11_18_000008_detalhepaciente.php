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
        Schema::create('detalhe_pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('texto_principal')->nullable();
            $table->string('arquivos')->nullable();

            $table->unsignedBigInteger('medico_id');
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade')->onUpdate('cascade');
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
