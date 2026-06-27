@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ url('/products') }}" class="text-decoration-none">Productos</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1">Editar producto</h1>
    </div>

    <div class="card card-app">
        <div class="card-body p-4">
            {{-- Integrar con: route('products.update', $product) --}}
            <form action="{{ url('/products/1') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row g-3 g-md-4">

                    <div class="col-12 col-md-6">
                        <label for="sku" class="form-label fw-medium">SKU <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sku" name="sku" value="ARZ-001" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-medium">Nombre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="Arroz Premium 1kg" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="category_id" class="form-label fw-medium">Categoría <span class="text-danger">*</span></label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="1" selected>Granos</option>
                            <option value="2">Lácteos</option>
                            <option value="3">Bebidas</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="unit" class="form-label fw-medium">Unidad</label>
                        <select class="form-select" id="unit" name="unit">
                            <option value="kg" selected>Kilogramo</option>
                            <option value="unidad">Unidad</option>
                            <option value="lt">Litro</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="price" class="form-label fw-medium">Precio venta</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price" name="price" value="1.85" step="0.01" min="0" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="stock_minimum" class="form-label fw-medium">Stock mínimo</label>
                        <input type="number" class="form-control" id="stock_minimum" name="stock_minimum" value="15" min="0" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label fw-medium">Estado</label>
                        <select class="form-select" id="status" name="status">
                            <option value="activo" selected>Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                    {{-- Solo lectura: stock actual --}}
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-medium">Stock actual (solo lectura)</label>
                        <input type="text" class="form-control bg-light" value="120 unidades" readonly disabled>
                        <div class="form-text">Modificar desde <a href="{{ url('/stock/create') }}">movimientos de stock</a>.</div>
                    </div>

                </div>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-check-lg me-1"></i>Guardar</button>
                    <a href="{{ url('/products') }}" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-x-lg me-1"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    (function () {
        'use strict';
        document.querySelectorAll('.needs-validation').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
                form.classList.add('was-validated');
            });
        });
    })();
</script>
@endsection
