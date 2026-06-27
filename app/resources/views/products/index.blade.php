<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h1 class="h3 mb-0">Productos</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Nuevo producto
            </a>
        </div>
    </x-slot>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="search" class="form-label">Buscar</label>
                    <input
                        type="text"
                        name="search"
                        id="search"
                        class="form-control"
                        value="{{ $search }}"
                        placeholder="Nombre o SKU"
                    >
                </div>
                <div class="col-md-4">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Todas las categorías</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($categoryId === $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-search me-1"></i> Filtrar
                    </button>
                    @if ($search !== '' || $categoryId)
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        @if ($products->isEmpty())
            <div class="card-body text-muted">
                No se encontraron productos con los filtros aplicados.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>SKU</th>
                            <th>Categoría</th>
                            <th class="text-end">Precio</th>
                            <th class="text-end">Stock</th>
                            <th class="text-end">Mínimo</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><code>{{ $product->sku }}</code></td>
                                <td>{{ $product->category->name }}</td>
                                <td class="text-end">${{ number_format($product->price, 2) }}</td>
                                <td class="text-end {{ $product->stock_quantity <= $product->stock_minimum ? 'text-warning fw-semibold' : '' }}">
                                    {{ $product->stock_quantity }}
                                </td>
                                <td class="text-end">{{ $product->stock_minimum }}</td>
                                <td>
                                    @if ($product->status === 'activo')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($products->hasPages())
                <div class="card-footer bg-white">
                    {{ $products->links() }}
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
