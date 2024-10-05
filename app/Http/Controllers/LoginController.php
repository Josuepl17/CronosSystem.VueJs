<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function form_user_empresas() {
        return Inertia::render('Form_User_Empresa');
    }

    public function form_login() {
        return Inertia::render('Login');
    }
}
