<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class DashboardController extends Controller{


public function definirFilial() {
    
    $razaoEmpresa = Empresas::find(Auth::user()->empresa_id);
    Session::put('empresa_id', $razaoEmpresa->razao_social );
    return redirect('/dash');
}



    public function index() {
        return Inertia::render('Dash');
    }
}
