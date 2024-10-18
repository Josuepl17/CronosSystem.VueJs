<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicosController extends Controller
{
    public function listaMedicos() {
     
       return Inertia::render('Medicos');
    }

    public function formMedicos() {
        return Inertia::render('FormMedicos');
    }
}
