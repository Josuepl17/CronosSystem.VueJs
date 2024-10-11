<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller{


public function definirFilial() {

    Session()->put('filialSelecionada', Auth::user()->empresa->id);
}



    public function index() {
        return Inertia::render('Dash');
    }
}
