@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

    {{-- Encabezado --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/productos') }}" class="text-decoration-none">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>
            <h1 class="h3 fw-bold mb-1">Editar Producto</h1>
            <p class="text-muted mb-0">Modifique los datos del producto seleccionado</p>
        </div>
    </div>

    {{-- Formulario de edición --}}
    {{-- Integrar con: action="{{ route('productos.update', $producto) }}" method="POST" --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <form action="{{ url('/productos/1') }}" method="POST" enctype="multipart/form-data"
                  class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-3 g-md-4">

                    {{-- Código --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="codigo" class="form-label fw-medium">
                            Código <span class="text-danger">*</span>
                        </label>
                        {{-- Integrar con: value="{{ old('codigo', $producto->codigo) }}" --}}
                        <input type="text"
                               class="form-control {{-- @error('codigo') is-invalid @enderror --}}"
                               id="codigo"
                               name="codigo"
                               placeholder="Ej: ARZ-001"
                               value="ARZ-001"
                               required>
                        <div class="invalid-feedback">El código es obligatorio.</div>
                    </div>

                    {{-- Nombre --}}
                    <div class="col-12 col-md-6 col-lg-8">
                        <label for="nombre" class="form-label fw-medium">
                            Nombre <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control"
                               id="nombre"
                               name="nombre"
                               placeholder="Nombre del producto"
                               value="Arroz Premium 1kg"
                               required>
                        <div class="invalid-feedback">El nombre es obligatorio.</div>
                    </div>

                    {{-- Descripción --}}
                    <div class="col-12">
                        <label for="descripcion" class="form-label fw-medium">Descripción</label>
                        <textarea class="form-control"
                                  id="descripcion"
                                  name="descripcion"
                                  rows="3"
                                  placeholder="Descripción detallada del producto">Arroz de grano largo premium, ideal para acompañar comidas diarias. Presentación de 1 kg.</textarea>
                    </div>

                    {{-- Categoría --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="categoria_id" class="form-label fw-medium">
                            Categoría <span class="text-danger">*</span>
                        </label>
                        {{-- Integrar con: @foreach($categorias as $categoria) @selected --}}
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            <option value="" disabled>Seleccione una categoría</option>
                            <option value="1" selected>Granos</option>
                            <option value="2">Lácteos</option>
                            <option value="3">Aceites</option>
                            <option value="4">Panadería</option>
                            <option value="5">Limpieza</option>
                            <option value="6">Bebidas</option>
                        </select>
                        <div class="invalid-feedback">Seleccione una categoría.</div>
                    </div>

                    {{-- Estado --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="estado" class="form-label fw-medium">
                            Estado <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="activo" selected>Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        <div class="invalid-feedback">Seleccione un estado.</div>
                    </div>

                    {{-- Imagen --}}
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="imagen" class="form-label fw-medium">Imagen</label>

                        {{-- Vista previa de imagen actual --}}
                        {{-- Integrar con: src="{{ asset('storage/' . $producto->imagen) }}" --}}
                        <div class="mb-2">
                            <img src="https://placehold.co/120x120/e9ecef/6c757d?text=ARZ-001"
                                 alt="Imagen actual del producto"
                                 class="img-thumbnail rounded-3 shadow-sm"
                                 width="120"
                                 height="120">
                            <div class="form-text mt-1">Imagen actual. Suba un archivo para reemplazarla.</div>
                        </div>

                        <input type="file"
                               class="form-control"
                               id="imagen"
                               name="imagen"
                               accept="image/jpeg,image/png,image/webp">
                        <div class="form-text">Formatos permitidos: JPG, PNG, WEBP. Máx. 2 MB.</div>
                    </div>

                    {{-- Precio Compra --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="precio_compra" class="form-label fw-medium">
                            Precio Compra <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   class="form-control"
                                   id="precio_compra"
                                   name="precio_compra"
                                   placeholder="0.00"
                                   step="0.01"
                                   min="0"
                                   value="1.20"
                                   required>
                            <div class="invalid-feedback">Ingrese un precio de compra válido.</div>
                        </div>
                    </div>

                    {{-- Precio Venta --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="precio_venta" class="form-label fw-medium">
                            Precio Venta <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   class="form-control"
                                   id="precio_venta"
                                   name="precio_venta"
                                   placeholder="0.00"
                                   step="0.01"
                                   min="0"
                                   value="1.85"
                                   required>
                            <div class="invalid-feedback">Ingrese un precio de venta válido.</div>
                        </div>
                    </div>

                    {{-- Stock --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="stock" class="form-label fw-medium">
                            Stock <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                               class="form-control"
                               id="stock"
                               name="stock"
                               placeholder="0"
                               min="0"
                               value="120"
                               required>
                        <div class="invalid-feedback">Ingrese la cantidad en stock.</div>
                    </div>

                    {{-- Stock mínimo --}}
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="stock_minimo" class="form-label fw-medium">
                            Stock mínimo <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                               class="form-control"
                               id="stock_minimo"
                               name="stock_minimo"
                               placeholder="0"
                               min="0"
                               value="15"
                               required>
                        <div class="form-text">Alerta cuando el stock sea igual o menor a este valor.</div>
                        <div class="invalid-feedback">Ingrese el stock mínimo.</div>
                    </div>

                </div>

                {{-- Botones de acción --}}
                <div class="d-flex flex-column flex-sm-row gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-lg me-1"></i>Guardar
                    </button>
                    <a href="{{ url('/productos') }}" class="btn btn-outline-secondary rounded-pill px-4">
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
