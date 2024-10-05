<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\User_Empresas;
use App\Models\Users;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function form_user_empresas() {
        return Inertia::render('Form_User_Empresa');
    }

    public function form_login() {
        return Inertia::render('Login');
    }

    public function criar_empresa_user(Request $request) {
        $user = new Users();
        $user->name = $request->name;
        $user->second_name = $request->second_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $empresa = new Empresas();
        $empresa->razao_social = $request->razao_social;
        $empresa->cnpj = $request->cnpj;
        $empresa->save();

        $user_empresas = new User_Empresas();
        $user_empresas->user_id = $user->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();

        dd(User_Empresas::all());

    }
}
