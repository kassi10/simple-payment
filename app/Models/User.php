<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'cpf_cnpj', 'email', 'password', 'type', 'balance'
    ];

    protected $table = 'users';
}
