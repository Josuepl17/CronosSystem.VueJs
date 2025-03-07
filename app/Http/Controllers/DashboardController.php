<?php

namespace App\Http\Controllers;

use App\Models\ConsultaPaciente;
use App\Models\Empresa;
use App\Models\Empresas;
use App\Models\Paciente;
use App\Models\User_Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller{

    public function dahsboard() {
        $id = Session::get('empresa_id');
        $pacientes = Paciente::where('empresa_id', $id)->get()->count();
        $consultasAgendadas = ConsultaPaciente::where('empresa_id', $id)->where('status', 'Agendado')->get()->count();
        $consultasConcluidos = ConsultaPaciente::where('empresa_id', $id)->where('status', 'Concluido')->get()->count();
        $consultasCanceladas = ConsultaPaciente::where('empresa_id', $id)->where('status', 'Cancelado')->get()->count();
        return Inertia::render('Dash', compact('pacientes', 'consultasAgendadas', 'consultasConcluidos', 'consultasCanceladas'));
    }
    

    public function index() {
        return Inertia::render('index');
    }
}
