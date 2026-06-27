@extends('layouts.app')

@section('title', 'Nueva Categoría')

@section('content')

    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ url('/categories') }}" class="text-decoration-none">Categorías</a></li>
                <li class="breadcrumb-item active">Nueva</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1">Nueva categoría</h1>
        <p class="page-subtitle mb-0">Campos: name, description (spec 001)</p>
    </div>

    <div class="card card-app">
        <div class="card-body p-4">
            {{-- Integrar con: route('categories.store') --}}
            <form action="{{ url('/categories') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row g-3 g-md-4">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-medium">Nombre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ej: Granos" required>
                        <div class="invalid-feedback">El nombre es obligatorio.</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="description" class="form-label fw-medium">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="4"
                                  placeholder="Descripción de la categoría"></textarea>
                    </div>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-check-lg me-1"></i>Guardar</button>
                    <a href="{{ url('/categories') }}" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-x-lg me-1"></i>Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    (function () {
        'use strict';
        document.querySelectorAll('.needs-validation').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
                form.classList.add('was-validated');
            });
        });
    })();
</script>
@endsection
