<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Inertia::share([
            'razao_social' => fn() => Session::get('razao_social'),
            'filiais' => fn() => Session::get('filiais'),
            'nome' => fn() => Session::get('nome'),
            'autorizaMedico' => fn() => Session::get('autorizaMedico'),
            'adm' => fn() => Session::get('adm'),
            'message' => fn() => Session::get('message'),
        ]);


        Vite::prefetch(concurrency: 3);
    }
}
