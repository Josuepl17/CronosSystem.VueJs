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
        return Inertia::render('Login');
    }









    public function Authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Medico::where('id', Auth::id())->exists() || Atendente::where('id', Auth::id())->exists()) {
               // se for um medico ou atentende não faz um put de admisnitrador 
            }else{
                Session::put('adm', "adm"); // id para apresentar gerenciamento de filial

            }
            Session::put('id', Auth::id());
            Session::put('nome', Auth::user()->name);
            return redirect()->intended();
        } else {
            return back()->withErrors([
                'email' => 'Credenciais inválidas.',
            ]);
        }
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
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'empresa_id' => $empresa->id,
            ]);
        
            User_Empresa::create([
                'user_id' => $user->id,
                'empresa_id' => $empresa->id,
            ]);
        });
        

        return redirect('/form/login');
    }


    public function gerenciarFiliais()
    {

        $filial_id = Auth::user()->empresa_id;
        $filial_id = Empresa::find($filial_id);
        $filial_id = $filial_id->filial_id;
        $todasfiliais = Empresa::where('filial_id', $filial_id)->get();
        //dd($todasfiliais);
        // $user_id  = User_Empresa::wherein('empresa_id', $empresa_id)->pluck('user_id');

        // $usuarios = Medico::wherein('id', $user_id)->get();

        //dd($usuarios);

        return Inertia::render('ListaFiliais', compact('todasfiliais'));
    }

    public function editarFilial(Request $request)
    {

        $filial_id = Auth::user()->empresa_id;
        $filial_id = Empresa::find($filial_id);
        $filial_id = $filial_id->filial_id;
        $todasfiliais = Empresa::where('filial_id', $filial_id)->pluck('id');

        $user_id = User_Empresa::wherein('empresa_id', $todasfiliais)->pluck('user_id');
        $user_id_filial = User_Empresa::wherein('empresa_id', [$request->id])->pluck('user_id');

        $outrosfilial = User::wherein('id', $user_id) ->whereNotIn('id', $user_id_filial)->get();
        $usuariosfilial = User::whereIn('id', $user_id_filial)->get();

        Session::put('empresa_selecionada', $request->id);

        //$todosusuarios = $todosusuarios->map(function ($usuario) use ($usuariosfilial) {
        //    $usuario->is_select = $usuariosfilial->contains($usuario->id);
        //    return $usuario;
      //  });



            //   dd($usuariosfilial);
        $filial = Empresa::find($request->id);


        return Inertia::render('EditarFilial', compact('filial', 'outrosfilial', 'usuariosfilial'));
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

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/form/login');
    }


    public function createVinculoUser(Request $request) {
        
        $dados = $request->users;

        foreach ($dados as $dado){

            $user_empresa = new User_Empresa();
            $user_empresa->user_id = $dado; 
            $user_empresa->empresa_id = Session::get('empresa_selecionada'); 
            $user_empresa->save();
        }

        return redirect('/gerenciar/filial');

    }



    public function removeVinculoUser(Request $request) {
        
        $dados = $request->users;

         User_Empresa::wherein('user_id',  $dados)->where('user_id', '!=', Auth::id())->where('empresa_id', Session::get('empresa_selecionada'))->delete();


         return redirect('/gerenciar/filial');

    }
}
