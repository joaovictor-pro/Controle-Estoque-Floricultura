@extends('layouts.app')

@section('title', 'Produtos - Floricultura')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2>Gestão de Produtos</h2>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary">+ Novo Produto</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Qtd</th>
                    <th>Mín</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td><strong>{{ $produto->nome }}</strong></td>
                        <td>{{ $produto->marca_fornecedor }}</td>
                        <td>{{ $produto->categoria->nome }}</td>
                        <td>{{ $produto->quantidade_atual }}</td>
                        <td>{{ $produto->estoque_minimo }}</td>
                        <td><span class="badge bg-{{ $produto->getCorStatus() }}">{{ $produto->getStatusEstoque() }}</span></td>
                        <td>
                            <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-info">Editar</a>
                            @if ($produto->podeRegistrarSaida())
                                <a href="{{ route('movimentacoes.create', ['tipo' => 'saida', 'produto_id' => $produto->id]) }}" class="btn btn-sm btn-warning">Saída</a>
                            @else
                                <button class="btn btn-sm btn-warning" disabled>Saída</button>
                            @endif
                            <a href="{{ route('movimentacoes.create', ['tipo' => 'entrada', 'produto_id' => $produto->id]) }}" class="btn btn-sm btn-success">Entrada</a>
                            <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Nenhum produto cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection