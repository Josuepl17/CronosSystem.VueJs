<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Atendente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AtendenteController extends Controller
{
    public function listaAtendentes() {
        $atendentes = Atendente::where('empresa_id', Session::get('empresa_id'))->get();;
        return Inertia::render('Atendentes', compact('atendentes'));
    }

    


    public function formAtendentes() {
        return Inertia::render('FormAtendentes');
    }



    public function createAtendente(ValidateRequest $request) {
        $dados = $request->all();

        $dados['empresa_id'] = Session::get('empresa_id');

        $paciente =  Atendente::create($dados);

       
        return $this->listaAtendentes();
    }
}
