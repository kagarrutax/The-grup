{{--
    Navbar principal del sistema.
    Integrar rutas con route() cuando existan los controladores:
    - route('dashboard')
    - route('productos.index')
    - route('categorias.index')
    - route('inventario.index')
    - route('logout')
--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">

        {{-- Logo / Marca del supermercado --}}
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/dashboard') }}">
            <i class="bi bi-shop-window fs-4 me-2"></i>
            <span class="d-none d-sm-inline">SuperMercado</span>
            <span class="d-inline d-sm-none">SM</span>
        </a>

        {{-- Botón hamburguesa (visible en móvil y tablet) --}}
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false"
                aria-label="Abrir menú de navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Enlaces de navegación --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('productos*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/productos') }}">
                        <i class="bi bi-box-seam me-1"></i>Productos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categorias*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/categorias') }}">
                        <i class="bi bi-tags me-1"></i>Categorías
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('inventario*') ? 'active fw-semibold' : '' }}"
                       href="{{ url('/inventario') }}">
                        <i class="bi bi-arrow-left-right me-1"></i>Inventario
                    </a>
                </li>

            </ul>

            {{-- Cerrar sesión --}}
            <ul class="navbar-nav ms-lg-3">
                <li class="nav-item">
                    {{-- Integrar con: method="POST" action="{{ route('logout') }}" @csrf --}}
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
