<aside class="app-sidebar" id="appSidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <span class="sidebar-brand-icon"><i class="bi bi-grid-1x2-fill"></i></span>
        <span>
            <strong>The Grup</strong>
            <small>Inventory ERP</small>
        </span>
    </a>

    <div class="sidebar-section">Principal</div>
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Productos</span>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Categorías</span>
            </a>
        </li>
        <li>
            <a href="{{ route('stock.index') }}" class="nav-link {{ request()->routeIs('stock.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i>
                <span>Movimientos</span>
            </a>
        </li>
        <li>
            <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                <i class="bi bi-truck"></i>
                <span>Proveedores</span>
            </a>
        </li>
        <li>
            <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i>
                <span>Reportes</span>
            </a>
        </li>
        <li>
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-sliders2"></i>
                <span>Configuración</span>
            </a>
        </li>
    </ul>
</aside>
