<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Empresa;
use App\Models\Gerente;
use App\Models\User;
use App\Models\User_Empresa;
use App\Services\ServiceGeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class GerentesController extends Controller
{
    
    public function gerencia()
    {
        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
        $gerentes = Gerente::wherein('id', $users)->get();
        return Inertia::render('Gerentes/Gerentes', compact('gerentes'));

    }

    public function formGerencia(){
        return Inertia::render('Gerentes/FormGerente');
    }


    public function createGerente(ValidateRequest $request) 
    {
        // Obtém todos os dados do request
        $dados = $request->all();
    
        // Verifica se já existe um atendente com o ID fornecido
        $gerente = Gerente::updateOrCreate(
            ['id' => $request->id], // Critério de busca
            $dados // Dados a serem atualizados ou criados
        );
    

 
        // Verifica se o usuário com o mesmo ID do atendente já existe
        $user = User::updateOrCreate(
            ['id' => $gerente->id], // Critério de busca
            [
                'name' => $request->nome,
                'email' => $request->email,
                'primeiro_acesso' => $request->primeiro_acesso,
                'password' => Hash::make(123456),
                'empresa_id' => Session::get('empresa_id'),
            ]
        );


    
        // Verifica se já existe uma relação entre o usuário e a empresa na tabela User_Empresa
        $userEmpresa = User_Empresa::updateOrCreate(
            ['user_id' => $user->id, 'empresa_id' => $user->empresa_id]
        );



        $permissoesRecebidas = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
        ];



        ServiceGeral::CriarPermissoes($permissoesRecebidas, $user);
    
        return redirect('/gerentes');

    }

    public function editGerente(Request $request){
        $gerente = Gerente::find($request->id);
       return Inertia::render('Gerentes/FormGerente', compact('gerente'));
    }
}
