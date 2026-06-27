@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/products') }}" class="text-decoration-none">Productos</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold mb-1">Arroz Premium 1kg</h1>
            <p class="page-subtitle mb-0">SKU: ARZ-001</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url('/products/1/edit') }}" class="btn btn-warning rounded-pill"><i class="bi bi-pencil me-1"></i>Editar</a>
            <a href="{{ url('/products') }}" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Volver</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <div class="card card-app">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6"><div class="info-block"><small class="text-muted">Categoría</small><br><span class="badge rounded-pill text-bg-secondary">Granos</span></div></div>
                        <div class="col-sm-6"><div class="info-block"><small class="text-muted">Unidad</small><br><span class="fw-semibold">Kilogramo</span></div></div>
                        <div class="col-sm-6"><div class="info-block"><small class="text-muted">Precio</small><br><span class="h5 fw-bold text-primary mb-0">$1.85</span></div></div>
                        <div class="col-sm-6"><div class="info-block"><small class="text-muted">Estado</small><br><span class="badge rounded-pill text-bg-success">Activo</span></div></div>
                        <div class="col-sm-6"><div class="info-block"><small class="text-muted">Stock actual</small><br><span class="h5 fw-bold text-success mb-0">120</span></div></div>
                        <div class="col-sm-6"><div class="info-block"><small class="text-muted">Stock mínimo</small><br><span class="h5 fw-bold text-warning mb-0">15</span></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card card-app">
                <div class="card-body p-4">
                    <h2 class="h6 fw-bold mb-3">Acciones rápidas</h2>
                    <a href="{{ url('/stock/create') }}" class="btn btn-primary rounded-pill w-100 mb-2">
                        <i class="bi bi-arrow-left-right me-1"></i>Registrar movimiento
                    </a>
                    <a href="{{ url('/stock') }}" class="btn btn-outline-primary rounded-pill w-100">
                        <i class="bi bi-clock-history me-1"></i>Ver historial
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
