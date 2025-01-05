<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\caixas;
use App\Models\Empresa;
use App\Models\Medico;
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



    


    // Post de Dados no Formato de Requisição
    public static function post_filter($request)
    {
        // Criação do novo pedido com os dados recebidos
        $newRequest = new Request(); // Objeto do Tipo Request
        $newRequest->setMethod('POST');// Method De envio
        
        // Adicionando os dados recebidos ao novo pedido
        $newRequest->request->add([
            'nome' => $request->nome, // So para Dizimos / Nome dizimista
            'membro_id' => $request->membro_id, // So para Dizimos / ID do Dizimista
            'dataini' => $request->dataini,
            'datafi' => $request->datafi
        ]);

        return $newRequest;

    }

    public static function verificar_login($request){
        if (User::where('email', $request->email)->first()){
            return true;
        } else{
            return false;
        }

    }


    public static function verificar_empresa($request){
        if (Empresa::where('cnpj', $request->cnpj)->first()){
            return true;
        } else{
            return false;
        }

    }


    public static function Autorizer(){

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
             






             public static function Decrypted ($dados){
               
                    $dados = Crypt::decrypt($dados);
                    return $dados;
                
             }


            public static function formatarDados($dados)
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

          


            

}
