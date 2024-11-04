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
            $table->integer('cnpj')->unique();
            $table->timestamps();
        });

        DB::table('empresas')->insert([
            'razao_social' => 'Empresa Padrão',
            'cnpj' => '12345678000100', // CNPJ EXEMPLO, SUBSTITUA POR UM VÁLIDO SE NECESSÁRIO
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
