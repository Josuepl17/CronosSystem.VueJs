<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\User_Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller{

public function mudarFilial(Request $request) {
         $usuario = Auth::user();
        $usuario->empresa_id = $request->id;
        return redirect('/');   
}    


public function definirFilial() {

        $user_id = Auth::user()->id;
        $relacionamentos = User_Empresas::where('user_id', $user_id)->pluck('empresa_id');
        $filiais = Empresas::whereIn('id', $relacionamentos)->get();
        Session::put('filiais', $filiais);

        $razaoEmpresa = Empresas::find(Auth::user()->empresa_id);
        Session::put('empresa_id', $razaoEmpresa->razao_social );
    
         return redirect('/dash');
}



    public function index() {
        return Inertia::render('Dash');
    }
}
