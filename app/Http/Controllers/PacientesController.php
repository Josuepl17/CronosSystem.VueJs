<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\DetalhePaciente;
use App\Models\Medico_Paciente;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Tramite;
use App\Services\MeuServico;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session as FacadesSession;
use Inertia\Inertia;

class PacientesController extends Controller
{

    

    public function listaPacientes() {

       $funcionario_id = Session::get('id'); // Medico ou atendente Logado 

        if ($medico = Medico::Find($funcionario_id) ){// se existir é um medico, entrara em um filtro onde apresentará apenas os pacientes daquele medico especifico, e se for da empresa selecionada.
         

        $pacientes = $medico->pacientes()->where('pacientes.empresa_id', Session::get('empresa_id'))->get();
            // Pelo relacionamento da tabela pivo ele encontra os pacientes relacionados com o medico Logado.
            // caso um dia precise, para os pacientes seja apresentado onde o medico estiver logado, precisa apemnas remover o where do filtro da empresa
        } else{
            
            $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))->get();
            // retorna todos os pacientes da empresa pois caiu no filtro de atendente
        }

        MeuServico::Autorizer(); //responsavel para mostrar inserir paciente 
         
        return Inertia::render('Pacientes', compact('pacientes'));
       
    }






    

    public function formPacientes() {
        $medicos = Medico::where('empresa_id', Session::get('empresa_id'))->get();// todos medicos da empresa logada
        return Inertia::render('FormPacientes', compact('medicos'));
    }








    public function createPaciente(ValidateRequest $request) {
        $dados = $request->all();

        $dados['empresa_id'] = Session::get('empresa_id');

        $paciente =  Paciente::create($dados);// cria o paciente

        foreach ($request->medico as $medico_id) {

            Medico_Paciente::create([ // faz o relacionamento dos medicos selecionados com o paciente criado
                'paciente_id' => $paciente->id,
                'medico_id' => $medico_id,
                'empresa_id' => Session::get('empresa_id'),
            ]);

        DetalhePaciente::create([ // dados importantes para primeira consulta 
                'paciente_id' => $paciente->id,
                'texto_principal' => '',
                'arquivos' => "",
                'date_cad' => Carbon::now(),
                'empresa_id' => Session::get('empresa_id'),
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

        //$detalhes = DetalhesPacientes::where('paciente_id', $id_paciente)->where('medico_id', session('id'))->first(); // filtra os detalhes do paciente escolhido, pelo ID do medico logado

        //$detalhes = $paciente->detalhespacientes()->where('medico_id', session('id'))->get();

        $detalhes = $paciente->detalhespacientes()->where('medico_id', Session::get('id'))->first(); // retona Object


        $tramites_paciente = $paciente->tramites()->where('medico_id', Session::get('id'))->get(); // retorna array 
        // Tramite::where('paciente_id', $id_paciente)->where('medico_id', session('id'))->get()->toArray();
        return Inertia::render('DetalhesPacientes', compact('detalhes', 'tramites_paciente', 'paciente'));

    }





    public function createDetalhesPacientes(Request $request)
    {
        // Armazenar o valor de `id_paciente` da sessão para simplificação
        $pacienteId = FacadesSession::get('id_paciente');
    
        // Encontrar o registro existente e atualizar apenas os campos necessários
        DetalhePaciente::where('paciente_id', $pacienteId)->where('medico_id', Session::get('id'))
            ->update([
                'texto_principal' => Crypt::encrypt($request->texto_principal), 
                'arquivos' => $caminhoArquivosString ?? null,
            
            ]);
    }



public function createTramite(Request $request) {
    $dados = $request->all();
    $dados['paciente_id'] = FacadesSession::get('id_paciente');
    $dados['empresa_id'] = Session::get('empresa_id');
    $dados['medico_id'] = Session::get('id');
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
