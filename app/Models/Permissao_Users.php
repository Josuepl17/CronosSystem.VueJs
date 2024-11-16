<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao_Users extends Model
{
    use HasFactory;

    protected $table = 'permissao_users';

    protected $fillable = [
        'user_id',
        'permissoes_id',
        'descricao',
    ];
}
