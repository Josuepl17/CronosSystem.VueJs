<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\User;
use App\Models\User_Empresa;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class MedicosController extends Controller
{
    public function listaMedicos() {
     
        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
     
        $medicos = Medico::wherein('id', $users)->get();

        return Inertia::render('Medicos', compact('medicos'));

    }

    public function formMedicos() {
        return Inertia::render('FormMedicos');
    }



    public function createMedicos(ValidateRequest $request) 
    {
        // Extrai os dados, exceto a senha, para uso no Medico
        $dados = $request->except('senha');
    
        // Cria ou atualiza o Médico com base no e-mail ou algum identificador único
        $medico = Medico::updateOrCreate(
            ['email' => $request->email], // Condição para buscar o médico
            $dados // Dados para atualizar ou criar
        );
    
        // Cria ou atualiza o usuário vinculado ao médico
        $user = User::updateOrCreate(
            ['email' => $request->email], // Condição para buscar o usuário
            [
                'name' => $request->nome,
                'email' => $request->email,
                'password' => Hash::make($request->senha),
                'empresa_id' => Session::get('empresa_id'), // A empresa à qual ele pertence
            ]
        );
    
        // Cria ou atualiza a relação do usuário com a empresa na tabela User_Empresa
        $user_empresas = User_Empresa::updateOrCreate(
            ['user_id' => $user->id, 'empresa_id' => Session::get('empresa_id')], // Condição para buscar
            ['user_id' => $user->id, 'empresa_id' => Session::get('empresa_id')] // Dados para atualizar ou criar
        );
    
        return redirect('/medicos');
    }

    



    



    public function editMedicos(Request $request) {
       $medico_id =  $request->id;

       $medico = Medico::find($medico_id);

       return Inertia::render('FormMedicos', compact('medico'));


    }



}
