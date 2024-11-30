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
            $table->bigInteger('cnpj')->unique();


            $table->bigInteger('telefone');
            $table->string('email')->unique();
            $table->string('endereco');
            $table->string('cidade');
            $table->string('bairro');


            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id')->references('id')->on('empresas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('empresas')->insert([
            'razao_social' => 'Empresa Padrão',
            'cnpj' => '12345678000100', // CNPJ EXEMPLO, SUBSTITUA POR UM VÁLIDO SE NECESSÁRIO
            'filial_id' => 1,
            'telefone' => 27996550967,
            'email' => 'qualquer@gmail.com',
            'endereco'  => 'nsjknsdn',
            'cidade' => 'Pancas' ,
            'bairro' => 'iejfijdi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
