<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [DashboardController::class, 'dashboard'])->name('Dashboard');
Route::get('/login', function(){
    return inertia::render('Login');
});

Route::get('/login/cadastro', function(){
    return inertia::render('Form_User_Empresa');
});