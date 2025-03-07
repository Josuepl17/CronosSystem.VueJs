<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Atendente;
use App\Models\Empresa;
use App\Models\Permissao;
use App\Models\User;
use App\Models\User_Empresa;
use App\Models\User_Permissao;
use App\Services\MeuServico;
use App\Services\ServiceGeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AtendenteController extends Controller
{
    public function listaAtendentes() {
        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id'); // relacionamento empresa user
        $atendentes = Atendente::wherein('id', $users)->get();
        $atendentes = ServiceGeral::formatarTelefoneCPF($atendentes);
        return Inertia::render('Atendentes/Atendentes', compact('atendentes'));
    }





    

    public function formAtendentes() {
        $permissoes = Permissao::all();
        return Inertia::render('Atendentes/FormAtendentes', compact('permissoes'));
    }






    public function createAtendente(ValidateRequest $request) 
    {
        // Obtém todos os dados do request
        $dados = $request->all();
    
        // Verifica se já existe um atendente com o ID fornecido
        $atendente = Atendente::updateOrCreate(
            ['id' => $request->id], // Critério de busca
            $dados // Dados a serem atualizados ou criados
        );
    
 
        // Verifica se o usuário com o mesmo ID do atendente já existe
        $user = User::updateOrCreate(
            ['id' => $atendente->id], // Critério de busca
            [
                'name' => $request->nome,
                'email' => $request->email,
                'primeiro_acesso' => $request->primeiro_acesso,
                'password' => Hash::make(123456),
                'empresa_id' => Session::get('empresa_id'),
            ]
        );


    
        // Verifica se já existe uma relação entre o usuário e a empresa na tabela User_Empresa
        $userEmpresa = User_Empresa::firstOrCreate(
            ['user_id' => $user->id, 'empresa_id' => $user->empresa_id]
        );

        $permissoesRecebidas  = $request->permissoes;

        ServiceGeral::CriarPermissoes($request->permissoes, $user);
    
        return redirect('/atendentes');

    }






    public function editAtendente(Request $request) {
        $id = Crypt::decrypt($request->id);
        $atendente = Atendente::find($id);
        $user = User::find($id);
        $permissoes = Permissao::all();
        $idPermissaoSelect = $user->permissoes()->pluck('permissao_id')->toArray();
        return Inertia::render('Atendentes/FormAtendentes', compact('atendente', 'idPermissaoSelect', 'permissoes'));
        
    }
}
