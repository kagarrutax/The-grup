{{--
    Navbar — Fase 1 (plan layouts/)
    Rutas según routes/PLAN.md:
    route('dashboard'), route('products.index'), route('categories.index'), route('stock.index')
--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/dashboard') }}">
            <i class="bi bi-shop-window fs-4 me-2"></i>
            <span class="d-none d-sm-inline">SuperMercado</span>
            <span class="d-inline d-sm-none">SM</span>
        </a>

        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false"
                aria-label="Abrir menú de navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/products') }}">
                        <i class="bi bi-box-seam me-1"></i>Productos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/categories') }}">
                        <i class="bi bi-tags me-1"></i>Categorías
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('stock*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/stock') }}">
                        <i class="bi bi-arrow-left-right me-1"></i>Stock
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav ms-lg-3 align-items-lg-center">
                {{-- Integrar con: {{ Auth::user()->name }} --}}
                <li class="nav-item d-none d-lg-block">
                    <span class="nav-link disabled text-white-50 small mb-0">
                        <i class="bi bi-person-circle me-1"></i>Usuario demo
                    </span>
                </li>
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white text-decoration-none px-0">
                            <i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>
