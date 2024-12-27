<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function listaConsultas() {
        return Inertia::render('Consultas');
    }

    public function formConsultas() {
        // Obtém o ID do funcionário logado (médico ou atendente) da sessão
        $funcionario_id = Session::get('id'); 
    
        // Verifica se o funcionário logado é um médico
        if ($medico = Medico::Find($funcionario_id)) { 
            // Se for um médico, obtém os pacientes associados a esse médico específico
            // e que pertencem à empresa selecionada na sessão
            $pacientes = $medico->pacientes()->where('pacientes.empresa_id', Session::get('empresa_id'))->get();
            // Obtém os dados do médico logado
            $medicos = Medico::where('id', $funcionario_id)->get();
        } else {
            // Se não for um médico (provavelmente um atendente), obtém todos os pacientes
            // que pertencem à empresa selecionada na sessão
            $pacientes = Paciente::where('empresa_id', Session::get('empresa_id'))->get();
            // Obtém os IDs dos usuários associados à empresa selecionada
            $users = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
            // Obtém os dados dos médicos que estão na lista de usuários da empresa
            $medicos = Medico::wherein('id', $users)->get(); 
        }
    
        // Renderiza a página 'FormConsultas' passando as variáveis 'medicos' e 'pacientes'
        return Inertia::render('FormConsultas', compact('medicos', 'pacientes'));
    }
}
