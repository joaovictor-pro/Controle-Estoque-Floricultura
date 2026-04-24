<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Movimentacao;

class DashboardController extends Controller
{
    public function index()
    {
        $total_produtos = Produto::count();
        $estoque_normal = Produto::whereRaw('quantidade_atual > estoque_minimo')->count();
        $estoque_baixo = Produto::whereRaw('quantidade_atual <= estoque_minimo AND quantidade_atual > 0')->count();
        $esgotado = Produto::where('quantidade_atual', 0)->count();

        $produtos_alerta = Produto::whereRaw('quantidade_atual <= estoque_minimo')
            ->orderBy('quantidade_atual', 'asc')
            ->limit(10)
            ->get();

        $ultimas_movimentacoes = Movimentacao::with('produto')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'total_produtos',
            'estoque_normal',
            'estoque_baixo',
            'esgotado',
            'produtos_alerta',
            'ultimas_movimentacoes'
        ));
    }
}