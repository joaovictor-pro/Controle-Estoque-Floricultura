<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Movimentacao;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function create($tipo, $produto_id)
    {
        $produto = Produto::findOrFail($produto_id);

        if ($tipo === 'saida' && !$produto->podeRegistrarSaida()) {
            return redirect()->route('produtos.index')->withErrors('Produto esgotado! Não é possível registrar saída.');
        }

        return view('movimentacoes.create', compact('produto', 'tipo'));
    }

    public function store(Request $request)
    {
        $tipo = $request->input('tipo');
        $produto_id = $request->input('produto_id');
        $produto = Produto::findOrFail($produto_id);

        if ($tipo === 'entrada') {
            $validated = $request->validate([
                'quantidade' => 'required|integer|min:1',
                'observacao' => 'nullable|string',
            ]);

            $quantidade_anterior = $produto->quantidade_atual;
            $quantidade_nova = $quantidade_anterior + $validated['quantidade'];

            $produto->update(['quantidade_atual' => $quantidade_nova]);

            Movimentacao::create([
                'produto_id' => $produto_id,
                'tipo' => 'entrada',
                'quantidade' => $validated['quantidade'],
                'observacao' => $validated['observacao'] ?? null,
                'quantidade_anterior' => $quantidade_anterior,
                'quantidade_nova' => $quantidade_nova,
            ]);

            return redirect()->route('produtos.index')->with('success', 'Entrada registrada com sucesso!');
        } else if ($tipo === 'saida') {
            $validated = $request->validate([
                'quantidade' => 'required|integer|min:1',
                'responsavel' => 'required|string|max:100',
                'observacao' => 'nullable|string',
            ]);

            if ($validated['quantidade'] > $produto->quantidade_atual) {
                return back()->withErrors('Quantidade insuficiente em estoque!');
            }

            $quantidade_anterior = $produto->quantidade_atual;
            $quantidade_nova = $quantidade_anterior - $validated['quantidade'];

            $produto->update(['quantidade_atual' => $quantidade_nova]);

            Movimentacao::create([
                'produto_id' => $produto_id,
                'tipo' => 'saida',
                'quantidade' => $validated['quantidade'],
                'responsavel' => $validated['responsavel'],
                'observacao' => $validated['observacao'] ?? null,
                'quantidade_anterior' => $quantidade_anterior,
                'quantidade_nova' => $quantidade_nova,
            ]);

            return redirect()->route('produtos.index')->with('success', 'Saída registrada com sucesso!');
        }

        return redirect()->route('produtos.index')->withErrors('Tipo de movimentação inválido!');
    }

    public function index()
    {
        $movimentacoes = Movimentacao::with('produto')
            ->orderByDesc('created_at')
            ->paginate(50);

        return view('movimentacoes.index', compact('movimentacoes'));
    }
}