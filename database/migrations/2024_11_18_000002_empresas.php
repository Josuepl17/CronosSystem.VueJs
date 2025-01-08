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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social');
            $table->string('cnpj')->unique();
            $table->bigInteger('ie')->unique()->nullable();
            $table->bigInteger('im')->unique()->nullable();
            $table->string('telefone');
            $table->string('endereco');
            $table->string('cidade');
            $table->string('bairro');



            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
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
