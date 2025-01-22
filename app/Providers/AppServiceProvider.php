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

                    'acessar_pacientes' => fn() => Auth::user() ? Auth::user()->permissoes->acessar_pacientes : false,
                    'acessar_medicos' => fn() => Auth::user() ? Auth::user()->permissoes->acessar_medicos : false,
                    'acessar_consultas' => fn() => Auth::user() ? Auth::user()->permissoes->acessar_consultas : false,
                    'acessar_empresa' => fn() => Auth::user() ? Auth::user()->permissoes->acessar_empresa : false,
                    'acessar_atendentes' => fn() => Auth::user() ? Auth::user()->permissoes->acessar_atendentes : false,
                    'inserir_paciente' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_paciente : false,
                    'inserir_medicos' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_medicos : false,
                    'inserir_consultas' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_consultas : false,
                    'inserir_empresa' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_empresa : false,
                    'inserir_atendentes' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_atendentes : false,
                    'editar_paciente' => fn() => Auth::user() ? Auth::user()->permissoes->editar_paciente : false,
                    'editar_medicos' => fn() => Auth::user() ? Auth::user()->permissoes->editar_medicos : false,
                    'editar_consultas' => fn() => Auth::user() ? Auth::user()->permissoes->editar_consultas : false,
                    'editar_empresa' => fn() => Auth::user() ? Auth::user()->permissoes->editar_empresa : false,
                    'editar_atendentes' => fn() => Auth::user() ? Auth::user()->permissoes->editar_atendentes : false,
                    'cancelar_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->cancelar_consulta : false,
                    'concluir_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->concluir_consulta : false,
                    'apagar_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->apagar_consulta : false,
                ]);

                Vite::prefetch(concurrency: 3);
            }
}
