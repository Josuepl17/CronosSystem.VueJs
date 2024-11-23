<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\User;
use App\Models\User_Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class MedicosController extends Controller
{
    public function listaMedicos() {
        $empresa_id = Session::get('empresa_id');
        $empresa = Empresa::find($empresa_id);
        $medicos = $empresa->medicos()->get();
        return Inertia::render('Medicos', compact('medicos'));
    }

    public function formMedicos() {
        return Inertia::render('FormMedicos');
    }



    public function createMedicos(ValidateRequest $request) {
        $dados = $request->except('senha');
        $dados['empresa_id'] = Session::get('empresa_id');
        $medico =  Medico::create($dados);

        $user =  User::create([
            
            'name' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
            'empresa_id' => Auth::user()->empresa_id,
            'funcionario_id' => $medico->id,

         ]);

         $user_empresas = new User_Empresa();
         $user_empresas->user_id = $user->id;
         $user_empresas->empresa_id = $user->empresa_id;
         $user_empresas->save();



        return redirect('/medicos');
    }
}
