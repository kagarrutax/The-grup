@extends('layouts.app')

@section('title', 'Productos')
@section('page-title', 'Productos')
@section('page-subtitle', 'Gestión visual del catálogo con búsqueda inteligente y modales')

@section('content')
    <section class="module-toolbar mb-4">
        <form method="GET" id="productsFilters" class="search-toolbar">
            <div class="search-input-group">
                <i class="bi bi-search"></i>
                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    class="form-control form-control-search"
                    placeholder="Buscar por ID, nombre, código, categoría o proveedor"
                    autocomplete="off"
                >
                <button type="button" class="search-clear" data-clear-search>&times;</button>
            </div>

            <select name="category_id" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($categoryId == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="supplier_id" class="form-select">
                <option value="">Todos los proveedores</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected($supplierId == $supplier->id)>{{ $supplier->company_name }}</option>
                @endforeach
            </select>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                <i class="bi bi-plus-lg me-1"></i> Nuevo producto
            </button>
        </form>
    </section>

    <div id="productsTableWrapper">
        @include('products.partials.table', ['products' => $products])
    </div>

    @include('components.modal-create-product')
    @include('components.modal-view-product')
    @include('components.modal-edit-product')
    @include('components.modal-delete-confirmation')
@endsection

@push('scripts')
<script>
    (() => {
        const form = document.getElementById('productsFilters');
        const wrapper = document.getElementById('productsTableWrapper');
        const searchInput = form.querySelector('input[name="search"]');
        const clearButton = form.querySelector('[data-clear-search]');
        let timeoutId = null;

        const toggleTypingState = () => {
            searchInput.parentElement.classList.toggle('is-typing', searchInput.value.trim() !== '');
        };

        const loadTable = async () => {
            const params = new URLSearchParams(new FormData(form));
            const response = await fetch(`{{ route('products.index') }}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            wrapper.innerHTML = await response.text();
        };

        window.refreshProductsTable = loadTable;
        window.refreshCurrentTable = loadTable;

        form.addEventListener('input', (event) => {
            if (event.target.matches('input[name="search"]')) {
                toggleTypingState();
            }

            clearTimeout(timeoutId);
            timeoutId = setTimeout(loadTable, 220);
        });

        form.addEventListener('change', () => {
            clearTimeout(timeoutId);
            loadTable();
        });

        clearButton.addEventListener('click', () => {
            searchInput.value = '';
            form.querySelector('select[name="category_id"]').value = '';
            form.querySelector('select[name="supplier_id"]').value = '';
            toggleTypingState();
            loadTable();
        });

        toggleTypingState();
    })();
</script>
@endpush
