@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')

    {{-- Encabezado --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/categorias') }}" class="text-decoration-none">Categorías</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold mb-1">Editar Categoría</h1>
            <p class="page-subtitle mb-0">Modifique los datos de la categoría seleccionada</p>
        </div>
    </div>

    {{-- Formulario de edición --}}
    {{-- Integrar con: action="{{ route('categorias.update', $categoria) }}" method="POST" --}}
    <div class="card card-app">
        <div class="card-header pt-4 px-4">
            <h2 class="h5 fw-bold mb-0">
                <i class="bi bi-tags me-2 text-primary"></i>Datos de la categoría
            </h2>
        </div>
        <div class="card-body p-4">
            <form action="{{ url('/categorias/1') }}" method="POST"
                  class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-3 g-md-4">

                    {{-- Nombre --}}
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label fw-medium">
                            Nombre <span class="text-danger">*</span>
                        </label>
                        {{-- Integrar con: value="{{ old('nombre', $categoria->nombre) }}" --}}
                        <input type="text"
                               class="form-control {{-- @error('nombre') is-invalid @enderror --}}"
                               id="nombre"
                               name="nombre"
                               placeholder="Ej: Granos, Lácteos, Bebidas..."
                               value="Granos"
                               required>
                        <div class="invalid-feedback">El nombre de la categoría es obligatorio.</div>
                    </div>

                    {{-- Descripción --}}
                    <div class="col-12 col-md-6">
                        <label for="descripcion" class="form-label fw-medium">Descripción</label>
                        <textarea class="form-control {{-- @error('descripcion') is-invalid @enderror --}}"
                                  id="descripcion"
                                  name="descripcion"
                                  rows="4"
                                  placeholder="Descripción breve de la categoría">Arroz, frijoles, lentejas, avena y cereales en general.</textarea>
                        <div class="form-text">Opcional. Ayuda a identificar el tipo de productos incluidos.</div>
                    </div>

                </div>

                {{-- Botones de acción --}}
                <div class="d-flex flex-column flex-sm-row gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i>Guardar
                    </button>
                    <a href="{{ url('/categorias') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-x-lg me-1"></i>Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    // Validación visual de Bootstrap 5
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection
