@extends('layouts.app')

@section('title', 'Productos')
@section('page-title', 'Productos')
@section('page-subtitle', 'Catálogo de productos del inventario')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-3">
        <form method="GET" class="d-flex flex-wrap gap-2 align-items-end">
            <div>
                <label class="form-label small mb-1">Buscar</label>
                <input type="search" name="search" value="{{ $search }}" class="form-control form-control-sm" placeholder="Nombre o SKU">
            </div>
            <div>
                <label class="form-label small mb-1">Categoría</label>
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">Todas</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected($categoryId == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-outline-secondary btn-sm">Filtrar</button>
        </form>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Nuevo producto
        </a>
    </div>

    <div class="card-app">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-app mb-0">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td><code>{{ $product->sku }}</code></td>
                                <td class="fw-medium">{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '—' }}</td>
                                <td>
                                    <span class="{{ $product->stock_quantity <= $product->stock_minimum ? 'text-danger fw-semibold' : '' }}">
                                        {{ $product->stock_quantity }}
                                    </span>
                                </td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar producto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No hay productos.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($products->hasPages())
            <div class="card-footer">{{ $products->links() }}</div>
        @endif
    </div>
@endsection
