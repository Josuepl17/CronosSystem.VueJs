<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateRequest;
use App\Models\Medicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MedicosController extends Controller
{
    public function listaMedicos() {
        $empresa_id = Auth::user()->empresa_id;
        $medicos = Medicos::where('empresa_id', $empresa_id)->get();
        return Inertia::render('Medicos', compact('medicos'));
    }

    public function formMedicos() {
        return Inertia::render('FormMedicos');
    }



    public function createMedicos(ValidateRequest $request) {
        $dados = $request->all();
        $dados['empresa_id'] = Auth::user()->empresa_id;
         Medicos::create($dados);
        return redirect('/medicos');
    }
}
