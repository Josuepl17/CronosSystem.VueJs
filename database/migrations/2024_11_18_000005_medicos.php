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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->bigInteger('cpf')->unique();
            $table->string('crp')->unique();
            $table->string('especialidade');
            $table->bigInteger('telefone');
            $table->string('email')->unique();
            $table->string('endereco');
            $table->string('cidade');
            $table->string('bairro');
            //$table->unsignedBigInteger('empresa_id');
            //$table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
        });

        DB::statement('ALTER SEQUENCE medicos_id_seq RESTART WITH 1000');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
