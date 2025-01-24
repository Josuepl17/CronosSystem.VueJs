<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Permissao extends Model
{
    use HasFactory;
    protected $fillable = [
        'permissao_id',
        'user_id',
    ];

    protected $table = 'user_permissoes';
}
