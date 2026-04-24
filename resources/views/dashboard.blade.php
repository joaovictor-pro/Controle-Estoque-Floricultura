@extends('layouts.app')

@section('title', 'Dashboard - Floricultura')

@section('content')
<h2 class="mb-4">Tela Inicial</h2>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-muted">Total de Produtos</h5>
                <p class="card-text" style="font-size: 32px; color: #e91e63; font-weight: bold;">{{ $total_produtos }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-muted">Estoque Normal</h5>
                <p class="card-text" style="font-size: 32px; color: #28a745; font-weight: bold;">{{ $estoque_normal }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-muted">Estoque Baixo</h5>
                <p class="card-text" style="font-size: 32px; color: #ffc107; font-weight: bold;">{{ $estoque_baixo }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title text-muted">Esgotado</h5>
                <p class="card-text" style="font-size: 32px; color: #dc3545; font-weight: bold;">{{ $esgotado }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header" style="background: #f8f9fa;">
                <h5 class="card-title mb-0">Produtos com Alerta</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produtos_alerta as $produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->quantidade_atual }}</td>
                                    <td><span class="badge bg-{{ $produto->getCorStatus() }}">{{ $produto->getStatusEstoque() }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Nenhum produto com alerta</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header" style="background: #f8f9fa;">
                <h5 class="card-title mb-0">Últimas Movimentações</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Tipo</th>
                                <th>Quantidade</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ultimas_movimentacoes as $mov)
                                <tr>
                                    <td>{{ $mov->produto->nome }}</td>
                                    <td>
                                        @if ($mov->tipo === 'entrada')
                                            <span class="badge bg-success">Entrada</span>
                                        @else
                                            <span class="badge bg-danger">Saída</span>
                                        @endif
                                    </td>
                                    <td>{{ $mov->quantidade }}</td>
                                    <td>{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Nenhuma movimentação registrada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection