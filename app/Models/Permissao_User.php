<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao_User extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'permissoes_id',
        'descricao',

    ];
}


