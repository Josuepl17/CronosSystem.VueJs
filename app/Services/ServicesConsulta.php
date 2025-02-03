<?php

namespace App\Services;

use App\Models\ConsultaPaciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ServicesConsulta
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }



    public static function ListarConsultas($date_incial, $date_final) {
        // Inicia a consulta base
        $consultasQuery = null;
    
        // Verifica se é um médico
        if ($medico = ServiceGeral::VerificarMedico()) {
            $consultasQuery = $medico->consultas();
        } else {
            $consultasQuery = ConsultaPaciente::where('empresa_id', Session::get('empresa_id'));
        }
    
        // Aplica o filtro 'whereDate' e as ordenações
        $consultas = $consultasQuery
            ->whereBetween('date', [$date_incial, $date_final])
            ->orderByRaw("
                CASE 
                    WHEN status = 'Agendado' THEN 1
                    WHEN status = 'Concluido' THEN 2
                    WHEN status = 'Cancelado' THEN 3
                    ELSE 4
                END ")
            ->orderBy('date', 'asc')
            ->orderBy('horainicial', 'asc')
            ->get(); // Obtém os resultados após aplicar os filtros e ordenações
    
        return $consultas;
    }


    public static function VerificarAgendamento($request) {
        return   $existingConsulta = ConsultaPaciente::where('date', $request->date)
          ->where('medico_id', $request->medico_id)
          ->where('status', 'Agendado')
          ->where(function ($query) use ($request) {
              $query->whereBetween('horainicial', [$request->horainicial, $request->horafinal])
                  ->orWhereBetween('horafinal', [$request->horainicial, $request->horafinal])
                  ->orWhere(function ($query) use ($request) {
                      $query->where('horainicial', '<=', $request->horainicial)
                          ->where('horafinal', '>=', $request->horafinal);
                  });
          })
          ->first();
  
  
      }
    








}
