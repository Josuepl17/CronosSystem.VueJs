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

    public function index() {
        return Inertia::render('Dash');
    }
}
