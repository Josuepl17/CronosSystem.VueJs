<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\User;
use App\Models\User_Empresas;
use App\Models\Users;
use App\Services\MeuServico;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

// Padrão Nomes Views, primeira letra Maiuscula e as Demais minusculas.
// Padrão Nomes Funções, primeira letra Minuscula e as Demais Maiusculas.
class LoginController extends Controller
{

    public function formLogin()
    {
        return Inertia::render('Login');
    }


    public function formUserEmpresa()
    {
        return Inertia::render('FormUserEmpresa');
    }



    public function createUserEmpresa(Request $request)
    { // CRIA UM USUARIO, UMA EMPRESA E UMA LIGAÇÃO ENTRE OS DOIS 


        $empresa = new Empresas();
        $empresa->razao_social = $request->razao_social;
        $empresa->cnpj = $request->cnpj;
        $empresa->save();

        $user = new User();
        $user->name = $request->name;
        $user->second_name = $request->second_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->empresa_id = $empresa->id;
        $user->save();

        $user_empresas = new User_Empresas();
        $user_empresas->user_id = $user->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();



        return redirect('/form/login');
    }


    public function Authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            return redirect()->intended();
        } else {
            // Autenticação falhou
            return back()->withErrors([
                'email' => 'Credenciais inválidas.',
            ]);
        }
    }


    public function definirFilial()
    {

        $user_id = Auth::user()->id;
        $relacionamentos = User_Empresas::where('user_id', $user_id)->pluck('empresa_id');
        $filiais = Empresas::whereIn('id', $relacionamentos)->get();
        Session::put('filiais', $filiais);

        $razaoEmpresa = Empresas::find(Auth::user()->empresa_id);
        Session::put('empresa_id', $razaoEmpresa->razao_social);

        return redirect('/dash');
    }

    public function mudarFilial(Request $request)
    {
        $usuario = Auth::user();
        $usuario->empresa_id = $request->id;
        return redirect('/');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/form/login');
    }
};
