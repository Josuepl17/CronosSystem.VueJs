<?php

namespace App\Http\Controllers;

use App\Models\ConsultaPaciente;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Paciente;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ConsultaController extends Controller
{

    





    public function listaConsultas() {
        $consultas = ConsultaPaciente::where('empresa_id', Session::get('empresa_id'))->orderBy('date', 'asc')->orderBy('hora', 'asc')->get();

        $consultas = MeuServico::Encrypted($consultas);
        return Inertia::render('Consultas', compact('consultas'));
    }






    public function formConsultas() {
        // Obtém o ID do funcionário logado (médico ou atendente) da sessão
        $funcionario_id = Session::get('id'); 
    
        // Verifica se o funcionário logado é um médico
        if ($medico = Medico::Find($funcionario_id)) { 
            // Se for um médico, obtém os pacientes associados a esse médico específico
            // e que pertencem à empresa selecionada na sessão
            $pacientes = $medico->pacientes()->where('pacientes.empresa_id', Session::get('empresa_id'))->get();
            // Obtém os dados do médico logado
            $medicos = Medico::where('id', $funcionario_id)->get();
        } else {
            // Se não for um médico (provavelmente um atendente), obtém todos os pacientes
            // que pertencem à empresa selecionada na sessão
            $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))->get();
            // Obtém os IDs dos usuários associados à empresa selecionada
            $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
            // Obtém os dados dos médicos que estão na lista de usuários da empresa
            $medicos = Medico::wherein('id', $users)->get(); 
        }


    
        
        return Inertia::render('FormConsultas', compact('medicos', 'pacientes'));
    }





   /* public function editConsulta(Request $request) {



        $consulta = ConsultaPaciente::find($request->id)->first();

        $funcionario_id = Session::get('id'); 
    
        // Verifica se o funcionário logado é um médico
        if ($medico = Medico::Find($funcionario_id)) { 
            // Se for um médico, obtém os pacientes associados a esse médico específico
            // e que pertencem à empresa selecionada na sessão
            $pacientes = $medico->pacientes()->where('pacientes.empresa_id', Session::get('empresa_id'))->get();
            // Obtém os dados do médico logado
            $medicos = Medico::where('id', $funcionario_id)->get();
        } else {
            // Se não for um médico (provavelmente um atendente), obtém todos os pacientes
            // que pertencem à empresa selecionada na sessão
            $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))->get();
            // Obtém os IDs dos usuários associados à empresa selecionada
            $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
            // Obtém os dados dos médicos que estão na lista de usuários da empresa
            $medicos = Medico::wherein('id', $users)->get(); 
        }

        return Inertia::render('FormConsultas', compact('consulta', 'medicos', 'pacientes'));
    } */


    public function destroyConsulta(Request $request) {
        $id = MeuServico::Decrypted($request->id);
        ConsultaPaciente::find($id)->delete();
        return redirect('/consultas');
        
    }

    public function cancelarConsulta(Request $request) {
       // dd($request->all());
        $id = MeuServico::Decrypted($request->identificacao);
        $consulta = ConsultaPaciente::find($id);
        $consulta->status = 'Cancelado';
        $consulta->motivo_status = $request->motivo;
        $consulta->save();
        return Inertia::location('/consultas');
    }

    public function concluirConsulta(Request $request) {
        $id = MeuServico::Decrypted($request->id);
        $consulta = ConsultaPaciente::find($id);
        $consulta->status = 'Concluido';
        $consulta->motivo_status = "Consulta concluída";
        $consulta->save();
        return redirect('/consultas');
    }









    public function createConsultas(Request $request) {
        $ConsultaPaciente = ConsultaPaciente::updateOrCreate(
            ['id' => $request->id],
            [
                'date' => $request->date,
                'hora' => $request->hora,
                'paciente_id' => $request->paciente_id,
                'medico_id' => $request->medico_id,
                'empresa_id' => Session::get('empresa_id'),
                'nome_paciente' => Paciente::find($request->paciente_id)->nome,
                'nome_medico' => Medico::find($request->medico_id)->nome,
                'contato' => Paciente::find($request->paciente_id)->email, // trocar por telefone
                'motivo_status' => "Aguardando atendimento",
            ]
        );

        return redirect('/consultas');
    }
}
