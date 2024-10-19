<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Pacientes;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class PacientesController extends Controller
{
    public function listaPacientes() {
        $empresa_id = Auth::user()->empresa_id;
        
        $pacientes = Pacientes::where('empresa_id', $empresa_id)->get();

        $pacientes->each(function ($paciente) {
            $paciente->id = base64_encode($paciente->id) ;
        });
       
      //  dd($pacientes);
      //  return Inertia::render('Pacientes', compact('pacientes'));
       
    }
    

    public function formPacientes() {
        return Inertia::render('FormPacientes');
    }

    public function createPaciente(ValidateRequest $request) {
        $dados = $request->all();
        $dados['empresa_id'] = Auth::user()->empresa_id;
        Pacientes::create($dados);
        return redirect('/pacientes');
    }

    public function detalhesPaciente(Request $request) {

        dd($request->id);

    }
}
