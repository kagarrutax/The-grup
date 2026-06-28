<aside class="app-sidebar" id="appSidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <span class="sidebar-brand-icon"><i class="bi bi-box-seam"></i></span>
        <span>Inventario</span>
    </a>

    <div class="sidebar-section">Inventario</div>
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-basket"></i> Productos
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Categorías
            </a>
        </li>
        <li>
            <a href="{{ route('stock.index') }}" class="nav-link {{ request()->routeIs('stock.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Movimientos
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <ul class="sidebar-nav mb-0">
            <li>
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person"></i> Perfil
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
