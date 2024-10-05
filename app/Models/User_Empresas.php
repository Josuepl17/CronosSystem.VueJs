<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Empresas extends Model
{
    use HasFactory;

    protected $table = 'user_empresas';
    
    protected $fillable = [
        'user_id',
        'empresa_id',
    ];
}
