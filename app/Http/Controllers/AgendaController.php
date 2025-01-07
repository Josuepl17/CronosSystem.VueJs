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

class AgendaController extends Controller
{
    public function formAgenda()
    {
        $funcionario_id = Session::get('id'); 
    
        if ($medico = Medico::Find($funcionario_id)) { 
            $medicos = Medico::where('id', $funcionario_id)->get();
        } else {    
            $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
            $medicos = Medico::wherein('id', $users)->get(); 
        }

        $diasdasemana = [
            ['id' => 1, 'nome' => 'Domingo'],
            ['id' => 2, 'nome' => 'Segunda-feira'],
            ['id' => 3, 'nome' => 'Terça-feira'],
            ['id' => 4, 'nome' => 'Quarta-feira'],
            ['id' => 5, 'nome' => 'Quinta-feira'],
            ['id' => 6, 'nome' => 'Sexta-feira'],
            ['id' => 7, 'nome' => 'Sábado']
        ];

        return Inertia::render('FormAgendas', compact('medicos', 'diasdasemana'));
    }






public function createAgenda(Request $request) {

    $medico_id = $request->input('medico_id');
    $empresa_id = Session::get('empresa_id');

    $timeInicial = strtotime($request->input('timeinicial'));
    $timeFinal = strtotime($request->input('timefinal'));
    $tempoDeConsulta = (int) $request->input('tempodeconsulta') * 60; // Convert hours to minutes

   /* $horarios = [];
    for ($time = $timeInicial; $time < $timeFinal; $time += $tempoDeConsulta * 60) {
        $horarios[] = date('H:i', $time);
    } */

    $agenda = new Agenda();
    $agenda->medico_id = $medico_id;
    $agenda->empresa_id = $empresa_id;
    $agenda->timeinicial = $request->input('timeinicial');
    $agenda->timefinal = $request->input('timefinal');
    $agenda->tempodeconsulta = $request->input('tempodeconsulta');
    $agenda->save();

    return redirect('/form/agenda');




}










}




