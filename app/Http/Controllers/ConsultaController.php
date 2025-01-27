<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\ConsultaPaciente;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Paciente;
use App\Services\MeuServico;
use App\Services\ServiceGeral;
use App\Services\ServicesConsulta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ConsultaController extends Controller
{

    public function formVerificarConsulta()
    {
        return Inertia::render('VerificarConsulta');
    }







    public function VerificarConsulta(Request $request)
    {
        $dados = preg_replace('/[^0-9]/', '', $request->cpf);
        
           $paciente = Paciente::where('cpf', $dados)->first();

        if (!$paciente) {
            return back()->withErrors(['cpf' => 'CPF não encontrado.'])->withInput();
        }

        $consultas = ConsultaPaciente::where('paciente_id', $paciente->id)->where('status', 'Agendado')->get();
        return Inertia::render('VerificarConsulta', compact('consultas'));
    }











    public function filtroConsulta(Request $request)
    {
        Session::put('dataconsulta', $request->date);
        return redirect('/consultas');
    }



    public function listaConsultas()
    {
        $date = Session::get('dataconsulta') ?? Carbon::now()->toDateString();
        
        $consultas =  ServicesConsulta::ListarConsultas($date);
        $consultas = ServiceGeral::CriptograrArrayID($consultas);

        return Inertia::render('Consultas', compact('consultas', 'date'));
    }






    public function formConsultas()
    {

        $funcionario_id = Session::get('id');
        $medicos = ServiceGeral::getMedicoLogadoOuTodos();
        $pacientes = ServiceGeral::listarPacientes(Session::get('empresa_id'));
        return Inertia::render('FormConsultas', compact('medicos', 'pacientes'));
    }







    public function destroyConsulta(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        ConsultaPaciente::find($id)->delete();
        return redirect('/consultas');
    }



    public function cancelarConsulta(Request $request)
    {
        $id = Crypt::decrypt($request->identificacao);
        $consulta = ConsultaPaciente::find($id);
        $consulta->status = 'Cancelado';
        $consulta->motivo_status = $request->motivo;
        $consulta->save();
        return Inertia::location('/consultas');
    }



    public function concluirConsulta(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $consulta = ConsultaPaciente::find($id);
        $consulta->status = 'Concluido';
        $consulta->motivo_status = "Consulta concluída";
        $consulta->save();
        return redirect('/consultas');
    }






    public function createConsultas(Request $request)
    {

        $medico = Medico::find($request->medico_id);

       $existeCosnulta =  ServicesConsulta::VerificarAgendamento($request);
       
       if ($existeCosnulta) {
        return back()->withErrors(['hora' => 'Já existe uma consulta agendada para este médico nesta data e hora.'])->withInput();
    }

        $ConsultaPaciente = ConsultaPaciente::updateOrCreate(
            ['id' => $request->id],
            [
                'date' => $request->date,
                'horainicial' => $request->horainicial,
                'horafinal' => $request->horafinal,
                'paciente_id' => $request->paciente_id,
                'medico_id' => $request->medico_id,
                'empresa_id' => Session::get('empresa_id'),
                'nome_paciente' => Paciente::find($request->paciente_id)->nome,
                'nome_medico' => Medico::find($request->medico_id)->nome . ' (' . $medico->especialidade . ')',
                'contato' => Paciente::find($request->paciente_id)->email, // trocar por telefone
                'motivo_status' => "Aguardando atendimento",
            ]
        );

        return redirect('/consultas');
    }
}
