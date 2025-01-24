<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    use HasFactory;
    protected $fillable = [
        'chave',
        'descricao',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_permissoes', 'permissao_id', 'user_id');
    }

    protected $table = 'permissoes';
}
