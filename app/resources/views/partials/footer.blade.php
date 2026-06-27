{{-- Pie de página del sistema --}}
<footer class="bg-white border-top shadow-sm mt-auto py-4">
    <div class="container">
        <div class="row align-items-center gy-3">

            {{-- Nombre del sistema --}}
            <div class="col-12 col-md-4 text-center text-md-start">
                <span class="fw-semibold text-primary">
                    <i class="bi bi-shop-window me-1"></i>SuperMercado
                </span>
            </div>

            {{-- Descripción --}}
            <div class="col-12 col-md-4 text-center">
                <small class="text-muted">Sistema de Inventario para Supermercado</small>
            </div>

            {{-- Año actual --}}
            <div class="col-12 col-md-4 text-center text-md-end">
                <small class="text-muted">
                    &copy; {{ date('Y') }} — Todos los derechos reservados
                </small>
            </div>

        </div>
    </div>
</footer>
