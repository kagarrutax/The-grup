@extends('layouts.app')

@section('title', 'Categorías')

@section('content')

    {{-- Fase 2 — categories/index --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Categorías</h1>
            <p class="page-subtitle mb-0">Organización de productos por categorías</p>
        </div>
        <a href="{{ url('/categories/create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>Nueva categoría
        </a>
    </div>

    <div class="card card-app mb-4">
        <div class="card-body p-3 p-md-4">
            <form action="{{ url('/categories') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-12 col-md-8 col-lg-9">
                    <label for="search" class="form-label small text-muted mb-1">Buscar</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" id="search" name="search"
                               placeholder="Nombre o descripción..." value="">
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 d-grid d-md-block">
                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100 w-md-auto"><i class="bi bi-funnel me-1"></i>Buscar</button>
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
                            <th class="ps-4">Nombre</th>
                            <th>Descripción</th>
                            <th class="text-center pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4 fw-medium"><i class="bi bi-tag text-primary me-2"></i>Granos</td>
                            <td class="text-muted">Arroz, frijoles, lentejas y cereales.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('/categories/1/edit') }}" class="btn btn-outline-warning" title="Editar"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium"><i class="bi bi-tag text-primary me-2"></i>Lácteos</td>
                            <td class="text-muted">Leche, quesos, yogur y derivados.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('/categories/2/edit') }}" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium"><i class="bi bi-tag text-primary me-2"></i>Bebidas</td>
                            <td class="text-muted">Jugos, gaseosas y agua embotellada.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('/categories/3/edit') }}" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            <small class="text-muted">3 categorías registradas</small>
        </div>
    </div>

@endsection
