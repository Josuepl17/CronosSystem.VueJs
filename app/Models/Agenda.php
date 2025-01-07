<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $fillable = [
        'timeinicial',
        'timefinal',
        'tempodeconsulta',
        'medico_id',
        'empresa_id'
    ];


    public function getTimeinicialAttribute($value)
{
    return date('H:i', strtotime($value));
}

public function getTimefinalAttribute($value)
{
    return date('H:i', strtotime($value));
}

public function gettempodeconsultaAttribute($value)
{
    return date('H:i', strtotime($value));
}

}
