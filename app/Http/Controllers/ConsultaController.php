<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\ConsultaPaciente;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Paciente;
use App\Services\MeuServico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ConsultaController extends Controller
{

    public function formVerificarConsulta() {
        return Inertia::render('VerificarConsulta');
    }

    public function VerificarConsulta(Request $request) {
        $paciente = Paciente::where('cpf', $request->cpf)->first();

        if (!$paciente) {
            return back()->withErrors(['cpf' => 'CPF não encontrado.'])->withInput();
        }

        $consultas = ConsultaPaciente::where('paciente_id', $paciente->id)->where('status', 'Agendado')->get();
        return Inertia::render('VerificarConsulta', compact('consultas'));
    }





    public function filtroConsulta(Request $request) {
        Session::put('dataconsulta', $request->date);
        return redirect('/consultas');
    }



    public function listaConsultas()
    {
        $date = Session::get('dataconsulta') ?? Carbon::now()->toDateString();


        if ($medico = MeuServico::VerificarMedico()) {
            $consultas = $medico->consultas()
            ->whereDate('date', $date)
            ->orderByRaw("
            CASE 
            WHEN status = 'Agendado' THEN 1
            WHEN status = 'Concluido' THEN 2
            WHEN status = 'Cancelado' THEN 3
            ELSE 4
            END
        ")
            ->orderBy('date', 'asc')
            ->orderBy('horainicial', 'asc')
            ->get();
        } else {

            $consultas = ConsultaPaciente::where('empresa_id', Session::get('empresa_id'))
            ->whereDate('date', $date)
            ->orderByRaw("
            CASE 
            WHEN status = 'Agendado' THEN 1
            WHEN status = 'Concluido' THEN 2
            WHEN status = 'Cancelado' THEN 3
            ELSE 4
            END
        ")
            ->orderBy('date', 'asc')
            ->orderBy('horainicial', 'asc')
            ->get();
        }


        $consultas = MeuServico::Encrypted($consultas);

        return Inertia::render('Consultas', compact('consultas', 'date'));
    }






    public function formConsultas()
    {

        $funcionario_id = Session::get('id');


        if ($medico = MeuServico::VerificarMedico()) {

            $pacientes = $medico->pacientes()->get();
            $medicos = Medico::where('id', $funcionario_id)->get();
            
        } else {

            $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))->get();

            $users_id = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');

            $medicos = Medico::wherein('id', $users_id)->get();
        }

        
        $horarios = [
            '08:00', '08:30', '09:00', '09:30', 
            '10:00', '10:30', '11:00', '11:30', 
            '12:00', '12:30', '13:00', '13:30', 
            '14:00', '14:30', '15:00', '15:30', 
            '16:00', '16:30', '17:00'
        ];

        return Inertia::render('FormConsultas', compact('medicos', 'pacientes'));
    }







    public function destroyConsulta(Request $request)
    {
        $id = MeuServico::Decrypted($request->id);
        ConsultaPaciente::find($id)->delete();
        return redirect('/consultas');
    }

    public function cancelarConsulta(Request $request)
    {
        // dd($request->all());
        $id = MeuServico::Decrypted($request->identificacao);
        $consulta = ConsultaPaciente::find($id);
        $consulta->status = 'Cancelado';
        $consulta->motivo_status = $request->motivo;
        $consulta->save();
        return Inertia::location('/consultas');
    }

    public function concluirConsulta(Request $request)
    {
        $id = MeuServico::Decrypted($request->id);
        $consulta = ConsultaPaciente::find($id);
        $consulta->status = 'Concluido';
        $consulta->motivo_status = "Consulta concluída";
        $consulta->save();
        return redirect('/consultas');
    }






    public function createConsultas(Request $request)
    {

            $existingConsulta = ConsultaPaciente::where('date', $request->date)
                ->where('medico_id', $request->medico_id)
                ->where('status', 'Agendado')
                ->where(function ($query) use ($request) {
                    $query->whereBetween('horainicial', [$request->horainicial, $request->horafinal])
                          ->orWhereBetween('horafinal', [$request->horainicial, $request->horafinal])
                          ->orWhere(function ($query) use ($request) {
                              $query->where('horainicial', '<=', $request->horainicial)
                                    ->where('horafinal', '>=', $request->horafinal);
                          });
                })
                ->first();

        if ($existingConsulta) {
            return back()->withErrors(['hora' => 'Já existe uma consulta agendada para este médico nesta data e hora.'])->withInput();
        }


        $medico = Medico::find($request->medico_id);


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
