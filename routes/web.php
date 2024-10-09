<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




Route::post('/create/login', [LoginController::class, 'criar_empresa_user']);
Route::post('/login/autenticate', [LoginController::class, 'autenticate']);
Route::get('/login/usuario', [LoginController::class, 'form_login'])->name('login');
Route::get('/login/cadastro', [LoginController::class, 'form_user_empresas']);
Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth', 'web'])->group(function () {
    
    Route::get('/', [DashboardController::class, 'index']);
    

    Route::get('/teste', function () {
        dd("deu bommmmmmmmmm");
    });
});



