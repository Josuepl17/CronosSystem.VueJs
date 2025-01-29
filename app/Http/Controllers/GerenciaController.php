<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GerenciaController extends Controller
{
    
    public function gerencia()
    {
        return Inertia::render('Gerencia');
    }
}
