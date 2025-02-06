<?php

namespace App\Providers;

use App\Models\ConsultaPaciente;
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

                    
                    'consultas' => fn() => Session::get('consultas'),
                    

                    

                    'acessar_pacientes' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('acessar_pacientes') : false,
                    'acessar_profissional' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('acessar_profissional') : false,
                    'acessar_consultas' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('acessar_consultas') : false,
                    'acessar_atendentes' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('acessar_atendentes') : false,
                    'inserir_paciente' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('inserir_paciente') : false,
                    'inserir_profissional' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('inserir_profissional') : false,
                    'inserir_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('inserir_consulta') : false,
                    'inserir_atendente' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('inserir_atendente') : false,
                    'editar_paciente' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('editar_paciente') : false,
                    'editar_profissional' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('editar_profissional') : false,
                    'editar_atendente' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('editar_atendente') : false,
                    'cancelar_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('cancelar_consulta') : false,
                    'concluir_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('concluir_consulta') : false,  
                    'apagar_consulta' => fn() => Auth::user() ? Auth::user()->permissoes->pluck('chave')->contains('apagar_consulta') : false,    
                
                ]);
                Vite::prefetch(concurrency: 3);
            }
}
