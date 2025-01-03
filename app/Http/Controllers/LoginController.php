<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Empresas;
use App\Models\Medico;
use App\Models\User;
use App\Models\User_Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Http\Requests\ValidateRequest;
use App\Models\Atendente;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function formLogin() // formulario de login
    {

        return Inertia::render('Login', [
            'title' => 'Página Exemplo',  // Passando a propriedade title
        ]);
       
    }




    public function Authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

       $user =  User::where('email', $request->email)->first();

        if ($user->primeiro_acesso === true) {
            Session::put('updateSenhaId', $user->id);    
            return redirect('/atualizar/senha');
        }

        if (Auth::attempt($credentials)) {

            if (Medico::where('id', Auth::id())->exists() || Atendente::where('id', Auth::id())->exists()) {
                // se for um medico ou atentende não faz um put de admisnitrador 
            } else {
                Session::put('adm', "adm"); // id para apresentar gerenciamento de filial

            }
            Session::put('id', Auth::id());
            Session::put('nome', Auth::user()->name);
            return redirect('/');
        } else {
            return back()->withErrors([
                'email' => 'Email Invalido.',
            ]);
        }
    }

    public function formSenha()
    {

        return Inertia::render('UpdateSenha');
    }

    public function updateSenha(Request $request)
    {
        $user = User::find(Session::get('updateSenhaId'));

        $user->password = Hash::make($request->password);
        $user->primeiro_acesso = false; 
        $user->save();

        sleep(2);

        Session::forget('updateSenhaId');

        return redirect('/form/login');
    }












    public function formUserEmpresa() // formulario de Cadastro Inicial 
    {
        return Inertia::render('FormUserEmpresa');
    }




    public function createUserEmpresa(Request $request)
    {
        DB::transaction(function () use ($request) { // reverte caso algum inserção falhe
            $empresa = Empresa::create([
                'razao_social' => $request->razao_social,
                'cnpj' => $request->cnpj,
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro,
            ]);

            $empresa->update(['filial_id' => $empresa->id]);


        $user = User::where('email', 'josuep.l@outlook.com')->first();

            if (!$user) {
                
                $user = User::create([
                    'name' => "Administrador",
                    'email' => "josuep.l@outlook.com",
                    'primeiro_acesso' => false,
                    'password' => Hash::make(123456),
                    'empresa_id' => $empresa->id,
                ]);
            }

// Realizada alteração para quepossa ter apenas um administrador que sou eupara todas as empresas para administrara criaçãode novas empresas filiais e usuários iniciais , Caso precise reverter também terá quemexer no Vue js 
            //  $user = User::create([
            //   'name' => $request->name,
            //   'email' => $request->email,
            //   'password' => Hash::make($request->password),
            //   'empresa_id' => $empresa->id,
            //   ]);

            User_Empresa::create([
                'user_id' => $user->id,
                'empresa_id' => $empresa->id,
            ]);
        });

        return redirect('/form/login');
    }






    // Defini a ultima filial selecionada na sessão para exibir dados no layout princiapal
    //Lista todas as empresas ligadas ao usuario logado.
    public function definirFilial()
    {
        $user = User::find(Auth::id());
        $filiais = $user->empresas()->get();
        Session::put('filiais', $filiais);
        $empresa = Empresa::find(Auth::user()->empresa_id);
        Session::put('razao_social', $empresa->razao_social);
        Session::put('empresa_id', Auth::user()->empresa_id);
        return redirect('/dash');
    }




    // altera a filial selecionada na cluna do usuario registra na sessão na proxima função.
    public function mudarFilial(Request $request)
    {

        \App\Models\User::where('id', Auth::id())
            ->update(['empresa_id' => $request->id]);

        return redirect('/');
    }






    public function gerenciarFiliais()
    {

        $empresa_id = Auth::user()->empresa_id;
        $empresa = Empresa::find($empresa_id);
        $filial_id = $empresa->filial_id;
        $todasfiliais = Empresa::where('filial_id', $filial_id)->get(); // Busca todas as empresas que tiverem filial_id da  minha empresa selecionada, Isso trará a matriz de todas as filiais.
        return Inertia::render('ListaFiliais', compact('todasfiliais'));
    }






    public function editarFilial(Request $request)
    {

        $empresa_id = Auth::user()->empresa_id;
        $empresa = Empresa::find($empresa_id);
        $filial_id = $empresa->filial_id;
        $todasfiliais = Empresa::where('filial_id', $filial_id)->pluck('id');

        $user_id = User_Empresa::wherein('empresa_id', $todasfiliais)->pluck('user_id'); // User_id de todas Minhas filiais
        $user_id_filial = User_Empresa::wherein('empresa_id', [$request->id])->pluck('user_id'); // User_id apenas da filial Selcionada 

        $outrosfilial = User::wherein('id', $user_id)->whereNotIn('id', $user_id_filial)->get(); // A partir dos ideias que eu peguei acima eu recupero todos os usuários que não pertencem a empresas selecionadas
        $usuariosfilial = User::whereIn('id', $user_id_filial)->get(); // A parte do meu ID que eu peguei acima recupero todos os meus usuários que pertencem à empresa selecionada.

        Session::put('empresa_selecionada', $request->id);

        $filial = Empresa::find($request->id); // Dados para alterar informações da empresa


        return Inertia::render('EditarFilial', compact('filial', 'outrosfilial', 'usuariosfilial'));
    }





    public function createVinculoUser(Request $request)
    {

        $dados = $request->users;

        foreach ($dados as $dado) {

            $user_empresa = new User_Empresa();
            $user_empresa->user_id = $dado;
            $user_empresa->empresa_id = Session::get('empresa_selecionada');
            $user_empresa->save();
        }

        return redirect('/gerenciar/filial');
    }



    public function removeVinculoUser(Request $request)
    {

        $dados = $request->users;

        User_Empresa::wherein('user_id',  $dados)->where('user_id', '!=', Auth::id())->where('empresa_id', Session::get('empresa_selecionada'))->delete(); // não deteta o usuario logado, que no caso é somente o adm


        return redirect('/gerenciar/filial');
    }












    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/form/login');
    }
}
