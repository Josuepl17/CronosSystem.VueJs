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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

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
        $empresa = new Empresas();
        $empresa->razao_social = $request->razao_social;
        $empresa->cnpj = $request->cnpj;
        $empresa->save();

        $user = new User();
        $user->name = $request->name;
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

// Defini a ultima filial selecionada na sessão para exibir dados no layout princiapal
//Lista todas as empresas ligadas ao usuario logado.
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

    // altera a filial selecionada na cluna do usuario registra na sessão na proxima função.
    public function mudarFilial(Request $request)
    {
        $decryptedId = Crypt::decryptString($request->id);
        dd($decryptedId);
        $usuario = Auth::user();
        $usuario->empresa_id = $request->id;
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/form/login');
    }
}
