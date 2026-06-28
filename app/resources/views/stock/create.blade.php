@extends('layouts.app')

@section('title', 'Nuevo movimiento')
@section('page-title', 'Nuevo movimiento')
@section('page-subtitle', 'Registra una entrada o salida de inventario')

@section('content')
    <div class="card-app">
        <div class="card-body">
            <form action="{{ route('stock.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Producto</label>
                        <select name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                            <option value="">Seleccionar…</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                                    {{ $product->name }} (stock: {{ $product->stock_quantity }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Tipo</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="entrada" @selected(old('type') === 'entrada')>Entrada</option>
                            <option value="salida" @selected(old('type') === 'salida')>Salida</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Cantidad</label>
                        <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror" min="1" required>
                        @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium">Motivo</label>
                        <input type="text" name="reason" value="{{ old('reason') }}" class="form-control" placeholder="Ej. Compra proveedor">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('stock.index') }}" class="btn btn-outline-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
