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
use PhpParser\Node\Expr\Cast\Object_;

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
        

        // PREPARA OS DADOS
     
        $dados['empresa_id'] = Auth::user()->empresa_id;
    
        $paciente =  Pacientes::create($dados);
    

        Detalhes_Pacientes::create([
            'paciente_id' => $paciente->id,
            'texto_principal' => "",
            'arquivos' => "",
            'empresa_id' => Auth::user()->empresa_id,
        ]);

        return redirect('/pacientes');
    }


    public function sessionPaciente(Request $request) {
        FacadesSession::put('id_paciente', $request->id);
        return redirect('/detalhes/paciente');
    }

    public function detalhesPacientes() {
        $id_paciente = FacadesSession::get('id_paciente');
        $detalhes = Detalhes_Pacientes::find($id_paciente);
       // dd($detalhes);
        return Inertia::render('DetalhesPacientes', compact('detalhes'));

    }

    public function createDetalhesPacientes(Request $request)
    {
        if ($request->arquivos !== null ) {
            foreach ($request->file('arquivos') as $file) {
                // Nome do arquivo
                $filename = $file->getClientOriginalName();
                
                // Caminho para armazenar o arquivo
                $destinationPath = public_path('uploads');
    
                // Move o arquivo para o caminho desejado
                $file->move($destinationPath, $filename);
                
                $caminhosArquivos[] = 'uploads/' . $filename;
                $caminhoArquivosString = is_array($caminhosArquivos) ? implode(',', $caminhosArquivos) : $caminhosArquivos;

            }
        }
    
        Detalhes_Pacientes::updateOrCreate(
            // CONDIÇÃO PARA ENCONTRAR O REGISTRO EXISTENTE
            ['paciente_id' => FacadesSession::get('id_paciente')],
    
            // DADOS PARA CRIAR OU ATUALIZAR O REGISTRO
            [
                'texto_principal' => $request->texto_principal,
                'paciente_id' => FacadesSession::get('id_paciente'),
                'empresa_id' => Auth::user()->empresa_id,
                'arquivos' => $caminhoArquivosString ?? null,
            ]
        );

}






public function downloadArquivo()
{
    // Caminho completo do arquivo
    $paciente = Detalhes_Pacientes::Find(FacadesSession::get('id_paciente'));
    $arquivos = $paciente->arquivos;
    $arquivos = explode(",", $arquivos);
    print_r($arquivos);


        foreach ($arquivos as $arquivo) {
           
          
            return response()->download($arquivo);
        
             
              
            }

      
}


}
