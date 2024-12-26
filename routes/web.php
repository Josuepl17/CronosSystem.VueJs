<?php

use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Empresa;
use App\Models\Empresas;
use App\Models\Medico;
use App\Models\User;
use App\Models\User_Empresa;
use App\Models\User_Empresas;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Padrão Nomes Funções, primeira letra Minuscula e as Demais Maiusculas.
// Padrão Rotas, Form para Formularios, create, delete, edit, update para funções

Route::post('/create/user/empresas', [LoginController::class, 'createUserEmpresa']);
Route::post('/login', [LoginController::class, 'Authenticate']);
Route::get('/form/login', [LoginController::class, 'formLogin'])->name('login');
Route::get('/form/user/empresas', [LoginController::class, 'formUserEmpresa']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/gerenciar/filial', [LoginController::class, 'gerenciarFiliais']);
Route::get('/editar/filial/{id}', [LoginController::class, 'editarFilial']);


Route::middleware(['auth', 'web'])->group(function () {
    
    //Dashboard
    Route::get('/dash', [DashboardController::class, 'index']);
    Route::get('/', [LoginController::class, 'definirFilial']);
    Route::get('/selecione/filial/{id}', [LoginController::class, 'mudarFilial']);
    
    // Pacientes

    Route::get('/pacientes', [PacientesController::class, 'listaPacientes']);
    Route::get('/form/paciente', [PacientesController::class, 'formPacientes']);
    Route::post('/create/paciente', [PacientesController::class, 'createPaciente']);
    Route::get('/detalhes/paciente/{id}', [PacientesController::class, 'sessionPaciente']);
    Route::get('/detalhes/paciente', [PacientesController::class, 'detalhesPacientes']);
    Route::post('/create/paciente/detalhes', [PacientesController::class, 'createDetalhesPacientes']);
    //Route::get('/download/paciente/detalhes', [PacientesController::class, 'downloadArquivo']);
    Route::post('/inserir/tramite', [PacientesController::class, 'createTramite']);
    Route::post('/busca/atendentes', [PacientesController::class, 'buscaPaciente']);

   

    // Medicos
    Route::get('/medicos', [MedicosController::class, 'listaMedicos']);
    Route::get('/form/medicos', [MedicosController::class, 'formMedicos']);
    Route::post('/create/medico', [MedicosController::class, 'createMedicos']);
    Route::get('/edit/medico/{id}', [MedicosController::class, 'editMedicos']);
  // Atendenetes

    Route::get('/atendentes', [AtendenteController::class, 'listaAtendentes']);
    Route::get('/form/atendentes', [AtendenteController::class, 'formAtendentes']);
    Route::post('/create/atendentes', [AtendenteController::class, 'createAtendente']);
    Route::get('/edit/atendentes/{id}', [AtendenteController::class, 'editAtendente']);
    
    // User

    Route::post('/create/vinculo/user', [LoginController::class, 'createVinculoUser']);
    Route::post('/remove/vinculo/user', [LoginController::class, 'removeVinculoUser']);

    // Consultas

    Route::get('/consultas', [ConsultaController::class, 'listaConsultas']);
    Route::get('/form/consultas', [ConsultaController::class, 'formConsultas']);
    


});



Route::post('/teste', function (Request $request) {
    dd($request->all());
});

Route::get('/josue', function () {
    
    $filial_id = 2;
    $empresa_id = Empresa::where('filial_id', $filial_id)->pluck('id');
   //dd($user_id);
   $user_id  = User_Empresa::wherein('empresa_id', $empresa_id)->pluck('user_id');

   dd($user_id);

   $usuarios = Medico::wherein('id', $user_id)->get();
    
//dd($usuarios);


});



Route::get('/gere', function(){
    $e = new Empresa();
    $e->razao_social = 'Integrar Filial' ;
    $e->cnpj = rand(1, 100000);
    $e->filial_id = 1;
    $e->telefone = 27996530963;
    $e->endereco  = 'ddddddda';
    $e->cidade = 'Paffncas' ;
    $e->bairro = 'iejfijdi';
    $e->save();

    $r = new User_Empresa();
    $r->user_id = 1;
    $r->empresa_id = $e->id;
    $r->save(); 

    return redirect('/dash');
});







Route::get('/3', function () {
    $d = new Medico(); // Substitua "Doctor" pelo nome correto do modelo que você está usando.
    $d->nome = 'Henriqueone';
    $d->cpf = str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT); // CPF fictício
    $d->crp = 'CRP-' . rand(1000, 9999);
    $d->especialidade = 'Psicologo '; // Exemplo de especialidade
    $d->telefone = rand(90000, 99999) . rand(1000, 9999);
    $d->email = 'henrique1@gmail.com';
    $d->endereco = 'Rua Exemplo, ' . rand(1, 100);
    $d->cidade = 'Cidade Exemplo ' . rand(1, 5);
    $d->bairro = 'Bairro Exemplo ' . rand(1, 5);
    $d->save();

    $u = new User(); // Substitua "User" pelo nome correto do modelo.
    $u->id = $d->id; 
    $u->name = 'Henriqueone';
    $u->email = 'henrique1@gmail.com';
    $u->password = bcrypt('123456'); // Senha criptografada
    $u->empresa_id = 2; // Obtém a empresa do usuário logado
    $u->save();

    $h = new User_Empresa();
    $h->user_id = $d->id;
    $h->empresa_id = 2;
    $h->save();

});

Route::get('/4', function () {
    $d = new Medico(); // Substitua "Doctor" pelo nome correto do modelo que você está usando.
    $d->nome = 'Raianeone';
    $d->cpf = str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT); // CPF fictício
    $d->crp = 'CRP-' . rand(1000, 9999);
    $d->especialidade = 'Psicologo '; // Exemplo de especialidade
    $d->telefone = rand(90000, 99999) . rand(1000, 9999);
    $d->email = 'raiane1@gmail.com';
    $d->endereco = 'Rua Exemplo, ' . rand(1, 100);
    $d->cidade = 'Cidade Exemplo ' . rand(1, 5);
    $d->bairro = 'Bairro Exemplo ' . rand(1, 5);
    $d->empresa_id = 2; // Ajuste conforme necessário para corresponder às IDs válidas na tabela de empresas.
    $d->save();

    $u = new User(); // Substitua "User" pelo nome correto do modelo.
    $u->id = $d->id; 
    $u->name = 'Raianeone ';
    $u->email = 'raiane1@gmail.com';
    $u->password = bcrypt('123456'); // Senha criptografada
    $u->empresa_id = 2; // Obtém a empresa do usuário logado
    $u->save();

    $h = new User_Empresa();
    $h->user_id = $d->id;
    $h->empresa_id = 2;
    $h->save();

});







Route::get('/1', function () {
    $d = new Medico(); // Substitua "Doctor" pelo nome correto do modelo que você está usando.
    $d->nome = 'Henrique';
    $d->cpf = str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT); // CPF fictício
    $d->crp = 'CRP-' . rand(1000, 9999);
    $d->especialidade = 'Psicologo '; // Exemplo de especialidade
    $d->telefone = rand(90000, 99999) . rand(1000, 9999);
    $d->email = 'henrique@gmail.com';
    $d->endereco = 'Rua Exemplo, ' . rand(1, 100);
    $d->cidade = 'Cidade Exemplo ' . rand(1, 5);
    $d->bairro = 'Bairro Exemplo ' . rand(1, 5); // Ajuste conforme necessário para corresponder às IDs válidas na tabela de empresas.
    $d->save();

    $u = new User(); // Substitua "User" pelo nome correto do modelo.
    $u->id = $d->id; 
    $u->name = 'Henrique';
    $u->email = 'henrique@gmail.com';
    $u->password = bcrypt('123456'); // Senha criptografada
    $u->empresa_id = 3; // Obtém a empresa do usuário logado
    $u->save();

    $h = new User_Empresa();
    $h->user_id = $d->id;
    $h->empresa_id = 3;
    $h->save();

});

Route::get('/2', function () {
    $d = new Medico(); // Substitua "Doctor" pelo nome correto do modelo que você está usando.
    $d->nome = 'Raiane';
    $d->cpf = str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT); // CPF fictício
    $d->crp = 'CRP-' . rand(1000, 9999);
    $d->especialidade = 'Psicologo '; // Exemplo de especialidade
    $d->telefone = rand(90000, 99999) . rand(1000, 9999);
    $d->email = 'raiane@gmail.com';
    $d->endereco = 'Rua Exemplo, ' . rand(1, 100);
    $d->cidade = 'Cidade Exemplo ' . rand(1, 5);
    $d->bairro = 'Bairro Exemplo ' . rand(1, 5);
    $d->empresa_id = 1; // Ajuste conforme necessário para corresponder às IDs válidas na tabela de empresas.
    $d->save();

    $u = new User(); // Substitua "User" pelo nome correto do modelo.
    $u->id = $d->id; 
    $u->name = 'Raiane ';
    $u->email = 'raiane@gmail.com';
    $u->password = bcrypt('123456'); // Senha criptografada
    $u->empresa_id = 1; // Obtém a empresa do usuário logado
    $u->save();

    $h = new User_Empresa();
    $h->user_id = $d->id;
    $h->empresa_id = 1;
    $h->save();

});


