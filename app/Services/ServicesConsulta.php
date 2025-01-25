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






    public static function ListarConsultas($date) {
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
            ->whereDate('date', $date) // Aplica o filtro 'whereDate'
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
    








}
