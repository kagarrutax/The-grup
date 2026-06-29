@extends('layouts.app')

@section('title', 'Productos')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Productos</h1>
            <p class="page-subtitle mb-0">Catálogo de productos del supermercado</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>Nuevo producto
        </a>
    </div>

<<<<<<< HEAD
    {{-- Buscador: nombre, ID y categoría (Fase 6) --}}
=======
>>>>>>> 574ccbe742075045b00299a188ad3088845aa24a
    <div class="card card-app mb-4">
        <div class="card-header pt-4 px-4">
            <h2 class="h6 fw-bold mb-0"><i class="bi bi-search me-2 text-primary"></i>Buscador</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('products.index') }}" method="GET" class="row g-3 align-items-end">
<<<<<<< Updated upstream
                <div class="col-12 col-md-4">
                    <label for="name" class="form-label fw-medium">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="Buscar por nombre" value="{{ request('name') }}">
                </div>
                <div class="col-12 col-md-4">
<<<<<<< HEAD
                    <label for="id" class="form-label fw-medium">ID</label>
                    <input type="text" class="form-control" id="id" name="id"
                           placeholder="Ej: ARZ-001" value="">
=======
                    <label for="sku" class="form-label fw-medium">SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku"
                           placeholder="Ej: ARZ-001" value="{{ request('sku') }}">
>>>>>>> 574ccbe742075045b00299a188ad3088845aa24a
=======
                <div class="col-12 col-md-5">
                    <label for="search" class="form-label fw-medium">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search"
                           placeholder="Nombre o SKU" value="{{ $search ?? '' }}">
>>>>>>> Stashed changes
                </div>
                <div class="col-12 col-md-4">
                    <label for="category_id" class="form-label fw-medium">Categoría</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Todas las categorías</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" @selected(($categoryId ?? null) === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 flex-grow-1"><i class="bi bi-funnel me-1"></i>Filtrar</button>
                    @if(($search ?? '') !== '' || ! empty($categoryId))
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Limpiar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card card-app">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-app align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th class="text-end">Precio</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Mínimo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td><span class="badge bg-light text-dark border">{{ $product->sku }}</span></td>
                                <td class="fw-medium">{{ $product->name }}</td>
                                <td><span class="badge rounded-pill text-bg-secondary">{{ $product->category->name ?? '—' }}</span></td>
                                <td class="text-end fw-semibold">${{ number_format($product->price, 2) }}</td>
                                <td class="text-center {{ $product->stock_quantity <= $product->stock_minimum ? 'text-warning fw-semibold' : '' }}">{{ $product->stock_quantity }}</td>
                                <td class="text-center">{{ $product->stock_minimum }}</td>
                                <td class="text-center"><span class="badge rounded-pill {{ $product->status === 'activo' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($product->status ?? '—') }}</span></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No se encontraron productos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            @if(method_exists($products, 'links'))
                {{ $products->links() }}
            @endif
            <small class="text-muted d-block mt-2">Stock se gestiona desde movimientos, no desde este formulario.</small>
        </div>
    </div>

@endsection
