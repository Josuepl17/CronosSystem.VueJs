<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GerenciaController;
use App\Http\Controllers\GerentesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacientesController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\PermissoesMiddleware;
use App\Models\Atendente;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Medico_Paciente;
use App\Models\Paciente;
use App\Models\Permissao;
use App\Models\RelatoriosPaciente;
use App\Models\User;
use App\Models\User_Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Padrão Nomes Funções, primeira letra Minuscula e as Demais Maiusculas.
// Padrão Rotas, Form para Formularios, create, delete, edit, update para funções

Route::get('/', [DashboardController::class, 'index']);


Route::post('/create/user/empresas', [LoginController::class, 'createUserEmpresa']);
Route::post('/login', [LoginController::class, 'Authenticate']);
Route::get('/form/login', [LoginController::class, 'formLogin'])->name('login');
Route::get('/form/user/empresas', [LoginController::class, 'formUserEmpresa']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/gerenciar/filial', [LoginController::class, 'gerenciarFiliais']);
Route::get('/editar/filial/{id}', [LoginController::class, 'editarFilial']);
Route::post('/update/filial', [LoginController::class, 'updateFilial']);
Route::get('/atualizar/senha', [LoginController::class, 'formSenha']);
Route::post('/update/senha', [LoginController::class, 'updateSenha']);
Route::get('/contato', [LoginController::class, 'contato']);
Route::get('/form/verificar/consulta', [ConsultaController::class, 'formVerificarConsulta']); // LiNK para Paciente
Route::post('/verificar/consulta', [ConsultaController::class, 'VerificarConsulta']); // LiNK para Paciente






Route::middleware(['auth', 'web'])->group(function () {

    Route::get('/dash', [DashboardController::class, 'dahsboard']);
    Route::get('/definir/filial', [LoginController::class, 'definirFilial']);
    Route::get('/selecione/filial/{id}', [LoginController::class, 'mudarFilial']);

    // Pacientes
    Route::get('/pacientes', [PacientesController::class, 'listaPacientes'])->middleware(PermissoesMiddleware::class);
    Route::get('/form/paciente', [PacientesController::class, 'formPacientes'])->middleware(PermissoesMiddleware::class);
    Route::post('/create/paciente', [PacientesController::class, 'createPaciente']);
    Route::get('/detalhes/paciente/{id}', [PacientesController::class, 'sessionPaciente']);
    Route::get('/detalhes/paciente', [PacientesController::class, 'detalhesPacientes']);
    Route::get('/editar/paciente/{id}', [PacientesController::class, 'editarPacinte'])->middleware(PermissoesMiddleware::class);
    Route::post('/create/paciente/detalhes', [PacientesController::class, 'createDetalhesPacientes']);
    Route::post('/create/medicamento', [PacientesController::class, 'createMedicamentos']);
    Route::get('/delete/medicamento/{id}', [PacientesController::class, 'deleteMedicamentos']);
    Route::post('/create/relatorio', [PacientesController::class, 'createRelatorio']);

    // Route::get('/download/paciente/detalhes', [PacientesController::class, 'downloadArquivo']);
    Route::post('/inserir/tramite', [PacientesController::class, 'createTramite']);
    Route::post('/busca/pacientes', [PacientesController::class, 'buscaPaciente']);
    Route::post('/create/arquivos', [PacientesController::class, 'createArquivos']);
    Route::get('/download/arquivo/{id}', [PacientesController::class, 'downloadArquivo']);

    // Medicos
    Route::get('/medicos', [MedicosController::class, 'listaMedicos'])->middleware(PermissoesMiddleware::class);
    Route::get('/form/medicos', [MedicosController::class, 'formMedicos'])->middleware(PermissoesMiddleware::class);
    Route::post('/create/medico', [MedicosController::class, 'createMedicos']);
    Route::get('/edit/medico/{id}', [MedicosController::class, 'editMedicos'])->middleware(PermissoesMiddleware::class);

    // Atendentes
    Route::get('/atendentes', [AtendenteController::class, 'listaAtendentes'])->middleware(PermissoesMiddleware::class);
    Route::get('/form/atendentes', [AtendenteController::class, 'formAtendentes'])->middleware(PermissoesMiddleware::class);
    Route::post('/create/atendentes', [AtendenteController::class, 'createAtendente']);
    Route::get('/edit/atendentes/{id}', [AtendenteController::class, 'editAtendente'])->middleware(PermissoesMiddleware::class);

    // User
    Route::post('/create/vinculo/user', [LoginController::class, 'createVinculoUser']);
    Route::post('/remove/vinculo/user', [LoginController::class, 'removeVinculoUser']);

    // Consultas
    Route::get('/consultas', [ConsultaController::class, 'listaConsultas'])->middleware(PermissoesMiddleware::class);
    Route::post('/filtro/consulta', [ConsultaController::class, 'filtroConsulta']);
    Route::get('/form/consultas', [ConsultaController::class, 'formConsultas'])->middleware(PermissoesMiddleware::class);
    Route::post('/create/consulta', [ConsultaController::class, 'createConsultas']);
    Route::get('/delete/consulta/{id}', [ConsultaController::class, 'destroyConsulta'])->middleware(PermissoesMiddleware::class);
    Route::post('/cancelar/consulta', [ConsultaController::class, 'cancelarConsulta'])->middleware(PermissoesMiddleware::class);
    Route::get('/concluir/consulta/{id}', [ConsultaController::class, 'concluirConsulta'])->middleware(PermissoesMiddleware::class);

    // Gerencia
    Route::get('/gerentes', [GerentesController::class, 'gerencia']);
    Route::get('/form/gerente', [GerentesController::class, 'formGerencia']);
    Route::post('/create/gerente', [GerentesController::class, 'createGerente']);
    Route::get('/edit/gerente/{id}', [GerentesController::class, 'editGerente']);

    // Funções

    Route::get('/pdf/{id}', function ( Request $request) {

        $relatorio =  RelatoriosPaciente::find($request->id);
    
        $data = [ 
            'prescricao' => Crypt::decrypt($relatorio->prescricao),
            'medico' => Medico::Find(Session::get('id')),
            'empresa' => Empresa::find(Session::get('empresa_id')),
            'tipoDocumento' => $relatorio->tipo_documento,
        ];
    
    
        $pdf = Pdf::loadView('pdfreceituario', $data);
        return $pdf->download('documento.pdf');
    });


});

























