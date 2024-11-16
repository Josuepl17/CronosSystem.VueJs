<?php

use App\Models\Permissao_Users;
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
        Schema::create('permissao_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('permissoes_id');
            $table->foreign('permissoes_id')->references('id')->on('permissoes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('descricao');


            $table->timestamps();
        });


        Permissao_Users::create([
            'user_id' => 1,
            'permissoes_id' => 1,
            'descricao' => 'adm',

        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissao__users');
    }
};
