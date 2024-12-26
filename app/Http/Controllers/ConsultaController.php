<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function listaConsultas() {
        return Inertia::render('Consultas');
    }

    public function formConsultas() {

        $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
        $medicos = Medico::wherein('id', $users)->get(); // todos medicos da empresa logada

        $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))->get();///////////

        return Inertia::render('FormConsultas', compact('medicos', 'pacientes'));
    }
}
