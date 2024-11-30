<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Atendente;
use App\Models\Empresa;
use App\Models\User;
use App\Models\User_Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AtendenteController extends Controller
{
    public function listaAtendentes() {
        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
        $atendentes = Atendente::wherein('id', $users)->get();
        return Inertia::render('Atendentes', compact('atendentes'));
    }


    public function formAtendentes() {
        return Inertia::render('FormAtendentes');
    }



    public function createAtendente(ValidateRequest $request) {
        $dados = $request->all();
       // $dados['empresa_id'] = Session::get('empresa_id');
        $atendente =  Atendente::create($dados);
        
        $user = User::create([
            'id' => $atendente->id, // ID do Atendente usado como ID do User
            'name' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'empresa_id' => Session::get('empresa_id'),
        ]);

         $user_empresas = new User_Empresa();
         $user_empresas->user_id = $user->id;
         $user_empresas->empresa_id = $user->empresa_id;
         $user_empresas->save();

        return $this->listaAtendentes();
    }
}
