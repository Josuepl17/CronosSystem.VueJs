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
                    'acessar_empresas' => fn() => Auth::user() ? Auth::user()->permissoes->acessar_empresas : false,
                    'acessar_atendentes' => fn() => Auth::user() ? Auth::user()->permissoes->acessar_atendentes : false,

                    'inserir_paciente' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_paciente : false,
                    'inserir_medico' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_medico : false,
                    'inserir_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_consulta : false,
                    'inserir_empresa' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_empresa : false,
                    'inserir_atendente' => fn() => Auth::user() ? Auth::user()->permissoes->inserir_atendente : false,
                    'editar_paciente' => fn() => Auth::user() ? Auth::user()->permissoes->editar_paciente : false,
                    'editar_medico' => fn() => Auth::user() ? Auth::user()->permissoes->editar_medico : false,
                    'editar_empresa' => fn() => Auth::user() ? Auth::user()->permissoes->editar_empresa : false,
                    'editar_atendente' => fn() => Auth::user() ? Auth::user()->permissoes->editar_atendente : false,
                    'cancelar_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->cancelar_consulta : false,
                    'concluir_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->concluir_consulta : false,
                    'apagar_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->apagar_consulta : false,
                ]);

                Vite::prefetch(concurrency: 3);
            }
}
