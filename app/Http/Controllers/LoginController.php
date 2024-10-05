<?php

namespace App\Http\Controllers;

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

        dd(Users::all());

    }
}
