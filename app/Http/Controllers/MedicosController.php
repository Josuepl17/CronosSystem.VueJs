<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Mail\MailEnvioEmail;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\User;
use App\Models\User_Empresa;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Str;

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
        DB::transaction(function () use ($request) {
            // Extrai os dados, exceto a senha, para uso no Medico
            $dados = $request->except('senha');
        
            // Cria ou atualiza o Médico com base no CPF
            $medico = Medico::updateOrCreate(
                ['cpf' => $request->cpf], // Condição para buscar o médico
                $dados // Dados para atualizar ou criar
            );

            
        $senhaAleatoria = Str::random(6);

      //  dd($senhaAleatoria);

            //Mail::to($medico->email)->send(new MailEnvioEmail($senhaAleatoria));
        
            // Cria ou atualiza o usuário vinculado ao médico
            $dados2 = [
                'name' => $request->nome,
                'email' => $request->email,
                'empresa_id' => Session::get('empresa_id'),
                'password' => $request->senha,
            ];

            dd($dados2);
            
            
            $user = User::updateOrCreate(
                ['id' => $medico->id], // Condição para buscar o usuário
                $dados2
            );
        
            // Cria ou atualiza a relação do usuário com a empresa na tabela User_Empresa
            User_Empresa::updateOrCreate(
                ['user_id' => $user->id, 'empresa_id' => Session::get('empresa_id')], // Condição para buscar
                ['user_id' => $user->id, 'empresa_id' => Session::get('empresa_id')] // Dados para atualizar ou criar
            );
        });
    
        return redirect('/medicos')->with('success', 'Médico criado ou atualizado com sucesso!');
    }
    

    



    



    public function editMedicos(Request $request) {
       $medico_id =  $request->id;

       $medico = Medico::find($medico_id);

       return Inertia::render('FormMedicos', compact('medico'));


    }



}
