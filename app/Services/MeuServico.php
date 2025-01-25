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

class MeuServico
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




    public static function Encrypted($dados)
    {
        foreach ($dados as $dado) {
            $dado->identificacao = Crypt::encrypt($dado->id);
        }
        return $dados;
    }







    public static function Decrypted($dados)
    {

        $dados = Crypt::decrypt($dados);
        return $dados;
    }


    public static function formatarTelefoneCPF($dados)
    {
        foreach ($dados as $dado) {
            // Remove caracteres não numéricos
            $numero = preg_replace('/\D/', '', $dado->telefone);

            // Verifica o tamanho do número e formata de acordo
            if (strlen($numero) == 10) {
                // Formato (XX) XXXX-XXXX
                $dado->telefone = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $numero);
            } elseif (strlen($numero) == 11) {
                // Formato (XX) XXXXX-XXXX
                $dado->telefone = preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $numero);
            } else {
                // Mantém o número original se não tiver 10 ou 11 dígitos
                $dado->telefone = $numero;
            }

            $cpf = preg_replace('/\D/', '', $dado->cpf);

            if (strlen($cpf) == 11) {
                // Formato XXX.XXX.XXX-XX
                $dado->cpf = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
            } else {
                // Mantém o CPF original se não tiver 11 dígitos
                $dado->cpf = $cpf;
            }

            foreach ($dados as $dado) {
                $dado->identificacao = Crypt::encrypt($dado->id);
            }
        }
        return $dados;
    }







    public static function VerificarMedico()
    {
        $funcionarioId = Session::get('id');

        $medico = Medico::where('id', $funcionarioId)->first();
        if ($medico) {
            return $medico;
        } else {
            return false;
        }
    }




    public static function listarPacientes($empresaId)
    {
        if ($medico = MeuServico::VerificarMedico()) {
            $pacientes = $medico->pacientes()->get();
            MeuServico::Autorizer();
        } else {
            $pacientes = Paciente::where('empresa_id',  $empresaId)->get();
        }

          return  $pacientes = MeuServico::formatarTelefoneCPF($pacientes);
    }



    public static function getMedicoLogadoOuTodos() {
        if ($medico = MeuServico::VerificarMedico()) {
            $medicos = collect([$medico]);
        } else {
            $users_id = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
            $medicos = Medico::whereIn('id', $users_id)->get();
        }

        return  $medicos;
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





    


    public static function concluirConsulta($id_consulta){
        if($id_consulta){
            $consulta = ConsultaPaciente::Find($id_consulta)->first();
            $consulta->status = 'Concluido';
            $consulta->motivo_status = "Consulta concluída";
            $consulta->save();
        }
    }

}
