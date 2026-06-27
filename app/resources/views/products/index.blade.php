@extends('layouts.app')

@section('title', 'Productos')

@section('content')

    {{-- Fase 3 + Fase 6 — products/index con buscador --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Productos</h1>
            <p class="page-subtitle mb-0">Catálogo de productos del supermercado</p>
        </div>
        <a href="{{ url('/products/create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>Nuevo producto
        </a>
    </div>

    {{-- Buscador: nombre, SKU y categoría (Fase 6) --}}
    <div class="card card-app mb-4">
        <div class="card-header pt-4 px-4">
            <h2 class="h6 fw-bold mb-0"><i class="bi bi-search me-2 text-primary"></i>Buscador</h2>
        </div>
        <div class="card-body p-4">
            {{-- Integrar con: route('products.index') method GET --}}
            <form action="{{ url('/products') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label for="name" class="form-label fw-medium">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="Buscar por nombre" value="">
                </div>
                <div class="col-12 col-md-4">
                    <label for="sku" class="form-label fw-medium">SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku"
                           placeholder="Ej: ARZ-001" value="">
                </div>
                <div class="col-12 col-md-4">
                    <label for="category_id" class="form-label fw-medium">Categoría</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="" selected>Todas</option>
                        <option value="1">Granos</option>
                        <option value="2">Lácteos</option>
                        <option value="3">Bebidas</option>
                    </select>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-funnel me-1"></i>Filtrar</button>
                    <a href="{{ url('/products') }}" class="btn btn-outline-secondary rounded-pill px-4">Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-app">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-app align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th class="text-end">Precio</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Mínimo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-light text-dark border">ARZ-001</span></td>
                            <td class="fw-medium">Arroz Premium 1kg</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Granos</span></td>
                            <td class="text-end fw-semibold">$1.85</td>
                            <td class="text-center">120</td>
                            <td class="text-center">15</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-success">Activo</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('/products/1') }}" class="btn btn-outline-info" title="Ver"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('/products/1/edit') }}" class="btn btn-outline-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-light text-dark border">LEC-012</span></td>
                            <td class="fw-medium">Leche Entera 1L</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Lácteos</span></td>
                            <td class="text-end fw-semibold">$1.45</td>
                            <td class="text-center text-warning fw-semibold">8</td>
                            <td class="text-center">10</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-success">Activo</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('/products/2') }}" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('/products/2/edit') }}" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-light text-dark border">PAN-023</span></td>
                            <td class="fw-medium">Pan Integral 680g</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Panadería</span></td>
                            <td class="text-end fw-semibold">$1.65</td>
                            <td class="text-center text-danger fw-semibold">0</td>
                            <td class="text-center">5</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-danger">Agotado</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('/products/4') }}" class="btn btn-outline-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ url('/products/4/edit') }}" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            <small class="text-muted">Stock se gestiona desde movimientos (Fase 4), no desde este formulario.</small>
        </div>
    </div>

@endsection
