<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Detalhes_Pacientes;
use App\Models\Medicos;
use App\Models\Medicos_Pacientes;
use App\Models\Pacientes;
use App\Models\Tramites_Pacientes;
use App\Services\MeuServico;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session as FacadesSession;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\Object_;

class PacientesController extends Controller
{


    public function listaPacientes() {
        $empresa_id = Auth::user()->empresa_id;
        $pacienteIds = Medicos_Pacientes::where('medico_id', Auth::user()->funcionario_id)->where('empresa_id', $empresa_id)->pluck('paciente_id');
        $pacientes = Pacientes::whereIn('id', $pacienteIds)->where('empresa_id', $empresa_id)->get();
        return Inertia::render('Pacientes', compact('pacientes'));
       
    }




    

    public function formPacientes() {
        $empresa_id = Auth::user()->empresa_id;
        $medicos = Medicos::where('empresa_id', $empresa_id)->get();
        return Inertia::render('FormPacientes', compact('medicos'));
    }





    public function createPaciente(ValidateRequest $request) {
        $dados = $request->all();



     
        $dados['empresa_id'] = Auth::user()->empresa_id;
    
        $paciente =  Pacientes::create($dados);

        foreach ($request->medico as $medico_id) {

            Medicos_Pacientes::create([
                'paciente_id' => $paciente->id,
                'medico_id' => $medico_id,
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            Detalhes_Pacientes::create([
                'paciente_id' => $paciente->id,
                'texto_principal' => "",
                'arquivos' => "",
                'empresa_id' => Auth::user()->empresa_id,
                'medico_id' => $medico_id,
            ]);
        }



        return redirect('/pacientes');
    }








    public function sessionPaciente(Request $request) {
        FacadesSession::put('id_paciente', $request->id);
        return redirect('/detalhes/paciente');
    }





////////////////////////////////////////////

    public function detalhesPacientes() {
        $id_paciente = FacadesSession::get('id_paciente');
        $paciente = Pacientes::Find($id_paciente); // nome vue js 

        $detalhes = Detalhes_Pacientes::where('paciente_id', $id_paciente)->where('medico_id', Auth::user()->funcionario_id)->first(); // filtra os detalhes de o paciente escolhido dos detalhes feitos pelo medico logado

        $tramites_paciente = Tramites_Pacientes::where('paciente_id', $id_paciente)->where('medico_id', Auth::user()->funcionario_id)->get()->toArray();
        return Inertia::render('DetalhesPacientes', compact('detalhes', 'tramites_paciente', 'paciente'));

    }







    public function createDetalhesPacientes(Request $request)
    {
        // Armazenar o valor de `id_paciente` da sessão para simplificação
        $pacienteId = FacadesSession::get('id_paciente');
    
        // Encontrar o registro existente e atualizar apenas os campos necessários
        Detalhes_Pacientes::where('paciente_id', $pacienteId)->where('medico_id', Auth::user()->funcionario_id)
            ->update([
                'texto_principal' => $request->texto_principal,
                'arquivos' => $caminhoArquivosString ?? null,
            ]);
    }



public function createTramite(Request $request) {
    $dados = $request->all();
    $dados['paciente_id'] = FacadesSession::get('id_paciente');
    $dados['empresa_id'] = Auth::user()->empresa_id;
    $dados['medico_id'] = Auth::user()->funcionario_id;
    Tramites_Pacientes::create($dados);
    return Inertia::location('/detalhes/paciente');
}










/*public function downloadArquivo()
{
    // Caminho completo do arquivo
    $paciente = Detalhes_Pacientes::Find(FacadesSession::get('id_paciente'));
    $arquivos = $paciente->arquivos;
    $arquivos = explode(",", $arquivos);
    print_r($arquivos);


        foreach ($arquivos as $arquivo) {
            return response()->download($arquivo);   
            }   
}*/


}
