<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes';

    protected $fillable = [
        'produto_id',
        'tipo',
        'quantidade',
        'responsavel',
        'observacao',
        'quantidade_anterior',
        'quantidade_nova',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function getTipoFormatado()
    {
        return ucfirst($this->tipo);
    }
}