<?php

use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Empresas;
use App\Models\User_Empresas;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

// Padrão Nomes Funções, primeira letra Minuscula e as Demais Maiusculas.
// Padrão Rotas, Form para Formularios, create, delete, edit, update para funções

Route::post('/create/user/empresas', [LoginController::class, 'createUserEmpresa']);
Route::post('/login', [LoginController::class, 'Authenticate']);
Route::get('/form/login', [LoginController::class, 'formLogin'])->name('login');
Route::get('/form/user/empresas', [LoginController::class, 'formUserEmpresa']);
Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth', 'web'])->group(function () {
    
    //Dashboard
    Route::get('/dash', [DashboardController::class, 'index']);
    Route::get('/', [LoginController::class, 'definirFilial']);
    Route::get('/selecione/filial/{id}', [LoginController::class, 'mudarFilial']);
    
    // Pacientes

    Route::get('/pacientes', [PacientesController::class, 'listaPacientes']);
    Route::get('/form/paciente', [PacientesController::class, 'formPacientes']);
    Route::post('/create/paciente', [PacientesController::class, 'createPaciente']);
    Route::get('/detalhes/paciente/{id}', [PacientesController::class, 'sessionPaciente']);
    Route::get('/detalhes/paciente', [PacientesController::class, 'detalhesPacientes']);
    Route::post('/create/paciente/detalhes', [PacientesController::class, 'createDetalhesPacientes']);
    //Route::get('/download/paciente/detalhes', [PacientesController::class, 'downloadArquivo']);
    Route::post('/inserir/tramite', [PacientesController::class, 'createTramite']);

    // Medicos
    Route::get('/medicos', [MedicosController::class, 'listaMedicos']);
    Route::get('/form/medicos', [MedicosController::class, 'formMedicos']);
  

    
    


});



Route::post('/teste', function (Request $request) {
    dd($request->all());
});


Route::get('/gere', function(){
    $e = new Empresas();
    $e->razao_social = 'Empresa 5' ;
    $e->cnpj = rand(1, 100000);
    $e->save();

    $r = new User_Empresas();
    $r->user_id = 1;
    $r->empresa_id = $e->id;
    $r->save(); 

    return redirect('/dash');
});


