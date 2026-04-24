<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->orderBy('nome')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:150',
            'marca_fornecedor' => 'required|string|max:100',
            'modelo_tipo' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'descricao' => 'nullable|string',
            'caracteristicas' => 'nullable|string',
            'quantidade_atual' => 'required|integer|min:0',
            'estoque_minimo' => 'required|integer|min:0',
        ]);

        Produto::create($validated);

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:150',
            'marca_fornecedor' => 'required|string|max:100',
            'modelo_tipo' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'descricao' => 'nullable|string',
            'caracteristicas' => 'nullable|string',
            'quantidade_atual' => 'required|integer|min:0',
            'estoque_minimo' => 'required|integer|min:0',
        ]);

        $produto->update($validated);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto deletado com sucesso!');
    }
}