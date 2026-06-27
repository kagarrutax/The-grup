@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')

    {{-- Encabezado --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/productos') }}" class="text-decoration-none">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold mb-1">Detalle del Producto</h1>
            <p class="text-muted mb-0">Información completa del producto seleccionado</p>
        </div>
        <div class="d-flex flex-column flex-sm-row gap-2">
            <a href="{{ url('/productos/1/edit') }}" class="btn btn-warning rounded-pill shadow-sm">
                <i class="bi bi-pencil me-1"></i>Editar
            </a>
            <a href="{{ url('/productos') }}" class="btn btn-outline-secondary rounded-pill">
                <i class="bi bi-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    {{--
        Ficha del producto.
        Integrar con variables del controlador: $producto
    --}}
    <div class="row g-4">

        {{-- Imagen del producto --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4 text-center">
                    {{-- Integrar con: src="{{ asset('storage/' . $producto->imagen) }}" --}}
                    <img src="https://placehold.co/400x400/e9ecef/6c757d?text=Arroz+Premium"
                         alt="Arroz Premium 1kg"
                         class="img-fluid rounded-3 shadow-sm mb-3"
                         style="max-height: 320px; object-fit: cover;">

                    <h2 class="h5 fw-bold mb-1">Arroz Premium 1kg</h2>
                    <p class="text-muted mb-3">
                        <span class="badge bg-light text-dark border">ARZ-001</span>
                    </p>

                    {{-- Integrar con: @if($producto->estado === 'activo') --}}
                    <span class="badge rounded-pill text-bg-success fs-6">
                        <i class="bi bi-check-circle me-1"></i>Activo
                    </span>
                </div>
            </div>
        </div>

        {{-- Información general --}}
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h3 class="h5 fw-bold mb-0">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Información general
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">

                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <small class="text-muted d-block mb-1">Código</small>
                                <span class="fw-semibold">ARZ-001</span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <small class="text-muted d-block mb-1">Categoría</small>
                                <span class="badge rounded-pill text-bg-secondary">Granos</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Descripción</small>
                                <span>Arroz de grano largo premium, ideal para acompañar comidas diarias. Presentación de 1 kg.</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Precios y stock --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h3 class="h5 fw-bold mb-0">
                        <i class="bi bi-currency-dollar me-2 text-primary"></i>Precios e inventario
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">

                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 border rounded-3 h-100">
                                <small class="text-muted d-block mb-1">Precio Compra</small>
                                <span class="h5 fw-bold text-muted mb-0">$1.20</span>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 border border-primary border-opacity-25 rounded-3 bg-primary bg-opacity-10 h-100">
                                <small class="text-muted d-block mb-1">Precio Venta</small>
                                <span class="h5 fw-bold text-primary mb-0">$1.85</span>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 border rounded-3 h-100">
                                <small class="text-muted d-block mb-1">Stock actual</small>
                                <span class="h5 fw-bold text-success mb-0">120</span>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="text-center p-3 border rounded-3 h-100">
                                <small class="text-muted d-block mb-1">Stock mínimo</small>
                                <span class="h5 fw-bold text-warning mb-0">15</span>
                            </div>
                        </div>

                    </div>

                    {{-- Indicador de estado del stock --}}
                    <div class="alert alert-success d-flex align-items-center mt-4 mb-0 rounded-3" role="alert">
                        <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                        <div>
                            <strong>Stock disponible.</strong>
                            El inventario se encuentra por encima del nivel mínimo.
                        </div>
                    </div>
                    {{--
                        Integrar según stock:
                        - Stock = 0  → alert-danger  "Producto agotado"
                        - Stock <= mínimo → alert-warning "Stock bajo"
                        - Stock > mínimo  → alert-success "Stock disponible"
                    --}}

                </div>
            </div>
        </div>

    </div>

    {{-- Metadatos adicionales --}}
    <div class="card border-0 shadow-sm rounded-3 mt-4">
        <div class="card-body p-4">
            <div class="row g-3 text-muted small">
                <div class="col-12 col-sm-4">
                    <i class="bi bi-calendar-plus me-1"></i>
                    <strong>Creado:</strong> 15/03/2026
                </div>
                <div class="col-12 col-sm-4">
                    <i class="bi bi-calendar-check me-1"></i>
                    <strong>Última actualización:</strong> 27/06/2026
                </div>
                <div class="col-12 col-sm-4">
                    <i class="bi bi-person me-1"></i>
                    <strong>Registrado por:</strong> María González
                </div>
            </div>
        </div>
    </div>

@endsection
