@extends('layouts.app')

@section('title', 'Editar producto')
@section('page-title', 'Editar producto')
@section('page-subtitle', $product->name)

@section('content')
    <div class="card-app">
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control @error('sku') is-invalid @enderror" required>
                        @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Categoría</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Precio</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Stock mínimo</label>
                        <input type="number" name="stock_minimum" value="{{ old('stock_minimum', $product->stock_minimum) }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Unidad</label>
                        <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Estado</label>
                        <select name="status" class="form-select">
                            <option value="activo" @selected(old('status', $product->status) === 'activo')>Activo</option>
                            <option value="inactivo" @selected(old('status', $product->status) === 'inactivo')>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Stock actual</label>
                        <input type="text" class="form-control" value="{{ $product->stock_quantity }}" disabled>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
