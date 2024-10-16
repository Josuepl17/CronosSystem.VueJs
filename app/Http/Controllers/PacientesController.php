<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Pacientes;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PacientesController extends Controller
{
    public function listaPacientes() {
        return Inertia::render('Pacientes');
    }

    public function formPacientes() {
        return Inertia::render('FormPacientes');
    }

    public function createPaciente(ValidateRequest $request) {
        $dados = Pacientes::create($request->all());
        dd($dados);
    }
}
