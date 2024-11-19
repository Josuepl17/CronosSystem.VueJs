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
            'empresa_id' => fn() => Session::get('empresa_id'),
            'filiais' => fn() => Session::get('filiais'),
            'nome' => fn() => Session::get('nome'),
            'autorizaMedico' => fn() => Session::get('autorizaMedico'),
        ]);


        Vite::prefetch(concurrency: 3);
    }
}
