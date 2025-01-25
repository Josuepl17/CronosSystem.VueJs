<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\caixas;
use App\Models\ConsultaPaciente;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Medico_Paciente;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\If_;

class ServicesPaciente
{


    public static function Autorizer()
    {

        //  dd(session('funcionario_id'));

        $exists = Medico::where('id', session('id'))->exists();
        //  dd($exists);
        if ($exists) {

            Session::flash('autorizaMedico', 'autorizado');
            return;
        } else {

            return;
        }
    }





    public static function salvarPaciente(array $dados, ?int $pacienteId = null, array $medicos = []): Paciente
    {
        // Adiciona o ID da empresa aos dados
        $dados['empresa_id'] = Session::get('empresa_id');

        // Cria ou atualiza o paciente
        $paciente = Paciente::updateOrCreate(
            ['id' => $pacienteId], // Condição para buscar o paciente
            $dados
        );

        // Remove os relacionamentos existentes
        Medico_Paciente::where('paciente_id', $paciente->id)->delete();

        // Cria os novos relacionamentos com médicos
        foreach ($medicos as $medicoId) {
            Medico_Paciente::create([
                'paciente_id' => $paciente->id,
                'medico_id' => $medicoId,
                'empresa_id' => Session::get('empresa_id'),
            ]);
        }

        return $paciente;
    }






    public static function concluirConsulta($id_consulta)
    {
        if ($id_consulta) {
            $consulta = ConsultaPaciente::Find($id_consulta)->first();
            $consulta->status = 'Concluido';
            $consulta->motivo_status = "Consulta concluída";
            $consulta->save();
        }
    }
}
