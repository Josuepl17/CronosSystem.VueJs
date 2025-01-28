<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardController;
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




Route::get('/', [DashboardController::class, 'index']);


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
    Route::post('/busca/atendentes', [PacientesController::class, 'buscaPaciente']);
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

    // Agenda


});

Route::post('/teste', function (Request $request) {
    dd($request->all());
    
});

Route::get('/teste2', function () {
    $teste = Auth::user()->permissoes->pluck('chave');
    dd($teste);
    
});

Route::get('/josue', function () {
    $filial_id = 2;
    $empresa_id = Empresa::where('filial_id', $filial_id)->pluck('id');
    $user_id = User_Empresa::whereIn('empresa_id', $empresa_id)->pluck('user_id');
    dd($user_id);
    $usuarios = Medico::whereIn('id', $user_id)->get();
});

Route::get('/gere', function () {
    $e = new Empresa();
    $e->razao_social = 'ESPAÇO INTEGRAR';
    $e->cnpj = rand(1, 100000);
    $e->ie = rand(1, 100000);
    $e->im = rand(1, 100000);
    $e->filial_id = 1;
    $e->telefone = 27996550967;
    $e->endereco = 'CENTRO';
    $e->cidade = 'BARRA DE SÃO FRANCISCO';
    $e->bairro = 'VILA LANDINHA';
    $e->save();

   $user =  User::create([
        'name' => "Administrador",
        'email' => "josuep.l@outlook.com",
        'password' => Hash::make(123456),
        'primeiro_acesso' => false,
        'empresa_id' => $e->id,
    ]);

    $r = new User_Empresa();
    $r->user_id = 1;
    $r->empresa_id = $e->id;
    $r->save();


    return redirect('/dash');
});

Route::get('/3', function () {
    $quantidade = 3; // Defina o número de registros que deseja criar

    for ($i = 0; $i < $quantidade; $i++) {
        // Criando um médico
        $d = new Medico();
        $d->nome = 'Henrique Dias ' . $i;
        $d->cpf = str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT);
        $d->crp = 'CRP-' . rand(1000, 9999);
        $d->especialidade = 'Psicologo';
        $d->telefone = rand(90000, 99999) . rand(1000, 9999);
        $d->email = 'henrique' . $i . '@gmail.com';
        $d->endereco = 'Rua Exemplo, ' . rand(1, 100);
        $d->cidade = 'Cidade Exemplo ' . rand(1, 5);
        $d->bairro = 'Bairro Exemplo ' . rand(1, 5);
        $d->save();

        // Criando um usuário relacionado ao médico
        $u = new User();
        $u->id = $d->id; // Relaciona o mesmo ID do médico ao usuário
        $u->name = 'Henriqueone ' . $i;
        $u->email = 'henrique' . $i . '@gmail.com';
        $u->primeiro_acesso = true;
        $u->password = Hash::make('1234');
        $u->empresa_id = 1;
        $u->save();

        // Criando o relacionamento entre usuário e empresa
        $h = new User_Empresa();
        $h->user_id = $d->id;
        $h->empresa_id = 1;
        $h->save();
    }

    return 'Registros criados com sucesso!';
});





Route::get('/4', function () {
    $quantidade = 2; // Defina o número de registros que deseja criar

    for ($i = 0; $i < $quantidade; $i++) {
        // Criando um paciente
        $d = new Paciente();
        $d->nome = 'Josue Lima ' . $i;
        $d->DataNascimento = now()->subYears(rand(18, 80))->format('Y-m-d'); // Data de nascimento aleatória
        $d->cpf = str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT); // CPF aleatório
        $d->email = 'josue' . $i . '@exemplo.com'; // E-mail único
        $d->cidade = 'Cidade Exemplo ' . rand(1, 5);
        $d->bairro = 'Bairro Exemplo ' . rand(1, 5);
        $d->empresa_id = 1; // ID da empresa aleatório
        $d->telefone = rand(90000, 99999) . rand(1000, 9999); // Telefone aleatório
        $d->save();

        Medico_Paciente::create([ // faz o relacionamento dos medicos selecionados com o paciente criado
            'paciente_id' => $d->id,
            'medico_id' => 1000,
            'empresa_id' => 1,
        ]);


    }


    return 'Registros criados com sucesso!';
});



Route::get('/5', function () {
    $quantidade = 15; // Defina o número de registros que deseja criar

    for ($i = 0; $i < $quantidade; $i++) {
        // Criando um paciente
        $d = new Atendente();
        $d->nome = 'Atendente ' . $i; // Nome único
        $d->cpf = str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT); // CPF aleatório com 11 dígitos
        $d->telefone = rand(90000, 99999) . rand(1000, 9999); // Telefone aleatório
        $d->email = 'Atendente' . $i . '@exemplo.com'; // E-mail único
        $d->endereco = 'Rua Exemplo, ' . rand(1, 100); // Endereço fictício
        $d->cidade = 'Cidade Exemplo ' . rand(1, 5); // Cidade fictícia
        $d->bairro = 'Bairro Exemplo ' . rand(1, 5); // Bairro fictício
        $d->save();
    }

    $u = new User();
    $u->id = $d->id; // Relaciona o mesmo ID do médico ao usuário
    $u->name = 'Atendente ' . $i;
    $u->email = 'Atendente' . $i . '@gmail.com';
    $u->primeiro_acesso = true;
    $u->password = Hash::make('1234');
    $u->empresa_id = 1;
    $u->save();

    $h = new User_Empresa();
    $h->user_id = $d->id;
    $h->empresa_id = 1;
    $h->save();

    return 'Registros criados com sucesso!';
});










