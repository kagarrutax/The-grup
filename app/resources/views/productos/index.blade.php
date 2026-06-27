@extends('layouts.app')

@section('title', 'Productos')

@section('content')

    {{-- Encabezado con título y botón de acción --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Productos</h1>
            <p class="text-muted mb-0">Gestión del catálogo de productos del supermercado</p>
        </div>
        <a href="{{ url('/productos/create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Producto
        </a>
    </div>

    {{-- Barra de búsqueda --}}
    {{-- Integrar con: method="GET" action="{{ route('productos.index') }}" --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3 p-md-4">
            <form action="{{ url('/productos') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-12 col-md-8 col-lg-9">
                    <label for="buscar" class="form-label small text-muted mb-1">Buscar producto</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        {{-- Integrar con: value="{{ request('buscar') }}" --}}
                        <input type="text"
                               class="form-control border-start-0 ps-0"
                               id="buscar"
                               name="buscar"
                               placeholder="Buscar por código, nombre o categoría..."
                               value="">
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 d-grid d-md-block">
                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100 w-md-auto">
                        <i class="bi bi-funnel me-1"></i>Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de productos --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                {{-- Integrar con: @forelse($productos as $producto) --}}
                <table class="table table-striped table-hover table-bordered table-app align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Categoría</th>
                            <th scope="col" class="text-end">Precio Compra</th>
                            <th scope="col" class="text-end">Precio Venta</th>
                            <th scope="col" class="text-center">Stock</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><span class="badge bg-light text-dark border">ARZ-001</span></td>
                            <td class="fw-medium">Arroz Premium 1kg</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Granos</span></td>
                            <td class="text-end">$1.20</td>
                            <td class="text-end fw-semibold">$1.85</td>
                            <td class="text-center">120</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-success">Activo</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/productos/1') }}" class="btn btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ url('/productos/1/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="1" data-nombre="Arroz Premium 1kg" data-codigo="ARZ-001">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="badge bg-light text-dark border">LEC-012</span></td>
                            <td class="fw-medium">Leche Entera 1L</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Lácteos</span></td>
                            <td class="text-end">$0.95</td>
                            <td class="text-end fw-semibold">$1.45</td>
                            <td class="text-center text-warning fw-semibold">8</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-success">Activo</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/productos/2') }}" class="btn btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ url('/productos/2/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="2" data-nombre="Leche Entera 1L" data-codigo="LEC-012">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="badge bg-light text-dark border">ACE-005</span></td>
                            <td class="fw-medium">Aceite Vegetal 900ml</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Aceites</span></td>
                            <td class="text-end">$2.10</td>
                            <td class="text-end fw-semibold">$3.25</td>
                            <td class="text-center">45</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-success">Activo</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/productos/3') }}" class="btn btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ url('/productos/3/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="3" data-nombre="Aceite Vegetal 900ml" data-codigo="ACE-005">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="badge bg-light text-dark border">PAN-023</span></td>
                            <td class="fw-medium">Pan Integral 680g</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Panadería</span></td>
                            <td class="text-end">$1.05</td>
                            <td class="text-end fw-semibold">$1.65</td>
                            <td class="text-center text-danger fw-semibold">0</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-danger">Agotado</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/productos/4') }}" class="btn btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ url('/productos/4/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="4" data-nombre="Pan Integral 680g" data-codigo="PAN-023">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="badge bg-light text-dark border">DET-008</span></td>
                            <td class="fw-medium">Detergente Líquido 1L</td>
                            <td><span class="badge rounded-pill text-bg-secondary">Limpieza</span></td>
                            <td class="text-end">$2.80</td>
                            <td class="text-end fw-semibold">$4.50</td>
                            <td class="text-center">32</td>
                            <td class="text-center"><span class="badge rounded-pill text-bg-secondary">Inactivo</span></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/productos/5') }}" class="btn btn-outline-info" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ url('/productos/5/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="5" data-nombre="Detergente Líquido 1L" data-codigo="DET-008">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginación visual (integrar con: {{ $productos->links() }} ) --}}
        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <small class="text-muted">Mostrando 1 a 5 de 248 productos</small>
                <nav aria-label="Paginación de productos">
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
                            <a class="page-link border-0 shadow-sm" href="#">50</a>
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

    {{-- Modal de confirmación de eliminación (reutilizable) --}}
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-3">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalEliminarLabel">
                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>Confirmar eliminación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="modalEliminarBody">
                    ¿Está seguro que desea eliminar este producto? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    {{-- Integrar con: action="{{ route('productos.destroy', $producto) }}" --}}
                    <form id="formEliminar" action="{{ url('/productos/1') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.querySelectorAll('.btn-eliminar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var id = this.dataset.id;
            var nombre = this.dataset.nombre;
            var codigo = this.dataset.codigo;

            document.getElementById('modalEliminarBody').innerHTML =
                '¿Está seguro que desea eliminar el producto <strong>' + nombre + '</strong> (' + codigo + ')? ' +
                'Esta acción no se puede deshacer.';

            document.getElementById('formEliminar').action = '/productos/' + id;
        });
    });
</script>
@endsection
