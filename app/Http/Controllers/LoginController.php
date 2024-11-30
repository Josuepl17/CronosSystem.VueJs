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
        $empresa = new Empresa();
        $empresa->razao_social = $request->razao_social;
        $empresa->cnpj = $request->cnpj;
        $empresa->telefone = $request->telefone;
        $empresa->endereco = $request->endereco;
        $empresa->cidade = $request->cidade;
        $empresa->bairro = $request->bairro;
        $empresa->save();

        $empresa->filial_id = $empresa->id;
        $empresa->save();
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->empresa_id = $empresa->id;
        $user->save();

        $user_empresas = new User_Empresa();
        $user_empresas->user_id = $user->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();

        return redirect('/form/login');
    }


public function gerenciarFiliais() {

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

public function editarFilial(Request $request) {

    $filial_id = Auth::user()->empresa_id;
    $filial_id = Empresa::find($filial_id);
    $filial_id = $filial_id->filial_id;
    $todasfiliais = Empresa::where('filial_id', $filial_id)->pluck('id');

     $user_id = User_Empresa::wherein('empresa_id', $todasfiliais)->pluck('user_id');
   
     $todosusuarios = User::wherein('id', $user_id )->get();

    $usuariosfilial = User_Empresa::wherein('empresa_id', $request->id)->pluck('user_id');
    $usuariosfili = User::wherein('id', $user_id )->get();


    $filial = Empresa::find($request->id);


return Inertia::render('EditarFilial', compact('filial', 'todosusuarios', 'usuariosfili'));

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
        Auth::logout();
        return redirect('/form/login');
    }
}
