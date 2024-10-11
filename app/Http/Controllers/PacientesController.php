<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PacientesController extends Controller
{
    public function listaPacientes() {
        return Inertia::render('Pacientes');
    }
}
