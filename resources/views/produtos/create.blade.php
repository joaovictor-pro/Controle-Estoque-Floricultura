@extends('layouts.app')

@section('title', 'Novo Produto - Floricultura')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2 class="mb-4">Novo Produto</h2>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('produtos.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nome *</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required>
                                @error('nome')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Marca/Fornecedor *</label>
                                <input type="text" class="form-control @error('marca_fornecedor') is-invalid @enderror" name="marca_fornecedor" value="{{ old('marca_fornecedor') }}" required>
                                @error('marca_fornecedor')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Modelo/Tipo *</label>
                                <input type="text" class="form-control @error('modelo_tipo') is-invalid @enderror" name="modelo_tipo" value="{{ old('modelo_tipo') }}" required>
                                @error('modelo_tipo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Categoria *</label>
                                <select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id" required>
                                    <option value="">Selecione uma categoria</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nome }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" rows="2">{{ old('descricao') }}</textarea>
                        @error('descricao')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Características Específicas</label>
                        <textarea class="form-control @error('caracteristicas') is-invalid @enderror" name="caracteristicas" rows="2">{{ old('caracteristicas') }}</textarea>
                        @error('caracteristicas')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Quantidade Atual *</label>
                                <input type="number" class="form-control @error('quantidade_atual') is-invalid @enderror" name="quantidade_atual" value="{{ old('quantidade_atual', 0) }}" min="0" required>
                                @error('quantidade_atual')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estoque Mínimo *</label>
                                <input type="number" class="form-control @error('estoque_minimo') is-invalid @enderror" name="estoque_minimo" value="{{ old('estoque_minimo', 0) }}" min="0" required>
                                @error('estoque_minimo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection