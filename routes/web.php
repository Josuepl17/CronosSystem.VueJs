<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [DashboardController::class, 'dashboard'])->name('Dashboard')->middleware(AuthMiddleware::class);


Route::get('/login/cadastro', [LoginController::class, 'form_user_empresas']);
Route::get('/login/usuario', [LoginController::class, 'form_login'])->name('login');