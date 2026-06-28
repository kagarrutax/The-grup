@extends('layouts.app')

@section('title', 'Registrar Movimiento')

@section('content')

    {{-- Encabezado — Fase 4 stock/create --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/stock') }}" class="text-decoration-none">Stock</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registrar</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold mb-1">Registrar movimiento</h1>
            <p class="page-subtitle mb-0">Registre una entrada o salida de mercadería</p>
        </div>
    </div>

    {{-- Error de stock insuficiente (integrar con @error o session) --}}
    {{-- @if($errors->has('quantity')) --}}
    <div class="alert alert-danger d-none rounded-3 shadow-sm" role="alert" id="alertStockError">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Stock insuficiente.</strong> La cantidad de salida supera el stock disponible del producto.
    </div>
    {{-- @endif --}}

    {{-- Formulario — Integrar con: route('stock.store') --}}
    <div class="card card-app">
        <div class="card-header pt-4 px-4">
            <h2 class="h5 fw-bold mb-0"><i class="bi bi-arrow-left-right me-2 text-primary"></i>Datos del movimiento</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ url('/stock') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row g-3 g-md-4">

                    {{-- Producto --}}
                    <div class="col-12 col-md-6">
                        <label for="product_id" class="form-label fw-medium">Producto <span class="text-danger">*</span></label>
                        {{-- @foreach($products as $product) --}}
                        <select class="form-select" id="product_id" name="product_id" required>
                            <option value="" selected disabled>Seleccione un producto</option>
                            <option value="1">Arroz Premium 1kg (Stock: 120)</option>
                            <option value="2">Leche Entera 1L (Stock: 8)</option>
                            <option value="3">Aceite Vegetal 900ml (Stock: 45)</option>
                            <option value="4">Pan Integral 680g (Stock: 0)</option>
                        </select>
                        <div class="invalid-feedback">Seleccione un producto.</div>
                    </div>

                    {{-- Tipo --}}
                    <div class="col-12 col-md-6">
                        <label for="type" class="form-label fw-medium">Tipo de movimiento <span class="text-danger">*</span></label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="" selected disabled>Seleccione el tipo</option>
                            <option value="entrada">Entrada — ingreso de mercadería</option>
                            <option value="salida">Salida — egreso de mercadería</option>
                        </select>
                        <div class="invalid-feedback">Seleccione el tipo de movimiento.</div>
                    </div>

                    {{-- Cantidad --}}
                    <div class="col-12 col-md-6">
                        <label for="quantity" class="form-label fw-medium">Cantidad <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                               min="1" step="1" placeholder="Ej: 10" required>
                        <div class="form-text">En salidas, no puede superar el stock disponible.</div>
                        <div class="invalid-feedback">Ingrese una cantidad válida mayor a cero.</div>
                    </div>

                    {{-- Motivo --}}
                    <div class="col-12 col-md-6">
                        <label for="reason" class="form-label fw-medium">Motivo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="reason" name="reason"
                               placeholder="Ej: Compra proveedor, venta, merma..." required>
                        <div class="invalid-feedback">Indique el motivo del movimiento.</div>
                    </div>

                </div>

                <div class="d-flex flex-column flex-sm-row gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i>Registrar
                    </button>
                    <a href="{{ url('/stock') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-lg me-1"></i>Cancelar
                    </a>
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
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    })();
</script>
@endsection
