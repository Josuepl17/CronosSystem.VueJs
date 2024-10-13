<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ConsultasController extends Controller
{
    public function consultas() {
        return Inertia::render('Consultas');
    }
}
