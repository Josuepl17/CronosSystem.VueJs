<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Detalhes_Pacientes;
use App\Models\Pacientes;
use App\Services\MeuServico;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session as FacadesSession;
use Inertia\Inertia;

class PacientesController extends Controller
{
    public function listaPacientes() {
        $empresa_id = Auth::user()->empresa_id;
        $pacientes = Pacientes::where('empresa_id', $empresa_id)->get();
        return Inertia::render('Pacientes', compact('pacientes'));
       
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

    public function sessionPaciente(Request $request) {
        FacadesSession::put('id_paciente', $request->id);
        return redirect('/detalhes/paciente');
    }

    public function detalhesPacientes() {
        $id_paciente = FacadesSession::get('id_paciente');
        $detalhes = Detalhes_Pacientes::find($id_paciente);
        
        return Inertia::render('DetalhesPacientes', compact('detalhes'));

    }

    public function createDetalhesPacientes(Request $request) {
        $detalhes_pacientes = Detalhes_Pacientes::find(FacadesSession::get('id_paciente'));

        $detalhes_pacientes->texto_principal = $request->texto_principal;
        $detalhes_pacientes->paciente_id = FacadesSession::get('id_paciente');
        $detalhes_pacientes->empresa_id = Auth::user()->empresa_id;
        $detalhes_pacientes->save();
        return redirect('/detalhes/paciente');
    }

}
