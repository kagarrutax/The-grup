@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- Encabezado del dashboard --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
        <div>
            <h1 class="h3 fw-bold mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Resumen general del inventario del supermercado</p>
        </div>
        <div class="text-muted small">
            <i class="bi bi-calendar3 me-1"></i>{{ date('d/m/Y') }}
        </div>
    </div>

    {{--
        Tarjetas de métricas.
        Integrar con variables del controlador: $totalProductos, $totalCategorias, etc.
    --}}
    <div class="row g-3 g-md-4 mb-4">

        {{-- Total Productos --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-box-seam fs-3 text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total Productos</p>
                        {{-- Ejemplo: {{ $totalProductos }} --}}
                        <h2 class="h4 fw-bold mb-0">248</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Categorías --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-tags fs-3 text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Total Categorías</p>
                        {{-- Ejemplo: {{ $totalCategorias }} --}}
                        <h2 class="h4 fw-bold mb-0">12</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Productos con Stock Bajo --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-exclamation-triangle fs-3 text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Stock Bajo</p>
                        {{-- Ejemplo: {{ $productosStockBajo }} --}}
                        <h2 class="h4 fw-bold mb-0">18</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Productos Agotados --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 bg-danger bg-opacity-10 p-3 me-3">
                        <i class="bi bi-x-circle fs-3 text-danger"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-1">Productos Agotados</p>
                        {{-- Ejemplo: {{ $productosAgotados }} --}}
                        <h2 class="h4 fw-bold mb-0">5</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabla de últimos movimientos --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
            <h2 class="h5 fw-bold mb-0">
                <i class="bi bi-clock-history me-2 text-primary"></i>Últimos movimientos del inventario
            </h2>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                {{-- Integrar con: @forelse($movimientos as $movimiento) --}}
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Tipo</th>
                            <th scope="col" class="text-center">Cantidad</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="fw-medium">Arroz Premium 1kg</span>
                                <br><small class="text-muted">SKU: ARZ-001</small>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Entrada</span></td>
                            <td class="text-center fw-semibold text-success">+50</td>
                            <td>María González</td>
                            <td><small>27/06/2026 09:15</small></td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium">Leche Entera 1L</span>
                                <br><small class="text-muted">SKU: LEC-012</small>
                            </td>
                            <td><span class="badge rounded-pill text-bg-danger">Salida</span></td>
                            <td class="text-center fw-semibold text-danger">-24</td>
                            <td>Carlos Ruiz</td>
                            <td><small>27/06/2026 08:42</small></td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium">Aceite Vegetal 900ml</span>
                                <br><small class="text-muted">SKU: ACE-005</small>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Entrada</span></td>
                            <td class="text-center fw-semibold text-success">+30</td>
                            <td>Ana Torres</td>
                            <td><small>26/06/2026 17:30</small></td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium">Pan Integral 680g</span>
                                <br><small class="text-muted">SKU: PAN-023</small>
                            </td>
                            <td><span class="badge rounded-pill text-bg-danger">Salida</span></td>
                            <td class="text-center fw-semibold text-danger">-15</td>
                            <td>María González</td>
                            <td><small>26/06/2026 14:10</small></td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fw-medium">Detergente Líquido 1L</span>
                                <br><small class="text-muted">SKU: DET-008</small>
                            </td>
                            <td><span class="badge rounded-pill text-bg-success">Entrada</span></td>
                            <td class="text-center fw-semibold text-success">+20</td>
                            <td>Luis Mendoza</td>
                            <td><small>26/06/2026 11:00</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Enlace opcional a la vista completa de inventario --}}
            <div class="text-end mt-3">
                <a href="{{ url('/inventario') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                    Ver todos los movimientos <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

@endsection
