@extends('layouts.app')

@section('title', 'Movimentações - Floricultura')

@section('content')
<h2 class="mb-4">Histórico de Movimentações</h2>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                    <th>Responsável</th>
                    <th>Antes</th>
                    <th>Depois</th>
                    <th>Data/Hora</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movimentacoes as $mov)
                    <tr>
                        <td>{{ $mov->id }}</td>
                        <td><strong>{{ $mov->produto->nome }}</strong></td>
                        <td>
                            @if ($mov->tipo === 'entrada')
                                <span class="badge bg-success">Entrada</span>
                            @else
                                <span class="badge bg-danger">Saída</span>
                            @endif
                        </td>
                        <td>{{ $mov->quantidade }}</td>
                        <td>{{ $mov->responsavel ?? '-' }}</td>
                        <td>{{ $mov->quantidade_anterior }}</td>
                        <td>{{ $mov->quantidade_nova }}</td>
                        <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Nenhuma movimentação registrada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $movimentacoes->links() }}
</div>
@endsection