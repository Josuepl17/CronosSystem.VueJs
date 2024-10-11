<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    protected $guard = 'web';
    use HasFactory;

    protected $fillable = [
        'name',
        'second_name',
        'email',
        'password',
        'empresa_id',
    ];
}
