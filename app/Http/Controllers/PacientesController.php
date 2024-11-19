<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\DetalhePaciente;
use App\Models\Medico_Paciente;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Tramite;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Inertia\Inertia;

class PacientesController extends Controller
{


    public function listaPacientes() {

        if ($medico = Medico::Find(session('funcionario_id'))){

        $pacientes = $medico->pacientes()->get();

        } else{
            $pacientes = Paciente::all();
        }

         MeuServico::Autorizer();
        return Inertia::render('Paciente', compact('pacientes'));
       
    }









    

    public function formPacientes() {
        $empresa_id = Auth::user()->empresa_id;
        $medicos = Medico::where('empresa_id', $empresa_id)->get();
        return Inertia::render('FormPacientes', compact('medicos'));
    }








    public function createPaciente(ValidateRequest $request) {
        $dados = $request->all();
        $dados['empresa_id'] = Auth::user()->empresa_id;

        $paciente =  Paciente::create($dados);

        foreach ($request->medico as $medico_id) {

            Medico_Paciente::create([
                'paciente_id' => $paciente->id,
                'medico_id' => $medico_id,
                'empresa_id' => Auth::user()->empresa_id,
            ]);

        DetalhePaciente::create([
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
        $paciente = Paciente::Find($id_paciente); // nome vue js 

        //$detalhes = DetalhesPacientes::where('paciente_id', $id_paciente)->where('medico_id', session('funcionario_id'))->first(); // filtra os detalhes do paciente escolhido, pelo ID do medico logado

        $detalhes = $paciente->detalhespacientes()->where('medico_id', session('funcionario_id'))->get();


        $tramites_paciente = Tramite::where('paciente_id', $id_paciente)->where('medico_id', session('funcionario_id'))->get()->toArray();
        return Inertia::render('DetalhesPacientes', compact('detalhes', 'tramites_paciente', 'paciente'));

    }







    public function createDetalhesPacientes(Request $request)
    {
        // Armazenar o valor de `id_paciente` da sessão para simplificação
        $pacienteId = FacadesSession::get('id_paciente');
    
        // Encontrar o registro existente e atualizar apenas os campos necessários
        DetalhePaciente::where('paciente_id', $pacienteId)->where('medico_id', session('funcionario_id'))
            ->update([
                'texto_principal' => $request->texto_principal,
                'arquivos' => $caminhoArquivosString ?? null,
            ]);
    }



public function createTramite(Request $request) {
    $dados = $request->all();
    $dados['paciente_id'] = FacadesSession::get('id_paciente');
    $dados['empresa_id'] = Auth::user()->empresa_id;
    $dados['medico_id'] = session('funcionario_id');
    Tramite::create($dados);
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
