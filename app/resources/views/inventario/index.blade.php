@extends('layouts.app')

@section('title', 'Inventario')

@section('content')

    {{-- Encabezado --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Inventario</h1>
            <p class="page-subtitle mb-0">Historial de movimientos de entrada y salida de productos</p>
        </div>
    </div>

    {{-- Filtros de búsqueda --}}
    {{-- Integrar con: method="GET" action="{{ route('inventario.index') }}" --}}
    <div class="card card-app mb-4">
        <div class="card-header pt-4 px-4">
            <h2 class="h6 fw-bold mb-0">
                <i class="bi bi-funnel me-2 text-primary"></i>Filtros
            </h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ url('/inventario') }}" method="GET" class="row g-3 align-items-end">

                {{-- Filtro por producto --}}
                <div class="col-12 col-md-4">
                    <label for="producto_id" class="form-label fw-medium">Producto</label>
                    {{-- Integrar con: @foreach($productos as $producto) --}}
                    <select class="form-select" id="producto_id" name="producto_id">
                        <option value="" selected>Todos los productos</option>
                        <option value="1">Arroz Premium 1kg</option>
                        <option value="2">Leche Entera 1L</option>
                        <option value="3">Aceite Vegetal 900ml</option>
                        <option value="4">Pan Integral 680g</option>
                        <option value="5">Detergente Líquido 1L</option>
                    </select>
                </div>

                {{-- Filtro por fecha --}}
                <div class="col-12 col-md-4">
                    <label for="fecha" class="form-label fw-medium">Fecha</label>
                    {{-- Integrar con: value="{{ request('fecha') }}" --}}
                    <input type="date"
                           class="form-control"
                           id="fecha"
                           name="fecha"
                           value="">
                </div>

                {{-- Filtro por tipo --}}
                <div class="col-12 col-md-4">
                    <label for="tipo" class="form-label fw-medium">Tipo</label>
                    <select class="form-select" id="tipo" name="tipo">
                        <option value="" selected>Todos los tipos</option>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                    </select>
                </div>

                {{-- Botones de filtro --}}
                <div class="col-12 d-flex flex-column flex-sm-row gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-search me-1"></i>Filtrar
                    </button>
                    <a href="{{ url('/inventario') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Limpiar
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Tabla de movimientos --}}
    <div class="card card-app">
        <div class="card-header pt-4 px-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
            <h2 class="h6 fw-bold mb-0">
                <i class="bi bi-clock-history me-2 text-primary"></i>Movimientos registrados
            </h2>
            <small class="text-muted">8 movimientos encontrados</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                {{-- Integrar con: @forelse($movimientos as $movimiento) --}}
                <table class="table table-striped table-hover table-bordered table-app align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">Tipo</th>
                            <th scope="col">Producto</th>
                            <th scope="col" class="text-center">Cantidad</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Usuario</th>
                            <th scope="col" class="text-center pe-4">Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-success">
                                    <i class="bi bi-arrow-down-circle me-1"></i>Entrada
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Arroz Premium 1kg</span>
                                <br><small class="text-muted">SKU: ARZ-001</small>
                            </td>
                            <td class="text-center fw-semibold text-success">+50</td>
                            <td><small>27/06/2026 09:15</small></td>
                            <td>María González</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-success">Completado</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-danger">
                                    <i class="bi bi-arrow-up-circle me-1"></i>Salida
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Leche Entera 1L</span>
                                <br><small class="text-muted">SKU: LEC-012</small>
                            </td>
                            <td class="text-center fw-semibold text-danger">-24</td>
                            <td><small>27/06/2026 08:42</small></td>
                            <td>Carlos Ruiz</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-success">Completado</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-success">
                                    <i class="bi bi-arrow-down-circle me-1"></i>Entrada
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Aceite Vegetal 900ml</span>
                                <br><small class="text-muted">SKU: ACE-005</small>
                            </td>
                            <td class="text-center fw-semibold text-success">+30</td>
                            <td><small>26/06/2026 17:30</small></td>
                            <td>Ana Torres</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-success">Completado</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-danger">
                                    <i class="bi bi-arrow-up-circle me-1"></i>Salida
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Pan Integral 680g</span>
                                <br><small class="text-muted">SKU: PAN-023</small>
                            </td>
                            <td class="text-center fw-semibold text-danger">-15</td>
                            <td><small>26/06/2026 14:10</small></td>
                            <td>María González</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-warning text-dark">Pendiente</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-success">
                                    <i class="bi bi-arrow-down-circle me-1"></i>Entrada
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Detergente Líquido 1L</span>
                                <br><small class="text-muted">SKU: DET-008</small>
                            </td>
                            <td class="text-center fw-semibold text-success">+20</td>
                            <td><small>26/06/2026 11:00</small></td>
                            <td>Luis Mendoza</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-success">Completado</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-danger">
                                    <i class="bi bi-arrow-up-circle me-1"></i>Salida
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Arroz Premium 1kg</span>
                                <br><small class="text-muted">SKU: ARZ-001</small>
                            </td>
                            <td class="text-center fw-semibold text-danger">-10</td>
                            <td><small>25/06/2026 16:45</small></td>
                            <td>Carlos Ruiz</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-success">Completado</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-success">
                                    <i class="bi bi-arrow-down-circle me-1"></i>Entrada
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Leche Entera 1L</span>
                                <br><small class="text-muted">SKU: LEC-012</small>
                            </td>
                            <td class="text-center fw-semibold text-success">+48</td>
                            <td><small>25/06/2026 10:20</small></td>
                            <td>Ana Torres</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-secondary">Anulado</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4">
                                <span class="badge rounded-pill text-bg-danger">
                                    <i class="bi bi-arrow-up-circle me-1"></i>Salida
                                </span>
                            </td>
                            <td>
                                <span class="fw-medium">Aceite Vegetal 900ml</span>
                                <br><small class="text-muted">SKU: ACE-005</small>
                            </td>
                            <td class="text-center fw-semibold text-danger">-8</td>
                            <td><small>24/06/2026 15:00</small></td>
                            <td>Luis Mendoza</td>
                            <td class="text-center pe-4">
                                <span class="badge rounded-pill text-bg-success">Completado</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginación visual (integrar con: {{ $movimientos->links() }} ) --}}
        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <small class="text-muted">Mostrando 1 a 8 de 156 movimientos</small>
                <nav aria-label="Paginación de inventario">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <span class="page-link rounded-start-pill border-0 shadow-sm">
                                <i class="bi bi-chevron-left"></i>
                            </span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link border-0 shadow-sm">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link border-0 shadow-sm" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link border-0 shadow-sm" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link border-0 shadow-sm disabled">…</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link border-0 shadow-sm" href="#">20</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-end-pill border-0 shadow-sm" href="#" aria-label="Siguiente">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

@endsection
