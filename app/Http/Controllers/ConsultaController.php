<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
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

    public function listaConsultas()
    {

        if ($medico = MeuServico::VerificarMedico()) {
            $consultas = $medico->consultas()->orderByRaw("
            CASE 
                WHEN status = 'Agendado' THEN 1
                WHEN status = 'Concluido' THEN 2
                WHEN status = 'Cancelado' THEN 3
                ELSE 4
            END
        ")
                ->orderBy('date', 'asc')
                ->orderBy('hora', 'asc')
                ->get();
        } else {

            $consultas = ConsultaPaciente::where('empresa_id', Session::get('empresa_id'))->orderByRaw("
            CASE 
                WHEN status = 'Agendado' THEN 1
                WHEN status = 'Concluido' THEN 2
                WHEN status = 'Cancelado' THEN 3
                ELSE 4
            END
        ")
                ->orderBy('date', 'asc')
                ->orderBy('hora', 'asc')
                ->get();
        }


        $consultas = MeuServico::Encrypted($consultas);

        return Inertia::render('Consultas', compact('consultas'));
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



      /*  $timeInicial = Agenda::where('medico_id', $funcionario_id)->value('timeinicial'); // Exemplo: '08:00'
        $timeFinal = Agenda::where('medico_id', $funcionario_id)->value('timefinal');     // Exemplo: '17:00'
        $tempoDeConsulta = Agenda::where('medico_id', $funcionario_id)->value('tempodeconsulta');
        dd($tempoDeConsulta);

        // Converte o tempo de consulta de "H:i" para minutos
        list($hours, $minutes) = explode(':', $tempoDeConsulta);
        $tempoDeConsulta = $hours * 60 + $minutes;


        // Verifique se todos os valores foram recuperados corretamente
        if (!$timeInicial || !$timeFinal || !$tempoDeConsulta) {
            return response()->json(['error' => 'Dados não encontrados corretamente.'], 400);
        }

        $current = strtotime($timeInicial);
        $end = strtotime($timeFinal);


        $horarios = [];

        while ($current < $end) {
            // Adiciona o horário formatado ao array (sem segundos)
            $horarios[] = date('H:i', $current);

            // Adiciona o tempo de consulta ao horário atual (em minutos)
            $current = strtotime("+$tempoDeConsulta minutes", $current);

            // Verifica se a nova hora é válida
            if ($current === false) {
                dd("Erro ao calcular o próximo horário com strtotime()", $current);
            }
        } */

        
        $horarios = [
            '08:00', '08:30', '09:00', '09:30', 
            '10:00', '10:30', '11:00', '11:30', 
            '12:00', '12:30', '13:00', '13:30', 
            '14:00', '14:30', '15:00', '15:30', 
            '16:00', '16:30', '17:00'
        ];

        return Inertia::render('FormConsultas', compact('medicos', 'pacientes', 'horarios'));
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
