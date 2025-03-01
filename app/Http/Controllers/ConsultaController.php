<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\ConsultaPaciente;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Medico_Paciente;
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
        return Inertia::render('Consultas/VerificarConsulta');
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
        Session::put('date_inicial', $request->date_inicial);
        Session::put('date_final', $request->date_final);
        return redirect('/consultas');
    }



    public function listaConsultas()
    {
        $date_inicial = Session::get('date_inicial') ?? Carbon::now()->toDateString();
        $date_final = Session::get('date_final') ?? Carbon::now()->toDateString();
        
        $consultas =  ServicesConsulta::ListarConsultas($date_inicial, $date_final);
        $consultas = ServiceGeral::CriptograrArrayID($consultas);


        return Inertia::render('Consultas/Consultas', compact('consultas', 'date_inicial', 'date_final'));
    }






    public function formConsultas()
    {

        $funcionario_id = Session::get('id');
        $medicos = ServiceGeral::getMedicoLogadoOuTodos();
        $pacientes = ServiceGeral::listarPacientes(Session::get('empresa_id'));
        $relacoes = Medico_Paciente::all();
        return Inertia::render('Consultas/FormConsultas', compact('medicos', 'pacientes',  'relacoes'));;
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

        $existeConsulta =  ServicesConsulta::VerificarAgendamento($request);

        if ($existeConsulta) {
            return back()->withErrors([
                'hora' => "Já existe uma consulta agendada para esse médico as  {$existeConsulta->horainicial} até as {$existeConsulta->horafinal}."
            ])->withInput();
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
