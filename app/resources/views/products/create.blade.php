@extends('layouts.app')

@section('title', 'Crear producto')
@section('page-title', 'Nuevo producto')
@section('page-subtitle', 'Agrega un producto al inventario')

@section('content')
    <div class="card-app">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku') }}" class="form-control @error('sku') is-invalid @enderror" required>
                        @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Categoría</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Seleccionar…</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Precio</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" required>
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium">Stock mínimo</label>
                        <input type="number" name="stock_minimum" value="{{ old('stock_minimum', 5) }}" class="form-control @error('stock_minimum') is-invalid @enderror" required>
                        @error('stock_minimum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Unidad</label>
                        <input type="text" name="unit" value="{{ old('unit', 'unidad') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium">Estado</label>
                        <select name="status" class="form-select">
                            <option value="activo" @selected(old('status', 'activo') === 'activo')>Activo</option>
                            <option value="inactivo" @selected(old('status') === 'inactivo')>Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
