<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Empresa extends Model
{
    use HasFactory;

    protected $table = 'user_empresa';
    
    protected $fillable = [
        'user_id',
        'empresa_id',
    ];
}
