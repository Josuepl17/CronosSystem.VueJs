<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\ArquivoPaciente;
use App\Models\ConsultaPaciente;
use App\Models\DetalhePaciente;
use App\Models\Empresa;
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
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PacientesController extends Controller
{


    public function listaPacientes()
    {

        $funcionario_id = Session::get('id'); // Medico ou atendente Logado 

        if ($medico = Medico::Find($funcionario_id)) { // se existir é um medico, entrara em um filtro onde apresentará apenas os pacientes daquele medico especifico, e se for da empresa selecionada.

            $pacientes = $medico->pacientes()->where('pacientes.empresa_id', Session::get('empresa_id'))->get();
            
            // Mostra os pacientes com os IDs criptografados
            // Pelo relacionamento da tabela pivo ele encontra os pacientes relacionados com o medico Logado.
            // caso um dia precise, para os pacientes seja apresentado onde o medico estiver logado, precisa apemnas remover o where do filtro da empresa
        } else {

            $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))->get();
            // retorna todos os pacientes da empresa pois caiu no filtro de atendente
        }

        $pacientes = MeuServico::formatarDados($pacientes);

        MeuServico::Autorizer(); //responsavel para mostrar inserir paciente 

        return Inertia::render('Pacientes', compact('pacientes'));
    }










    public function buscaPaciente(Request $request) 
    {
        $funcionario_id = Session::get('id'); // Medico ou atendente logado
        $nomePaciente = $request->input('pesquisa'); // Nome do paciente a ser buscado
        
    
        if ($medico = Medico::find($funcionario_id)) { 
            // Médico logado — busca apenas os pacientes vinculados ao médico e à empresa atual
            $pacientes = $medico->pacientes()
            ->where('pacientes.empresa_id', Session::get('empresa_id'))
            ->when($nomePaciente, function ($query, $nomePaciente) {
                $query->whereRaw('LOWER(pacientes.nome) LIKE ?', ['%' . strtolower($nomePaciente) . '%']);
            })
            ->get();
        
        } else {
            // Atendente logado — busca todos os pacientes da empresa atual
            $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))
            ->when($nomePaciente, function ($query, $nomePaciente) {
                $query->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($nomePaciente) . '%']);
            })
            ->get();
        
        }
    
        $pacientes = MeuServico::Encrypted($pacientes);
        MeuServico::Autorizer(); // Responsável por mostrar ou inserir paciente
    
        return Inertia::render('Pacientes', compact('pacientes'));
    }
    




    



    public function formPacientes()
    {
        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
        $medicos = Medico::wherein('id', $users)->get(); // todos medicos da empresa logada
        return Inertia::render('FormPacientes', compact('medicos'));
    }









    public function createPaciente(ValidateRequest $request)
    {
        $dados = $request->all();

        $dados['empresa_id'] = Session::get('empresa_id');
        $paciente =  Paciente::create($dados); // cria o paciente

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








    public function sessionPaciente(Request $request)
    {
        FacadesSession::put('id_paciente', MeuServico::Decrypted($request->id));
        Session::forget('message');
        return redirect('/detalhes/paciente');
    }






    public function detalhesPacientes()
    {

        $id_paciente = FacadesSession::get('id_paciente');
        $paciente = Paciente::Find($id_paciente); // nome vue js 


        $arquivos = ArquivoPaciente::where('paciente_id', $id_paciente)->get(); 
        $arquivos = MeuServico::Encrypted($arquivos);


        $detalhes = $paciente->detalhespacientes()->where('medico_id', Session::get('id'))->first(); // retona Object

        if ($detalhes->texto_principal != null) {
            $texto_principal = Crypt::decrypt($detalhes->texto_principal);
            $detalhes->texto_principal = $texto_principal;
        }

        $consultas = $paciente->consultas()->where('medico_id', Session::get('id'))->where('status', "Agendado")->get(); // retorna array
        //dd($consultas);

        $tramites_paciente = $paciente->tramites()->where('medico_id', Session::get('id'))->get(); // retorna array 
        
        return Inertia::render('DetalhesPacientes', compact('detalhes', 'tramites_paciente', 'paciente',  'consultas', 'arquivos'));
    }





    public function createDetalhesPacientes(Request $request)
    {

        $pacienteId = FacadesSession::get('id_paciente');

        DetalhePaciente::where('paciente_id', $pacienteId)->where('medico_id', Session::get('id'))
            ->update([
                'texto_principal' => Crypt::encrypt($request->texto_principal),
                'arquivos' => $caminhoArquivosString ?? null,

            ]);

        Session::put('message', "Criado Com Sucesso ");

        return Inertia::location('/detalhes/paciente');

    }




    public function createTramite(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:25',
            'descricao' => 'required',
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais que 255 caracteres.',
            'descricao.required' => 'A descrição é obrigatória.',
        ]);

        $dados = $request->all();


        $id_consulta = $request->consulta;

        if($id_consulta){
            $consulta = ConsultaPaciente::Find($id_consulta)->first();
            $consulta->status = 'Concluido';
            $consulta->save();
        }
        
        $dados['paciente_id'] = FacadesSession::get('id_paciente');
        $dados['empresa_id'] = Session::get('empresa_id');
        $dados['medico_id'] = Session::get('id');
        Tramite::create($dados);

        Session::put('message', "Criado Com Sucesso ");

        return Inertia::location('/detalhes/paciente'); // faz ele recarregar a pagina
    }





    public function createArquivos(Request $request)
    {

        $request->validate([
            'arquivos' => 'required',

        ], [
            'arquivos.required' => 'Os arquivos são obrigatórios.',
        ]);

        
    
        $arquivos = $request->file('arquivos');
        $pacienteId = FacadesSession::get('id_paciente');

        $empresaId = Session::get('empresa_id');



        foreach ($arquivos as $arquivo){

            $path = $arquivo->store('files', 'public');

            ArquivoPaciente::create([
                'nome' => $arquivo->getClientOriginalName(),
                'path' => $path,
                'paciente_id' => $pacienteId,
                'empresa_id' => $empresaId,

            ]);


        }


        return Inertia::location('/detalhes/paciente');
    }



    public function downloadArquivo(Request $request)
    {
        $id = MeuServico::Decrypted($request->id);
        $arquivo = ArquivoPaciente::find($id);
        $filePath = storage_path('app/public/' . $arquivo->path);
        return response()->download($filePath, $arquivo->nome);
    }


}
