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
use Inertia\Inertia;

class LoginController extends Controller
{

    public function form_login() {
        return Inertia::render('Login');
    }


    public function form_user_empresas() {
        return Inertia::render('Form_User_Empresa');
    }



    public function criar_empresa_user(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->second_name = $request->second_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $empresa = new Empresas();
        $empresa->razao_social = $request->razao_social;
        $empresa->cnpj = $request->cnpj;
        $empresa->save();

        $user_empresas = new User_Empresas();
        $user_empresas->user_id = $user->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();

        return Inertia::render('Login');

    }


    public function autenticate(Request $request) {
        $credentials = $request->only('email', 'password');
      
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
           // return Inertia::render('index');  
           dd("deu bom");
          } else {
            dd("deu ruim");
          }

}
};