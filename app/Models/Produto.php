<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'marca_fornecedor',
        'modelo_tipo',
        'categoria_id',
        'descricao',
        'caracteristicas',
        'quantidade_atual',
        'estoque_minimo',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }

    public function getStatusEstoque()
    {
        if ($this->quantidade_atual == 0) {
            return 'Esgotado';
        } elseif ($this->quantidade_atual <= $this->estoque_minimo) {
            return 'Estoque Baixo';
        } else {
            return 'Estoque Normal';
        }
    }

    public function getCorStatus()
    {
        $status = $this->getStatusEstoque();
        
        return match($status) {
            'Estoque Normal' => 'success',
            'Estoque Baixo' => 'warning',
            'Esgotado' => 'danger',
            default => 'secondary',
        };
    }

    public function podeRegistrarSaida()
    {
        return $this->quantidade_atual > 0;
    }
}