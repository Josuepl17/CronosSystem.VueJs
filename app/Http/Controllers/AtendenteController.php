<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Atendente;
use App\Models\Empresa;
use App\Models\User;
use App\Models\User_Empresa;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AtendenteController extends Controller
{
    public function listaAtendentes() {
        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id'); // relacionamento empresa user
        $atendentes = Atendente::wherein('id', $users)->get();
        $atendentes = MeuServico::formatarDados($atendentes);
        return Inertia::render('Atendentes', compact('atendentes'));
    }





    

    public function formAtendentes() {
        return Inertia::render('FormAtendentes');
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
                'primeiro_acesso' => true,
                'password' => Hash::make($request->senha),
                'empresa_id' => Session::get('empresa_id'),
            ]
        );
    
        // Verifica se já existe uma relação entre o usuário e a empresa na tabela User_Empresa
        $userEmpresa = User_Empresa::firstOrCreate(
            ['user_id' => $user->id, 'empresa_id' => $user->empresa_id]
        );
    
        return redirect('/atendentes');

    }






    public function editAtendente(Request $request) {
        $id = MeuServico::Decrypted($request->id);
        $atendente = Atendente::find($id);
        return Inertia::render('FormAtendentes', compact('atendente'));
        
    }
}
