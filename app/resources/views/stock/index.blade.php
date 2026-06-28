@extends('layouts.app')

@section('title', 'Movimientos de Stock')

@section('content')

    {{-- Encabezado — Fase 4 stock/index --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Movimientos de Stock</h1>
            <p class="page-subtitle mb-0">Historial de entradas y salidas de mercadería</p>
        </div>
        <a href="{{ url('/stock/create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>Registrar movimiento
        </a>
    </div>

    {{-- Filtros --}}
    {{-- Integrar con: action="{{ route('stock.index') }}" method="GET" --}}
    <div class="card card-app mb-4">
        <div class="card-header pt-4 px-4">
            <h2 class="h6 fw-bold mb-0"><i class="bi bi-funnel me-2 text-primary"></i>Filtros</h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ url('/stock') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label for="product_id" class="form-label fw-medium">Producto</label>
                    <select class="form-select" id="product_id" name="product_id">
                        <option value="" selected>Todos los productos</option>
                        <option value="1">Arroz Premium 1kg</option>
                        <option value="2">Leche Entera 1L</option>
                        <option value="3">Aceite Vegetal 900ml</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label for="type" class="form-label fw-medium">Tipo</label>
                    <select class="form-select" id="type" name="type">
                        <option value="" selected>Todos</option>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label for="date" class="form-label fw-medium">Fecha</label>
                    <input type="date" class="form-control" id="date" name="date" value="">
                </div>
                <div class="col-12 d-flex flex-column flex-sm-row gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-search me-1"></i>Filtrar</button>
                    <a href="{{ url('/stock') }}" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-arrow-counterclockwise me-1"></i>Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de movimientos --}}
    <div class="card card-app">
        <div class="card-header pt-4 px-4 d-flex justify-content-between align-items-center">
            <h2 class="h6 fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Historial</h2>
            <small class="text-muted">8 movimientos</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                {{-- Integrar con: @forelse($movements as $movement) --}}
                <table class="table table-striped table-hover table-bordered table-app align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Tipo</th>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th>Motivo</th>
                            <th>Usuario</th>
                            <th class="pe-4">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4"><span class="badge rounded-pill text-bg-success"><i class="bi bi-arrow-down-circle me-1"></i>Entrada</span></td>
                            <td><span class="fw-medium">Arroz Premium 1kg</span><br><small class="text-muted">SKU: ARZ-001</small></td>
                            <td class="text-center fw-semibold text-success">+50</td>
                            <td>Compra a proveedor</td>
                            <td>María González</td>
                            <td class="pe-4"><small>27/06/2026 09:15</small></td>
                        </tr>
                        <tr>
                            <td class="ps-4"><span class="badge rounded-pill text-bg-danger"><i class="bi bi-arrow-up-circle me-1"></i>Salida</span></td>
                            <td><span class="fw-medium">Leche Entera 1L</span><br><small class="text-muted">SKU: LEC-012</small></td>
                            <td class="text-center fw-semibold text-danger">-24</td>
                            <td>Venta mostrador</td>
                            <td>Carlos Ruiz</td>
                            <td class="pe-4"><small>27/06/2026 08:42</small></td>
                        </tr>
                        <tr>
                            <td class="ps-4"><span class="badge rounded-pill text-bg-success"><i class="bi bi-arrow-down-circle me-1"></i>Entrada</span></td>
                            <td><span class="fw-medium">Aceite Vegetal 900ml</span><br><small class="text-muted">SKU: ACE-005</small></td>
                            <td class="text-center fw-semibold text-success">+30</td>
                            <td>Reposición de inventario</td>
                            <td>Ana Torres</td>
                            <td class="pe-4"><small>26/06/2026 17:30</small></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            <small class="text-muted">Integrar paginación: {{-- $movements->links() --}}</small>
        </div>
    </div>

@endsection
