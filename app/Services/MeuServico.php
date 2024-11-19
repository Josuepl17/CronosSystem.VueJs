<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\caixas;
use App\Models\empresas;
use App\Models\Medicos;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
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
        if (empresas::where('cnpj', $request->cnpj)->first()){
            return true;
        } else{
            return false;
        }

    }


    public static function Autorizer(){

         $id = 1; // O ID que você quer verificar

            $exists = Medicos::where('id', FacadesAuth::user()->funcionario_id)->exists();

                if ($exists) {
  
                     Session::flash('autorizaMedico', 'autorizado');
                     return;

                } else {

                    return;
                }
             }




}
