@extends('layouts.app')

@section('title', 'Movimentação - Floricultura')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2 class="mb-4">{{ $tipo === 'entrada' ? 'Registrar Entrada' : 'Registrar Saída' }}</h2>

        <div class="card">
            <div class="card-header" style="background: #f8f9fa;">
                <h5 class="card-title mb-0">{{ $produto->nome }}</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>{{ $produto->nome }}</strong><br>
                    Marca: {{ $produto->marca_fornecedor }}<br>
                    Quantidade atual: <strong>{{ $produto->quantidade_atual }} un</strong>
                </div>

                <form method="POST" action="{{ route('movimentacoes.store') }}">
                    @csrf

                    <input type="hidden" name="tipo" value="{{ $tipo }}">
                    <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                    @if ($tipo === 'saida')
                        <div class="mb-3">
                            <label class="form-label">Responsável pela Retirada *</label>
                            <input type="text" class="form-control @error('responsavel') is-invalid @enderror" name="responsavel" value="{{ old('responsavel') }}" required>
                            @error('responsavel')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Quantidade *</label>
                        <input type="number" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{ old('quantidade') }}" min="1" max="{{ $tipo === 'saida' ? $produto->quantidade_atual : 999999 }}" required>
                        @error('quantidade')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Observação</label>
                        <textarea class="form-control @error('observacao') is-invalid @enderror" name="observacao" rows="3">{{ old('observacao') }}</textarea>
                        @error('observacao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-{{ $tipo === 'entrada' ? 'success' : 'warning' }}">
                            {{ $tipo === 'entrada' ? 'Registrar Entrada' : 'Registrar Saída' }}
                        </button>
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection