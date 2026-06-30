<aside class="app-sidebar" id="appSidebar">

    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-box-seam"></i></div>
        <span>Inventario</span>
    </div>

    <nav class="sidebar-nav">

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <div class="sidebar-label">Inventario</div>

        <a href="{{ route('products.index') }}"
           class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box"></i>
            Productos
        </a>

        <a href="{{ route('categories.index') }}"
           class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            Categorías
        </a>

        <a href="{{ route('stock.index') }}"
           class="sidebar-link {{ request()->routeIs('stock.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i>
            Movimientos
        </a>

        <div class="sidebar-label">Operaciones</div>

        <a href="{{ route('suppliers.index') }}"
           class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i>
            Proveedores
        </a>

        <a href="{{ route('reports.index') }}"
           class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i>
            Reportes
        </a>

        <div class="sidebar-label">Administración</div>

        <a href="{{ route('profile.edit') }}"
           class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-sliders2"></i>
            Configuración
        </a>

    </nav>

</aside>
