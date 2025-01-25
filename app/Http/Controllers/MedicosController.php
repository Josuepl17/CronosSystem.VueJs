<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Mail\MailEnvioEmail;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Permissao;
use App\Models\User;
use App\Models\User_Empresa;
use App\Models\User_Permissao;
use App\Services\MeuServico;
use App\Services\ServiceGeral;
use App\Services\ServicesPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Str;

class MedicosController extends Controller
{
    public function listaMedicos() {
     
        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
        $medicos = Medico::wherein('id', $users)->get();
        $medicos = ServiceGeral::formatarTelefoneCPF($medicos);
        return Inertia::render('Medicos', compact('medicos'));

    }



    public function formMedicos() {
        $permissoes = Permissao::all();
        return Inertia::render('FormMedicos', compact('permissoes'));
    }



    public function createMedicos(ValidateRequest $request) 
    {
        // Evitar chamar Session::get várias vezes
        $empresaId = Session::get('empresa_id');
    
        DB::transaction(function () use ($request, $empresaId) {
            // Extrai os dados, exceto a senha, para uso no Medico
            $dados = $request->except('senha');
            
            // Cria ou atualiza o Médico com base no CPF
            $medico = Medico::updateOrCreate(
                ['cpf' => $request->cpf], // Condição para buscar o médico
                $dados // Dados para atualizar ou criar
            );
    
            // Dados do usuário
            $dados2 = [
                'name' => $request->nome,
                'email' => $request->email,
                'empresa_id' => $empresaId,
                'primeiro_acesso' => false,
                'password' => bcrypt("123456"), // Senha temporária (melhor usar bcrypt)
            ];
    
            // Cria ou atualiza o usuário
            $user = User::updateOrCreate(
                ['id' => $medico->id], // Condição para buscar o usuário
                $dados2
            );

            if ($user->wasRecentlyCreated) {
                $user->primeiro_acesso = true; // Define como verdadeiro se for criação
                $user->save(); // Salva a alteração no banco
            }
    
            // Cria ou atualiza a relação do usuário com a empresa
            User_Empresa::updateOrCreate(
                ['user_id' => $user->id, 'empresa_id' => $empresaId],
                ['user_id' => $user->id, 'empresa_id' => $empresaId]
            );
    
            // Cria permissões
            ServiceGeral::CriarPermissoes($request->permissoes, $user);
        });
    
        // Redireciona após a transação
        return redirect('/medicos');
    }
    
    

    




    public function editMedicos(Request $request) {
        
       $medico_id =  Crypt::decrypt($request->id);
       $medico = Medico::find($medico_id);
       $user = User::find($medico_id);
       $permissoes = Permissao::all();
       $idPermissaoSelect = $user->permissoes()->pluck('permissao_id')->toArray();
       return Inertia::render('FormMedicos', compact('medico' , 'permissoes', 'idPermissaoSelect'));


    }



}
