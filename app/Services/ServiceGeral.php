<?php

namespace App\Services;

use App\Models\ConsultaPaciente;
use App\Models\Empresa;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User_Permissao;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class ServiceGeral
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }





    public static function CriarPermissoes($permissoesRecebidas, $user) {

        User_Permissao::where('user_id', $user->id)->delete();

        foreach ($permissoesRecebidas as $permissoesRecebida) {
            $permissao = new User_Permissao();
            $permissao->permissao_id = $permissoesRecebida;
            $permissao->user_id = $user->id;
            $permissao->save();
        }

        return;
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

    public static function getMedicoLogadoOuTodos() {
        if ($medico = ServiceGeral::VerificarMedico()) {
            $medicos = collect([$medico]);
        } else {
            $users_id = Empresa::find(Session::get('empresa_id'))->users()->pluck('users.id');
            $medicos = Medico::whereIn('id', $users_id)->get();
        }

        return  $medicos;
    }




    public static function listarPacientes($empresaId)
    {
        if ($medico = ServiceGeral::VerificarMedico()) {
            $pacientes = $medico->pacientes()->get();
            ServicesPaciente::Autorizer();
        } else {
            $pacientes = Paciente::where('empresa_id',  $empresaId)->get();
        }

          return  $pacientes = ServiceGeral::formatarTelefoneCPF($pacientes);
    }






    public static function CriptograrArrayID($dados)
    {
        foreach ($dados as $dado) {
            $dado->identificacao = Crypt::encrypt($dado->id);
        }
        return $dados;
    }






}
