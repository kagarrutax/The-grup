@extends('layouts.app')

@section('title', 'Categorías')

@section('content')

    {{-- Encabezado --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Categorías</h1>
            <p class="text-muted mb-0">Organización de productos por categorías del supermercado</p>
        </div>
        <a href="{{ url('/categorias/create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i>Nueva Categoría
        </a>
    </div>

    {{-- Barra de búsqueda --}}
    {{-- Integrar con: method="GET" action="{{ route('categorias.index') }}" --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3 p-md-4">
            <form action="{{ url('/categorias') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-12 col-md-8 col-lg-9">
                    <label for="buscar" class="form-label small text-muted mb-1">Buscar categoría</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        {{-- Integrar con: value="{{ request('buscar') }}" --}}
                        <input type="text"
                               class="form-control border-start-0 ps-0"
                               id="buscar"
                               name="buscar"
                               placeholder="Buscar por nombre o descripción..."
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

    {{-- Tabla de categorías --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                {{-- Integrar con: @forelse($categorias as $categoria) --}}
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" class="text-center pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="ps-4 fw-medium">
                                <i class="bi bi-tag text-primary me-2"></i>Granos
                            </td>
                            <td class="text-muted">Arroz, frijoles, lentejas, avena y cereales en general.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/categorias/1/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="1" data-nombre="Granos">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4 fw-medium">
                                <i class="bi bi-tag text-primary me-2"></i>Lácteos
                            </td>
                            <td class="text-muted">Leche, quesos, yogur, mantequilla y derivados lácteos.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/categorias/2/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="2" data-nombre="Lácteos">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4 fw-medium">
                                <i class="bi bi-tag text-primary me-2"></i>Aceites
                            </td>
                            <td class="text-muted">Aceites vegetales, de oliva, girasol y mantecas comestibles.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/categorias/3/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="3" data-nombre="Aceites">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4 fw-medium">
                                <i class="bi bi-tag text-primary me-2"></i>Panadería
                            </td>
                            <td class="text-muted">Pan blanco, integral, bollería y productos de repostería.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/categorias/4/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="4" data-nombre="Panadería">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4 fw-medium">
                                <i class="bi bi-tag text-primary me-2"></i>Limpieza
                            </td>
                            <td class="text-muted">Detergentes, desinfectantes, jabones y artículos de aseo del hogar.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/categorias/5/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="5" data-nombre="Limpieza">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4 fw-medium">
                                <i class="bi bi-tag text-primary me-2"></i>Bebidas
                            </td>
                            <td class="text-muted">Jugos, gaseosas, agua embotellada y bebidas energéticas.</td>
                            <td class="text-center pe-4">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                    <a href="{{ url('/categorias/6/edit') }}" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-eliminar" title="Eliminar"
                                            data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                            data-id="6" data-nombre="Bebidas">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Contador de registros (integrar con paginación si aplica) --}}
        <div class="card-footer bg-white border-0 py-3 px-4">
            <small class="text-muted">Mostrando 6 categorías registradas</small>
        </div>
    </div>

    {{-- Modal de confirmación de eliminación --}}
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
                    ¿Está seguro que desea eliminar esta categoría? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    {{-- Integrar con: action="{{ route('categorias.destroy', $categoria) }}" --}}
                    <form id="formEliminar" action="{{ url('/categorias/1') }}" method="POST" class="d-inline">
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

            document.getElementById('modalEliminarBody').innerHTML =
                '¿Está seguro que desea eliminar la categoría <strong>' + nombre + '</strong>? ' +
                'Los productos asociados podrían verse afectados. Esta acción no se puede deshacer.';

            document.getElementById('formEliminar').action = '/categorias/' + id;
        });
    });
</script>
@endsection
