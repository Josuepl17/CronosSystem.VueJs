<?php

use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Padrão Nomes Funções, primeira letra Minuscula e as Demais Maiusculas.
// Padrão Rotas, Form para Formularios, create, delete, edit, update para funções

Route::post('/create/user/empresas', [LoginController::class, 'createUserEmpresa']);
Route::post('/login', [LoginController::class, 'Authenticate']);
Route::get('/form/login', [LoginController::class, 'formLogin'])->name('login');
Route::get('/form/user/empresas', [LoginController::class, 'formUserEmpresa']);
Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth', 'web'])->group(function () {
    
    Route::get('/', [DashboardController::class, 'definirFilial']);
    Route::get('/dash', [DashboardController::class, 'index']);

    Route::get('/pacientes', [PacientesController::class, 'listaPacientes']);
    Route::get('/form/paciente', [PacientesController::class, 'formPacientes']);
    Route::get('/consultas', [ConsultasController::class, 'consultas']);
    

    Route::get('/teste', function () {
        dd("deu bommmmmmmmmm");
    });
});



