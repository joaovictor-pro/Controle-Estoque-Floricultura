<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'login',
        'senha',
    ];

    protected $hidden = [
        'senha',
    ];

    public function verificarSenha($senha)
    {
        return $this->senha === $senha;
    }
}