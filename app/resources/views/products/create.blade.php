@extends('layouts.app')

@section('title', 'Nuevo Producto')

@section('content')

    {{-- Fase 3 — create sin stock_quantity (plan products/) --}}
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ url('/products') }}" class="text-decoration-none">Productos</a></li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1">Nuevo producto</h1>
        <p class="page-subtitle mb-0">El stock inicial se registra mediante movimientos de entrada</p>
    </div>

    <div class="card card-app">
        <div class="card-body p-4">
            {{-- Integrar con: route('products.store') --}}
            <form action="{{ url('/products') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row g-3 g-md-4">

                    <div class="col-12 col-md-6">
                        <label for="id" class="form-label fw-medium">ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Ej: ARZ-001" required>
                        <div class="invalid-feedback">El ID es obligatorio y debe ser único.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-medium">Nombre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del producto" required>
                        <div class="invalid-feedback">El nombre es obligatorio.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="category_id" class="form-label fw-medium">Categoría <span class="text-danger">*</span></label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" selected disabled>Seleccione...</option>
                            <option value="1">Granos</option>
                            <option value="2">Lácteos</option>
                            <option value="3">Bebidas</option>
                        </select>
                        <div class="invalid-feedback">Seleccione una categoría.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="unit" class="form-label fw-medium">Unidad <span class="text-danger">*</span></label>
                        <select class="form-select" id="unit" name="unit" required>
                            <option value="unidad">Unidad</option>
                            <option value="kg">Kilogramo</option>
                            <option value="lt">Litro</option>
                            <option value="paq">Paquete</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="price" class="form-label fw-medium">Precio venta <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                        </div>
                        <div class="invalid-feedback">Ingrese un precio válido.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="stock_minimum" class="form-label fw-medium">Stock mínimo <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="stock_minimum" name="stock_minimum" min="0" required>
                        <div class="form-text">Alerta cuando stock_quantity &le; este valor.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label fw-medium">Estado <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="activo" selected>Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                </div>

                <div class="alert alert-info rounded-3 mt-4 mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nota:</strong> <code>stock_quantity</code> no se edita aquí. Use
                    <a href="{{ url('/stock/create') }}" class="alert-link">Registrar movimiento</a> para entradas/salidas.
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
